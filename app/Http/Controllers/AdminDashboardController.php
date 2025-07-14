<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RamsForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class AdminDashboardController extends Controller
{
    // Display the admin dashboard
    public function index()
    {
        $forms = RamsForm::orderBy('today_date', 'desc')->get();
        return view('dashboard', compact('forms'));
    }

    // Download PDF
    public function download($id)
    {
        $form = RamsForm::findOrFail($id);
        $pdf = Pdf::loadView('pdf.form', compact('form'));
        return $pdf->download('RAMS_Form_' . $form->id . '.pdf');
    }

public function updateStatus(Request $request, $id)
{
    $form = RamsForm::findOrFail($id);
    $form->status = $request->status;
    $form->save();

    // Make sure the email field exists and is valid
    if (!empty($form->email_form)) {
        Mail::to($form->email_form)->send(new \App\Mail\StatusNotificationMail($form));
    }

    return response()->json(['success' => true]);
}


}
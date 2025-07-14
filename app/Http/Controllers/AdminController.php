<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\RamsForm;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\StatusNotificationMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function dashboard()
    {
        $forms = RamsForm::orderBy('today_date', 'desc')->get(); // sorted latest first
        return view('livewire.dashboard', compact('forms'));
    }

    /**
     * Show admin registration form
     */
    public function showRegisterForm()
    {
        return view('auth.register-admin');
    }

    /**
     * Handle admin registration logic
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('form.login-admin')->with('success', 'Admin registered successfully.');
    }

    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    /**
     * Handle admin login logic
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    /**
     * Admin logout
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('form.login-admin');
    }

    /**
     * Download a specific form as PDF
     */
    public function download($id)
    {
        $form = RamsForm::findOrFail($id);
        $pdf = Pdf::loadView('pdf.form', compact('form'));
        return $pdf->download('RAMS_Form_' . $form->id . '.pdf');
    }
}
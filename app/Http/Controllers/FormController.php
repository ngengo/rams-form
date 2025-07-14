<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RamsForm;

class FormController extends Controller
{
    // Show the create form
    public function create()
    {
        return view('form.create');
    }

    // Handle form submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_no' => 'required|string|max:20',
            'email_form' => 'required|email|max:255',

            'club_name' => 'required|string|max:255',
            'person_name' => 'required|string|max:255',
            'today_date' => 'required|date',
            'activity_type' => 'required|string',
            'activity_date' => 'required|date',
            'activity_objective' => 'required|string',

            'cause_people' => 'required|string',
            'cause_equipment' => 'required|string',
            'cause_environment' => 'required|string',

            'manage_operation_people' => 'required|string',
            'manage_operation_equipment' => 'required|string',
            'manage_operation_environment' => 'required|string',
            'manage_emergency' => 'required|string',

            'relevant_standards' => 'required|string',
            'policies_guidelines' => 'required|string',
            'staff_skills' => 'required|string',

            'decision' => 'required|string|in:accept,reject',
            'comments' => 'required|string',
        ]);


        RamsForm::create($validated);

        return redirect()->route('home')->with('success', 'Form submitted!');
    }
}
@extends('layouts.app')

@section('header-right')
    <button class="header-button" onclick="window.location.href='{{ route('guideline') }}'">?</button>
    <button class="header-button" onclick="window.location.href='{{ route('login-admin') }}'">Admin</button>
@endsection

@section('content')
    <div class="form-container">
        <form id="ramsForm" method="POST" action="{{ route('form.store') }}">
            @csrf

            <table>
                <tr>
                    <td colspan="2">
                        <div class="input-with-label">
                            <span>Phone No:</span>
                            <input type="tel" name="phone_no" required>
                        </div>
                    </td>
                    <td colspan="6">
                        <div class="input-with-label">
                            <span>Email:</span>
                            <input type="email" name="email_form" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="input-with-label">
                            <span>Name of Club:</span>
                            <input type="text" name="club_name" required>
                        </div>
                    </td>
                    <td colspan="4">
                        <div class="input-with-label">
                            <span>Name of Person Filling This Form:</span>
                            <input type="text" name="person_name" required>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="date-box" id="todayDateBox">
                            <div class="date-label">Today's Date:</div>
                            <input type="date" name="today_date" id="today_date_input" class="date-input hidden"
                                value="{{ date('Y-m-d') }}" readonly required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="input-with-label">
                            <span>Type(s) of Activity:</span>
                            <input type="text" name="activity_type" required>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="date-box" id="activityDateBox">
                            <div class="date-label">Date of Activity:</div>
                            <input type="date" name="activity_date" id="activity_date_input" class="date-input hidden"
                                min="{{ date('Y-m-d') }}" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <div class="input-with-label">
                            <span>Aim/Objective of Activity:</span>
                            <input type="text" name="activity_objective" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" class="center">Analysis</th>
                    <th colspan="6" class="center">Description</th>
                </tr>
                <tr>
                    <td colspan="2"><b>RISKS</b><br>Accident, injury, other forms of loss</td>
                    <td colspan="6">
                        <textarea name="risks_description" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="2"><b>CAUSAL FACTORS</b><br>Hazards, perils, dangers</td>
                    <td colspan="2" class="center"><b>People</b></td>
                    <td colspan="2" class="center"><b>Equipment</b></td>
                    <td colspan="2" class="center"><b>Environment</b></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="cause_people" required></textarea>
                    </td>
                    <td colspan="2">
                        <textarea name="cause_equipment" required></textarea>
                    </td>
                    <td colspan="2">
                        <textarea name="cause_environment" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="1"><b>RISK<br>MANAGEMENT<br>STRATEGIES</b></td>
                    <td colspan="1">Normal Operation</td>
                    <td colspan="2">
                        <textarea name="manage_operation_people" required></textarea>
                    </td>
                    <td colspan="2">
                        <textarea name="manage_operation_equipment" required></textarea>
                    </td>
                    <td colspan="2">
                        <textarea name="manage_operation_environment" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">Emergency</td>
                    <td colspan="6">
                        <textarea name="manage_emergency" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>RELEVANT INDUSTRY STANDARDS APPLICABLE</b></td>
                    <td colspan="6">
                        <textarea name="relevant_standards" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>POLICIES AND GUIDELINES RECOMMENDED</b></td>
                    <td colspan="6">
                        <textarea name="policies_guidelines" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>SKILLS REQUIRED BY STAFF</b></td>
                    <td colspan="6">
                        <textarea name="staff_skills" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2"><b>FINAL DECISION ON<br>IMPLEMENTING ACTIVITY</b></td>
                    <td colspan="6" class="center"><b>Choose One</b></td>
                </tr>
                <tr>
                    <td colspan="6" class="center">
                        <div style="display: flex; gap: 220px; justify-content: center;">
                            <label><input type="radio" name="decision" value="accept" required> Accept</label>
                            <label><input type="radio" name="decision" value="reject" required> Reject</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="input-with-label">
                            <span>Comments:</span>
                            <input type="text" name="comments" required>
                        </div>
                    </td>
                </tr>
            </table>

            <button type="submit" class="submit-btn">SUBMIT</button>
        </form>
    </div>
@endsection


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const activityBox = document.getElementById('activityDateBox');
        const activityInput = document.getElementById('activity_date_input');

        const todayBox = document.getElementById('todayDateBox');
        const todayInput = document.getElementById('today_date_input');

        todayBox.addEventListener('click', function() {
            todayInput.classList.remove('hidden');
            todayInput.focus();
        });

        activityBox.addEventListener('click', function() {
            activityInput.classList.remove('hidden');
            activityInput.focus();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('ramsForm');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Submit Form?',
                text: "Please confirm that all details are correct.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'You have successfully submitted the form!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2800,
                    });

                    setTimeout(() => {
                        form.submit();
                    }, 2800);
                }
            });
        });
    });
</script>

<style>
    body {
        margin: 40px auto;
        padding: 30px;
        background-color: #eeeeee;
        font-family: 'Segoe UI', sans-serif;
    }

    .form-container {
        max-width: 1050px;
        margin: 0 auto;
        padding: 30px;
        background: white;
        border: 4px solid #c4c4c4;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 8px;
        vertical-align: center;
        text-align: left;
        height: 40px;
    }

    .input-with-label span {
        white-space: nowrap;
        font-weight: bold;
    }

    .input-with-label input {
        flex: 1;
        border: none;
        outline: none;
        font-size: 14px;
    }

    .date-box {
        padding: 2px;
        background-color: #fff;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        position: relative;
    }

    .date-label {
        font-weight: bold;
        font-size: 14px;
        pointer-events: none;
        margin-bottom: 4px;
    }

    .date-input {
        border: none;
        outline: none;
        font-size: 14px;
        background: transparent;
        padding: 0;
        margin-top: 2px;
    }

    .hidden {
        display: none;
    }

    .input-with-label-date input.hidden-date {
        display: none;
    }

    .input-with-label-date input.visible-date {
        display: block;
    }

    input[type="tel"],
    textarea {
        width: 100%;
        border: none;
        outline: none;
        font-size: 14px;
        padding-top: 8px;
        resize: vertical;
        font-family: 'Segoe UI', sans-serif;
    }

    input[type="email"],
    textarea {
        width: 100%;
        border: none;
        outline: none;
        font-size: 14px;
        padding-top: 8px;
        resize: vertical;
        font-family: 'Segoe UI', sans-serif;
    }

    input[type="text"],
    textarea {
        width: 100%;
        border: none;
        outline: none;
        font-size: 14px;
        padding-top: 8px;
        resize: vertical;
        font-family: 'Segoe UI', sans-serif;
    }

    textarea {
        min-height: 60px;
    }

    .submit-btn {
        display: block;
        margin: 30px auto 0;
        padding: 12px 40px;
        background-color: #28a745;
        color: white;
        font-weight: bold;
        font-size: 16px;
        border: none;
        border-radius: 30px;
        cursor: pointer;
    }

    .center {
        text-align: center;
    }

    .swal2-popup {
        font-family: 'Segoe UI', sans-serif;
        border-radius: 10px !important;
        padding: 0.5em 2em 2em 2em !important;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .swal2-title {
        color: #000000 !important;
        font-weight: bold;
        font-size: 24px;
    }

    .swal2-confirm,
    .swal2-cancel {
        border-radius: 10px !important;
        padding: 10px 25px;
        font-weight: bold;
    }
</style>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RAMS Form PDF</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }
        .heading {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="heading">OUTDOOR ACTIVITY RAMS FORM</div>

    <table>
        <tr>
            <td>
                <strong>Name of Club:</strong><br>
                {{ $form->club_name }}
            </td>
            <td>
                <strong>Name of Person Filling This Form:</strong><br>
                {{ $form->person_name }}
            </td>
            <td>
                <strong>Today's Date:</strong><br>
                {{ \Carbon\Carbon::parse($form->today_date)->format('d/m/Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Type(s) of Activity:</strong><br>
                {{ $form->activity_type }}
            </td>
            <td>
                <strong>Date of Activity:</strong><br>
                {{ \Carbon\Carbon::parse($form->activity_date)->format('d/m/Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>Aim/Objective of Activity:</strong><br>
                {{ $form->activity_objective }}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th rowspan="2">Analysis</th>
            <th colspan="3">Description</th>
        </tr>
        <tr>
            <th>People</th>
            <th>Equipment</th>
            <th>Environment</th>
        </tr>
        <tr>
            <td><strong>RISKS</strong><br>Accident, injury, other forms of loss</td>
            <td>{{ $form->cause_people }}</td>
            <td>{{ $form->cause_equipment }}</td>
            <td>{{ $form->cause_environment }}</td>
        </tr>
        <tr>
            <td><strong>CAUSAL FACTORS</strong><br>Hazards, perils, dangers</td>
            <td>{{ $form->cause_people }}</td>
            <td>{{ $form->cause_equipment }}</td>
            <td>{{ $form->cause_environment }}</td>
        </tr>
        <tr>
            <td><strong>RISK MANAGEMENT STRATEGIES</strong><br>Normal Operation</td>
            <td>{{ $form->manage_operation_people }}</td>
            <td>{{ $form->manage_operation_equipment }}</td>
            <td>{{ $form->manage_operation_environment }}</td>
        </tr>
        <tr>
            <td><strong>RISK MANAGEMENT STRATEGIES</strong><br>Emergency</td>
            <td colspan="3">{{ $form->manage_emergency }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td><strong>Relevant Industry Standards Applicable:</strong><br>{{ $form->relevant_standards }}</td>
        </tr>
        <tr>
            <td><strong>Policies and Guidelines Recommended:</strong><br>{{ $form->policies_guidelines }}</td>
        </tr>
        <tr>
            <td><strong>Skills Required by Staff:</strong><br>{{ $form->staff_skills }}</td>
        </tr>
        <tr>
            <td>
                <strong>Final Decision on Implementing Activity:</strong><br>{{ $form->decision }}<br><br>
                <strong>Comments:</strong><br>{{ $form->comments }}
            </td>
        </tr>
    </table>

</body>
</html>
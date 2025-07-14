@extends('layouts.app')

@section('header-right')
    <button class="header-button" onclick="window.location.href='{{ url()->previous() ?? route('home') }}'">Back</button>
@endsection

@section('content')
    <div class="uap-guide-container">
        <h3>HOW TO USE RAMS UAP</h3>
        <ol>
            <li>
                <strong>Identify Potential Risks:</strong><br>
                List all accidents or incidents (risks) you want to prevent for each UAP activity — including flying fox,
                abseiling, rock climbing, rafting, glamping, and hiking. Number them for easier tracking.
            </li>
            <li>
                <strong>Determine Causal Factors:</strong><br>
                For each risk, identify the contributing factors under these categories:
                <ul>
                    <li><strong>People:</strong> skill level, fatigue, behavior</li>
                    <li><strong>Equipment:</strong> harnesses, ropes, rafts, helmets, etc.</li>
                    <li><strong>Environment:</strong> weather, terrain, wildlife</li>
                </ul>
                <em>Tip: Match causal factors with each specific risk identified.</em>
            </li>
            <li>
                <strong>Plan Risk Control Strategies:</strong><br>
                Develop strategies to minimize each risk to an acceptable level. Use one or more of the following
                approaches:
                <ul>
                    <li>Reduce the likelihood or severity</li>
                    <li>Avoid the risk altogether if too great</li>
                    <li>Transfer the risk (e.g., through insurance or trained guides)</li>
                    <li>Retain the risk if manageable with proper planning</li>
                </ul>
                This forms your normal operation plan for each activity.
            </li>
            <li>
                <strong>Prepare for Emergencies:</strong><br>
                Pre-plan emergency responses for each activity. Detail steps to take if a risk becomes real.<br>
                <em>Example: What to do if a participant gets injured during abseiling or lost while hiking.</em>
            </li>
            <li>
                <strong>Refer to Standards:</strong><br>
                Follow any applicable industry standards or training guidelines.<br>
                <em>Example: Use certified safety equipment for flying fox and rock climbing; follow national water safety
                    standards for rafting.</em>
            </li>
            <li>
                <strong>Apply UAP-Specific Policies:</strong><br>
                Use procedures specific to UPSI Adventure Park.<br>
                <em>Example: Radio check-ins every hour, group headcounts after each activity, and pre-activity site
                    inspections by leaders.</em>
            </li>
            <li>
                <strong>List Required Leader Skills:</strong><br>
                Document the essential qualifications and skills for leaders/instructors conducting each activity to ensure
                safe operations.
            </li>
        </ol>
    </div>

    <div class="uap-guide-container">
        <h3>WHEN TO USE RAMS AT UAP?</h3>
        <p>
            RAMS must be completed for every event and individual activity held at UPSI Adventure Park.
            Separate RAMS forms should be created for each distinct activity.
        </p>
        <ul>
            <li><strong>Example 1:</strong> For a general outdoor adventure day, create separate RAMS for flying fox,
                abseiling, and hiking.
            </li>
            <li><strong>Example 2:</strong> For an overnight event, prepare individual RAMS for glamping, rafting, and any
                evening or
                next-day hiking.</li>
            <li><strong>Example 3:</strong> For rock climbing training sessions, complete a dedicated RAMS covering wall
                condition, gear
                safety checks, and participant readiness.</li>
        </ul>
    </div>
@endsection

@section('styles')
    <style>
        .header-button {
            background-color:#1a4593;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            color: #ffffff;
        }

        .uap-guide-container {
            max-width: 1050px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 20px;
            border: 4px solid #c4c4c4;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', sans-serif;
            color: black;
        }

        .uap-guide-container h3 {
            text-align: center;
            color: black;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .uap-guide-container ol li::marker {
            font-weight: bold;
        }

        .uap-guide-container ol li {
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .uap-guide-container ul li {
            line-height: 1.6;
            list-style-type: disc;
        }

        .uap-guide-container ol ul li {
            margin-top: 10px;
            margin-bottom: 8px;
            line-height: 1.0;
            list-style-type: disc;
        }

        .uap-section {
            background-color: #f4f4f4;
            border-radius: 15px;
            padding: 20px;
            margin-top: 40px;
        }
    </style>
@endsection

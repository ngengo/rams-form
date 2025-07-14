<!DOCTYPE html>
<html>
<head>
    <title>Status Notification</title>
</head>
<body>
    <h2>RAMS System Notification</h2>
    <p>Your form has been reviewed.</p>
    <p><strong>Status:</strong> {{ $status }}</p>
    <p><strong>Activity:</strong> {{ $activity }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</p>
    <br>
    <p>Thank you.</p>
</body>
</html>
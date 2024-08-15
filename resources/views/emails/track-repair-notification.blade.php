<!-- resources/views/emails/track-repair-notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Repair Request Update</title>
</head>
<body>
    <h1>Repair Request Update</h1>
    <p>Your repair request with reference number {{ $repairRequest->reference }} has been updated.</p>
    <p>Status: {{ $repairRequest->status }}</p>
    <p>For more details, please contact us.</p>
</body>
</html>
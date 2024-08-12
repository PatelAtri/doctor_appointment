<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <p>Dear {{ $appointmentData['name'] }},</p>
    <p>Your appointment is scheduled on {{ $appointmentData['date'] }} at {{ $appointmentData['time'] }}.</p>
    <p>Thank you!</p>
</body>
</html>
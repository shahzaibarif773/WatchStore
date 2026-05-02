<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #0f172a; line-height: 1.6;">
    <h2>New Contact Form Message</h2>

    <p><strong>Name:</strong> {{ $payload['name'] }}</p>
    <p><strong>Email:</strong> {{ $payload['email'] }}</p>
    <p><strong>Subject:</strong> {{ $payload['subject'] }}</p>

    <h3>Message</h3>
    <p>{{ $payload['message'] }}</p>
</body>
</html>

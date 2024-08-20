<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Disabled</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px;">
        <h2 style="text-align: center; color: #cc0000;">Account Disabled</h2>
        <p style="font-size: 16px; color: #555555;">
            Hello, {{ $user->first_name }},
        </p>
        <p style="font-size: 16px; color: #555555;">
            We regret to inform you that your account has been disabled. If you believe this is a mistake or would like
            to discuss the matter further, please contact our support team.
        </p>
        <p style="text-align: center;">
            <a href="mailto:support@example.com"
                style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 5px;">
                Contact Support
            </a>
        </p>
        <p style="font-size: 16px; color: #555555;">
            We apologize for any inconvenience this may cause and look forward to assisting you.
        </p>
        <p style="font-size: 16px; color: #555555;">
            Regards,<br>
            {{ config('app.name') }} Team
        </p>
    </div>
</body>

</html>

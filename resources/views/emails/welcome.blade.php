<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px;">
        <h2 style="text-align: center; color: #333333;">Verify Your Email Address</h2>
        <p style="font-size: 16px; color: #555555;">
            Hello, {{ $user->name }},
        </p>
        <p style="font-size: 16px; color: #555555;">
            Thank you for registering with us! Please click the button below to verify your email address and complete
            your registration.
        </p>
        <p style="text-align: center;">
            <a href="{{ route('email.validation', ['id' => $user->id, 'hash' => sha1($user->id . $user->email . $user->created_at)]) }}"
                style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #28a745; text-decoration: none; border-radius: 5px;">
                Verify Email Address
            </a>
        </p>
        <p style="font-size: 16px; color: #555555;">
            If you did not create an account, no further action is required.
        </p>
        <p style="font-size: 16px; color: #555555;"> 
            Regards,<br>
            {{ config('app.name') }} Team
        </p>
        <hr style="border: none; border-top: 1px solid #dddddd; margin: 20px 0;">
        <p style="font-size: 14px; color: #aaaaaa; text-align: center;">
            If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your
            web browser:
        </p>
        <p style="font-size: 14px; color: #28a745; word-break: break-all; text-align: center;">
            {{ route('email.validation', ['id' => $user->id, 'hash' => sha1($user->id . $user->email . $user->created_at)]) }}
        </p>
    </div>
</body>

</html>

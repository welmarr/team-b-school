<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activated</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px;">
        <h2 style="text-align: center; color: #28a745;">Account Activated</h2>
        <p style="font-size: 16px; color: #555555;">
            Hello, {{ $user->name }},
        </p>


        @if (is_null($user->email_verified_at))
            <p style="font-size: 16px; color: #555555;">
                Your account has been successfully activated. However, to fully access all features, please verify your
                email address by clicking the button below.
            </p>
            <p style="text-align: center;">
                <a href="{{ route('email.validation', ['id' => $user->id, 'hash' => sha1($user->id . $user->email . $user->created_at)]) }}"
                    style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 5px;">
                    Verify Email Address
                </a>
            </p>
            <p style="font-size: 16px; color: #555555;">
                If you're having trouble clicking the button, copy and paste the URL below into your web browser:
            </p>
            <p style="font-size: 14px; color: #007bff; word-break: break-all; text-align: center;">
                {{ route('email.validation', ['id' => $user->id, 'hash' => sha1($user->id . $user->email . $user->created_at)]) }}
            </p>
        @else
            <p style="font-size: 16px; color: #555555;">
                Your account has been successfully activated, and your email address is already verified. You can now
                log in and start using our services.
            </p>
            <p style="text-align: center;">
                <a href="{{ route('login') }}"
                    style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #28a745; text-decoration: none; border-radius: 5px;">
                    Log In to Your Account
                </a>
            </p>
        @endif

        <p style="font-size: 16px; color: #555555;">
            If you encounter any issues or need further assistance, feel free to reach out to our support team.
        </p>
        <p style="font-size: 16px; color: #555555;">
            Regards,<br>
            {{ config('app.name') }} Team
        </p>
    </div>
</body>

</html>

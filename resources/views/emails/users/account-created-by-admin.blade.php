<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation & Email Verification</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px;">
        <h2 style="text-align: center; color: #333333;">Your Account Has Been Activated!</h2>

        <p style="font-size: 16px; color: #555555;">
            Hello, {{ $user->first_name }},
        </p>

        <p style="font-size: 16px; color: #555555;">
            We are excited to inform you that your account has been created and activated by our admin team. To complete
            the setup of your account, please verify your email address by clicking the button below.
        </p>

        <p style="text-align: center;">
            <a href="{{ route('email.validation', ['id' => $user->id, 'hash' => sha1($user->id . $user->email . $user->created_at)]) }}"
                style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 5px;">
                Verify Email Address
            </a>
        </p>

        <p style="font-size: 16px; color: #555555;">
            Once your email is verified, you'll be able to access your account using the following credentials:
        </p>

        <p style="font-size: 16px; color: #555555;">
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>Password:</strong> <strong>{{ $generated_password}}</strong>
        </p>

        <p style="font-size: 16px; color: #555555;">
            Please make sure to change your password after your first login for security reasons.
        </p>

        <p style="font-size: 16px; color: #555555;">
            If you did not request an account or believe this was done in error, please contact our support team
            immediately.
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

        <p style="font-size: 14px; color: #007bff; word-break: break-all; text-align: center;">
            {{ route('email.validation', ['id' => $user->id, 'hash' => sha1($user->id . $user->email . $user->created_at)]) }}
        </p>
    </div>
</body>

</html>

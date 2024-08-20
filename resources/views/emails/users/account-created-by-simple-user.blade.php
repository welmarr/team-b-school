<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #fb4f14;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
            line-height: 1.6;
        }

        .content h2 {
            color: #333333;
        }

        .content p {
            color: #666666;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 16px;
            color: #ffffff;
            text-decoration: none;
            background-color: #28a745;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Verify Your Email</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $user->first_name }},</h2>
            <p>Thank you for creating an account with us! To complete the registration process, we need to verify your
                email address.</p>
            @isset($user->dealership)
                <p>Your account has been added under the following dealership:</p>
                <p><strong>Dealership Code:</strong> {{ $user->dealership->code }}</p>
                <p><strong>Dealership Name:</strong> {{ $user->dealership->name }}</p>
            @endisset
            <p>Please click the button below to verify your email:</p>
            <a href="{{ route('email.validation', ['id' => $user->id, 'hash' => sha1($user->id . $user->email . $user->created_at)]) }}"
                class="button">Verify My Email</a>
            <p>After verifying your email, we will activate your account within 2 days at most. You will receive a
                confirmation email once your account is active.</p>
            <p>If you did not create this account, please disregard this email or contact our support team immediately.
            </p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Your Company Name. All rights reserved.</p>
            <p>If you have any questions, feel free to contact us at support@yourcompany.com.</p>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Request Canceled</title>
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
            background-color: #dc3545;
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
            <h1>Repair Request Canceled</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $demand->createdBy->first_name }},</h2>
            <p>We have received your request to cancel the repair estimation for your vehicle. Your request reference is
                <strong>{{ $demand->reference }}</strong>. Your request has been successfully canceled.</p>
            <h3>Need Further Assistance?</h3>
            <p>If you have any questions or if this cancellation was made in error, please contact us as soon as possible. We are here to assist you with any concerns or to help you reschedule the repair.</p>
            <p>We appreciate your consideration and hope to have the opportunity to assist you in the future.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Cincy Dent Repair. All rights reserved.</p>
            <p>If you have any concerns, please feel free to contact us.</p>
        </div>
    </div>
</body>
</html>

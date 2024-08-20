<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Estimation Accepted</title>
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
            background-color: #4CAF50;
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
            <h1>Repair Estimation Accepted</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $demand->createdBy->first_name }},</h2>
            <p>Thank you for accepting the repair estimation for your vehicle. Your request reference is
                <strong>{{ $demand->reference }}</strong>. You have successfully completed this step, and the next one
                involves scheduling an appointment.
            </p>
            <h3>Next Steps</h3>
            <p>You can either call us directly or click the button below to schedule an appointment at your convenience.
                Please select a date that works best for you to drop off your vehicle.</p>
            <div class="" style="display: flex !important; justify-content: center; !important;">
                <a href="{{ route('track-repair.view', ['reference' => $demand->reference]) }}" class="button"  style="color: #ffffff !important;">Schedule
                    Appointment</a>
            </div>
            <p>We’re here to accommodate your schedule and ensure a smooth service experience.</p>
            <p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>
            <p>Thank you for choosing our services. We look forward to delivering the best results for your vehicle.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Cincy Dent Repair. All rights reserved.</p>
            <p>If you have any concerns, please feel free to contact us.</p>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Completed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .email-header h1 {
            font-size: 24px;
            color: #007bff;
        }

        .email-content {
            padding: 20px;
        }

        .email-content p {
            line-height: 1.6;
            font-size: 16px;
        }

        .email-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #666;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Request Completed</h1>
        </div>
        <div class="email-content">
            <p>Dear {{ $demand->createdBy->first_name }},</p>
            <p>We are pleased to inform you that your request with reference number
                <strong>{{ $demand->reference }}</strong> has been successfully completed.</p>
            <p>Details of your request:</p>
            <ul>
                <li><strong>Estimation:</strong> {{ $demand->reference }}</li>
                <li><strong>Vehicle:</strong> {{ $demand->car->brand->name }} {{ $demand->car->model->name }} ({{ $demand->car->year }})</li>
                <li><strong>Completion Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</li>
            </ul>
            <p>You can now come to our facility to pick up your vehicle at your earliest convenience.</p>
            <p>If you have any further questions or require additional assistance, please feel free to reach out to us.
            </p>
            <p>Thank you for choosing our services!</p>
            <a href="{{ route('track-repair.view', ['reference' => $demand->reference]) }}" class="btn">View Your Request</a>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Cincy Dent Repair. All rights reserved.</p>
        </div>
    </div>
</body>

</html>

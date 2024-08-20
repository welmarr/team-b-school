<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dent Repair Request Received</title>
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
            <h1>Dent Repair Request Received</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $demand->createdBy->first_name }},</h2>
            <p>Thank you for submitting your dent repair request. We have received your request and our team is now
                reviewing the details.</p>
            <h3>Request Summary</h3>
            <p><strong>Reference Number:</strong> {{ $demand->reference }}</p>
            <p><strong>Vehicle:</strong> {{ $demand->car->brand->name }} {{ $demand->car->model->name }}
                ({{ $demand->car->year }})</p>
            <p><strong>Request Date:</strong> {{ $demand->created_at->format('F j, Y') }}</p>
            <p>Our team will assess your request and provide an estimation as soon as possible. You will receive another
                email with the estimation details shortly. You can also track the status of your request with this <a
                    href="{{ route('track-repair.view', ['reference' => $demand->reference]) }}"
                    style="color: text-decoration-color: #fb4f14">link</a></p>
            <p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Cincy Dent Repair. All rights reserved.</p>
            <p>If you did not make this request, please contact us immediately.</p>
        </div>
    </div>
</body>

</html>

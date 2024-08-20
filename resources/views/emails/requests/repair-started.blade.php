<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Work Started</title>
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
            <h1>Repair Work Started</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $demand->createdBy->first_name }},</h2>
            <p>We are pleased to inform you that we have started working on the repair of your vehicle.</p>
            <p><strong>Reference Number:</strong> {{ $demand->reference }}</p>
            <p>Our team is committed to ensuring that the repair is completed with the highest quality standards. We
                will keep you informed of the progress and notify you once the work is finished.</p>
            <p>If you have any questions or need further information, please do not hesitate to contact us. We
                appreciate your trust in our services and look forward to delivering your vehicle in top condition.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Cincy Dent Repair. All rights reserved.</p>
            <p>If you have any concerns or inquiries, feel free to reach out to us at any time.</p>
        </div>
    </div>
</body>

</html>

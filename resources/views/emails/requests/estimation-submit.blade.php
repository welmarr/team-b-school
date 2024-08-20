<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Estimation</title>
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
            margin: 10px 5px;
            font-size: 16px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-accept {
            background-color: #28a745;
        }

        .button-cancel {
            background-color: #dc3545;
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
            <h1>Repair Estimation</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $demand->createdBy->first_name }},</h2>
            <p>We have reviewed your request for vehicle dent repair and are pleased to provide you with an estimation.
            </p>
            <h3>Estimation Details</h3>
            <p><strong>Request reference:</strong> {{ $demand->reference }}</p>
            <p><strong>Estimated Budget:</strong> ${{ $demand->estimation }}</p>
            <p><strong>Expected Completion Time:</strong> {{ $demand->finish_by }} days</p>
            <p>Please review the estimation details carefully. If you have any questions or need further information,
                feel free to contact us.</p>
            <h3>What Happens Next?</h3>
            <p>You can choose to accept or cancel this estimation by clicking one of the buttons below:</p>
            <div class="" style="display: flex !important; justify-content: center; !important;">
                <a href="{{ route('request.estimation.accepted', ['reference' => $demand->reference]) }}"
                    class="button button-accept" style="color: #ffffff !important;">Accept Estimation</a>
                <a href="{{ route('request.estimation.canceled', ['reference' => $demand->reference]) }}"
                    class="button button-cancel"  style="color: #ffffff !important;">Cancel Estimation</a>
            </div>
            <p>Thank you for choosing our service. We look forward to helping you restore your vehicle to its best
                condition.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Cincy Dent Repair. All rights reserved.</p>
            <p>If you did not request this service, please disregard this email or contact us immediately.</p>
        </div>
    </div>
</body>

</html>

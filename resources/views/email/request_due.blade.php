<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Overdue Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #d9534f;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .header img {
            max-width: 50px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 0;
        }

        .content {
            padding: 20px;
            color: #333;
        }

        .content h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #d9534f;
        }

        .content .details {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .details-row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #d9534f;
        }

        .value {
            color: #555;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #aaa;
        }

        .footer a {
            color: #d9534f;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content h2 {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>ETMS - Overdue Request</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Hello {{ $request->user->name ?? 'User' }},</h2>
            <p>Your request is now overdue. Please return the equipment as soon as possible.</p>

            <!-- Request Details -->
            <div class="details">
                <div class="details-row">
                    <div class="label">Request ID:</div>
                    <div class="value">{{ $request->id }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Request Date:</div>
                    <div class="value">{{ $request->getFormattedRequestDateAttribute() }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Return Date:</div>
                    <div class="value">{{ $request->return_date ? \Carbon\Carbon::parse($request->return_date)->format('F j, Y, g:i A') : 'N/A' }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Current Status:</div>
                    <div class="value"><strong>{{ $request->status }}</strong></div>
                </div>
            </div>

            <p>Please take immediate action. If you have any questions, contact support.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© 2025 ETMS | <a href="{{ url('/') }}">Visit Our Website</a></p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Order Update</title>
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
            background-color: #0f5630;
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
            color: #0f5630;
        }

        .details {
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
            color: #0f5630;
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
            color: #0f5630;
            text-decoration: none;
        }

        .cancelled {
            padding: 10px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 2px;
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
            <img src="{{ url('images/sksu_logo.png') }}" alt="SKSU Logo">
            <h1>ETMS</h1>
            <p>Equipment Tracking Management System</p>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Hello {{ $jobOrder->user->name ?? 'User' }},</h2>
            <p>We have an update regarding your job order:</p>

            <!-- Job Order Details -->
            <div class="details">
                <div class="details-row">
                    <div class="label">Job Order ID</div>
                    <div class="value">{{ $jobOrder->id }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Status</div>
                    <div class="value">{{ $jobOrder->status }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Title</div>
                    <div class="value">{{ $jobOrder->title }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Description</div>
                    <div class="value">{{ $jobOrder->description }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Assignee</div>
                    <div class="value">{{ $jobOrder->assignee->name ?? 'N/A' }}</div>
                </div>
                <div class="details-row">
                    <div class="label">Official Date</div>
                    <div class="value">{{ $jobOrder->request_date ?? 'N/A' }}</div>
                </div>
            </div>

            @if($jobOrder->status == 'Cancelled')
            <p class="text-c">Reason for Cancellation:</p>
            <div class="cancelled">
                {{ $jobOrder->status_reason ?? 'No reason provided.' }}
            </div>
            @endif

            <p>If you have any questions or need further assistance, feel free to contact us.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>SKSU Equipment Management System</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Update</title>
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
            background-color: #106c3b;
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
            color: #106c3b;
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
            margin-right: 4px;
            color: #106c3b;
        }

        .value {
            color: #555;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th, .items-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .items-table th {
            background-color: #106c3b;
            color: white;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #aaa;
        }

        .footer a {
            color: #106c3b;
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

            .items-table th, .items-table td {
                font-size: 12px;
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
            <h2>Hello [Recipient Name],</h2>
            <p>We have an update regarding your request:</p>

            <!-- Request Details -->
            <div class="details">
                <div class="details-row">
                    <div class="label">Request Status</div>
                    <div class="value">Approved</div>
                </div>
                <div class="details-row">
                    <div class="label">Request Date</div>
                    <div class="value">January 15, 2024</div>
                </div>
                <div class="details-row">
                    <div class="label">Pickup Date</div>
                    <div class="value">January 20, 2024</div>
                </div>
                <div class="details-row">
                    <div class="label">Purpose</div>
                    <div class="value">Classroom Equipment Usage</div>
                </div>
            </div>

            <h2>Items Included:</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Equipment Name</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Projector</td>
                        <td>Reserved</td>
                        <td>1</td>
                        <td>Room 101</td>
                    </tr>
                    <tr>
                        <td>Whiteboard</td>
                        <td>Available</td>
                        <td>2</td>
                        <td>Room 102</td>
                    </tr>
                </tbody>
            </table>

            <p>If you have any questions or need further assistance, feel free to contact us.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>SKSU Equipment Management System</p>
           
        </div>
    </div>
</body>
</html>

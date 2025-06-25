<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to Bridge HR System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Helvetica', sans-serif;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            padding: 32px;
        }

        .header {
            background-color: #0f172a;
            color: #fff;
            padding: 24px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
        }

        .content {
            padding: 24px;
            color: #334155;
        }

        .content h2 {
            font-size: 22px;
            margin-bottom: 16px;
        }

        .info-box {
            background-color: #f1f5f9;
            border-left: 4px solid #3b82f6;
            padding: 16px;
            margin-bottom: 16px;
            border-radius: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #1e293b;
        }

        .footer {
            text-align: center;
            padding-top: 24px;
            font-size: 14px;
            color: #94a3b8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Bridge HR System</h1>
        </div>

        <div class="content">
            <h2>Welcome, {{ $user->name }} 👋</h2>

            <div class="info-box">
                <div><span class="info-label">Email:</span> {{ $user->email }}</div>
            </div>

            <div class="info-box">
                <div><span class="info-label">Password:</span> {{ $password }}</div>
            </div>
           

            <p>We're excited to have you on board! You can now log in using your credentials above.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Bridge HR System. All rights reserved.
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your LMS Login OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 24px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #3e7ac2;
        }
        .body {
            padding-top: 20px;
        }
        .otp-box {
            display: inline-block;
            padding: 18px 26px;
            margin: 16px 0;
            background: #f1f5f9;
            border-radius: 14px;
            font-size: 28px;
            letter-spacing: 6px;
            color: #1e3a8a;
            font-weight: 700;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #475569;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LMS OTP Login</h1>
        </div>
        <div class="body">
            <p>Hi {{ $user->name }},</p>
            <p>Use the verification code below to complete your LMS login. This code will expire in 10 minutes.</p>
            <div class="otp-box">{{ $otp }}</div>
            <p>If you did not request this login code, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>Thank you,<br>LMS Team</p>
        </div>
    </div>
</body>
</html>

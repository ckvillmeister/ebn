<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .content {
            padding: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome, {{ $data['name'] }}</h1>
    </div>
    <div class="content">
        <p>Hi {{ $data['name'] }},</p>
        <p>Thank you for registering on our platform. We are excited to have you on board.</p>
        <p>You can now explore request Fire Safety Monitoring Report, Fire Safety Prevention Quotation, etc. If you have any questions, feel free to reach out {{ $data['business_name'] }}.</p>
        <p>Username: {{ $data['email'] }}</p>
        <p>Password: {{ $data['password'] }}</p>
        <p>Best Regards,</p>
        <p><strong>{{ $data['business_name'] }}</strong></p>
    </div>
    <div class="footer">
        <p>© {{ now()->year }} {{ $data['business_name'] }}. All rights reserved.</p>
    </div>
</body>
</html>

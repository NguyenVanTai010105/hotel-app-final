<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã OTP Xác Thực</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 40px 30px;
            text-align: center;
        }

        .content p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .otp-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 8px;
            padding: 20px 40px;
            border-radius: 8px;
            display: inline-block;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }

        .info {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 30px 0;
            text-align: left;
        }

        .info p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .warning {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🔐 Xác Thực Tài Khoản</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Xin chào,</p>
            <p>Bạn đã yêu cầu xác thực tài khoản. Vui lòng sử dụng mã OTP dưới đây:</p>

            <!-- OTP Box -->
            <div class="otp-box">
                {{ $otp }}
            </div>

            <!-- Info Box -->
            <div class="info">
                <p><strong>⏰ Thời gian hiệu lực:</strong> 10 phút</p>
                <p><strong>🔒 Bảo mật:</strong> Không chia sẻ mã này với bất kỳ ai</p>
            </div>

            <p class="warning">
                ⚠️ Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email này.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Email này được gửi tự động, vui lòng không trả lời.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>

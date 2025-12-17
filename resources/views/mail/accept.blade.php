<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Phòng Thành Công</title>
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
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
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
            margin-bottom: 20px;
        }

        .success-box {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            color: #ffffff;
            font-size: 22px;
            font-weight: bold;
            padding: 18px 30px;
            border-radius: 8px;
            display: inline-block;
            margin: 25px 0;
            box-shadow: 0 4px 8px rgba(56, 161, 105, 0.3);
        }

        .info {
            background-color: #f8f9fa;
            border-left: 4px solid #38a169;
            padding: 18px;
            margin: 30px 0;
            text-align: left;
        }

        .info p {
            margin: 6px 0;
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
    </style>
</head>

<body>
    <div class="email-container">

        <!-- Header -->
        <div class="header">
            <h1>🏨 Đặt Phòng Thành Công</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Xin chào <strong>{{ $booking->user->name }}</strong>,</p>

            <p>Yêu cầu đặt phòng của bạn đã được <strong>xác nhận thành công</strong>.
                Chúng tôi rất hân hạnh được phục vụ bạn!</p>

            <!-- Success Box -->
            <div class="success-box">
                ✅ Đặt phòng thành công
            </div>

            <!-- Info -->
            <div class="info">
                <p><strong>🏠 Phòng:</strong> {{ $booking->room->name ?? 'Phòng 101' }}</p>
                <p><strong>📅 Check-in:</strong> {{ $booking->start_date ?? '2025-12-20' }}</p>
                <p><strong>📅 Check-out:</strong> {{ $booking->end_date ?? '2025-12-22' }}</p>
                <p><strong>📧 Email:</strong> {{ $booking->email ?? '' }}</p>
            </div>

            <p>
                Vui lòng đến đúng thời gian đã đặt.
                Nếu cần hỗ trợ thêm, đừng ngần ngại liên hệ với chúng tôi.
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

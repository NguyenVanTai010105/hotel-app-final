<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>


<body style="font-family: Arial">

    <h2>📩 Liên hệ mới từ website</h2>

    <p><strong>Họ tên:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <hr>

    <p><strong>Nội dung:</strong></p>
    <p>{{ $data['message'] }}</p>

    <hr>
    <p style="font-size:12px;color:#666">
        Email được gửi từ form Contact Us
    </p>

</body>


</html>

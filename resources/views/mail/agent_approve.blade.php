<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p>Hello {{ $data['name'] }},</p>

<p>Your temporary password is:</p>
<div style="background:#f1f1f1; padding:15px; font-weight:bold; text-align:center;">
    {{ $data['password'] }}
</div>

<p>
    <a href="{{ url('/login') }}" target="_blank"
       style="background:#2563eb; color:#fff; padding:10px 20px; text-decoration:none; border-radius:5px;">
       Login Now
    </a>
</p><p>Thank you for being a part of our community!</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact form</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; padding:30px; border-radius:8px;">

                    <tr>
                        <td>
                            <h2 style="margin-top:0;">New message from the website contact form</h2>
                            <p style="color:#555;">Use <strong>Reply</strong> in your email app to answer this person directly.</p>

                            <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">

                            <p><strong>Name:</strong> {{ $payload['name'] }}</p>
                            <p><strong>Email:</strong> <a href="mailto:{{ $payload['email'] }}">{{ $payload['email'] }}</a></p>
                            @if(!empty($payload['phone']))
                                <p><strong>Phone:</strong> {{ $payload['phone'] }}</p>
                            @endif

                            <p><strong>Message:</strong></p>
                            <p style="white-space:pre-wrap; background:#f8fafc; padding:12px; border-radius:6px;">{{ $payload['message'] }}</p>

                            @if(!empty($adminViewUrl))
                                <div style="text-align:center; margin:24px 0;">
                                    <a href="{{ $adminViewUrl }}"
                                       style="background:#ea580c; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:5px; display:inline-block;">
                                        Open in admin panel
                                    </a>
                                </div>
                            @endif

                            <p style="font-size:12px; color:#777;">
                                {{ config('app.name') }} — contact page submission (also stored in admin).
                            </p>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>

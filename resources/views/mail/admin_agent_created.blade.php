<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; padding:30px; border-radius:8px;">
                    <tr>
                        <td>
                            <h2 style="margin-top:0;">New agent created</h2>
                            <p>A new agent account was created from the admin panel.</p>
                            <p><strong>Name:</strong> {{ $data['name'] }}</p>
                            <p><strong>Email:</strong> {{ $data['email'] }}</p>
                            <p><strong>Phone:</strong> {{ $data['phone'] ?? '—' }}</p>
                            <p style="text-align:center; margin:24px 0;">
                                <a href="{{ url('/admin/agents') }}"
                                   style="background:#2563eb; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:5px; display:inline-block;">
                                    Open agents in admin
                                </a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

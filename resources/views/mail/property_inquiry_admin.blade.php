<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New property inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; padding:30px; border-radius:8px;">

                    <tr>
                        <td>
                            <h2 style="margin-top:0;">New property inquiry (website)</h2>
                            <p>Hello,</p>
                            <p>A visitor submitted the contact form on a property page. <strong>Reply to this email</strong> to contact the buyer directly (Reply-To is set to their address).</p>

                            <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">

                            <p><strong>Assigned agent:</strong> {{ $inquiry->agent?->name ?? '—' }} ({{ $inquiry->agent?->email ?? '—' }})</p>
                            <p><strong>Property:</strong> {{ $inquiry->property?->title ?? '— General / no listing' }}</p>
                            @if($inquiry->property)
                                <p><strong>Location:</strong> {{ $inquiry->property->location }}, {{ $inquiry->property->city }}</p>
                            @endif

                            <p><strong>Buyer:</strong> {{ $inquiry->name }}</p>
                            <p><strong>Email:</strong> <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></p>
                            @if($inquiry->phone)
                                <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
                            @endif

                            <p><strong>Message:</strong></p>
                            <p style="white-space:pre-wrap; background:#f8fafc; padding:12px; border-radius:6px;">{{ $inquiry->message }}</p>

                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ $leadUrl }}"
                                   style="background:#ea580c; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:5px; display:inline-block;">
                                    Open lead in admin CRM
                                </a>
                            </div>

                            <p style="font-size:12px; color:#777;">
                                {{ config('app.name') }} — automated notification.
                            </p>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>

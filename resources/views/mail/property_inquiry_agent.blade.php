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
                            <h2 style="margin-top:0;">New inquiry on your listing</h2>
                            <p>Hello {{ $inquiry->agent?->name ?? 'there' }},</p>
                            <p>Someone contacted you through the website about a property. <strong>Reply to this email</strong> to respond directly to the buyer — your mail app will address them automatically.</p>

                            <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">

                            <p><strong>Property:</strong> {{ $inquiry->property?->title ?? '—' }}</p>
                            @if($inquiry->property)
                                <p><strong>Location:</strong> {{ $inquiry->property->location }}, {{ $inquiry->property->city }}</p>
                                <p><strong>Price:</strong> Rs. {{ number_format((float) $inquiry->property->price) }}</p>
                            @endif

                            <p><strong>From:</strong> {{ $inquiry->name }}</p>
                            <p><strong>Email:</strong> <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></p>
                            @if($inquiry->phone)
                                <p><strong>Phone:</strong> <a href="tel:{{ preg_replace('/\s+/', '', $inquiry->phone) }}">{{ $inquiry->phone }}</a></p>
                            @endif

                            <p><strong>Message:</strong></p>
                            <p style="white-space:pre-wrap; background:#f8fafc; padding:12px; border-radius:6px;">{{ $inquiry->message }}</p>

                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ $leadUrl }}"
                                   style="background:#2563eb; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:5px; display:inline-block;">
                                    Open lead in agent CRM
                                </a>
                            </div>

                            <p style="font-size:13px; color:#555;">
                                Tip: Use <strong>Reply</strong> in your inbox — replies go to {{ $inquiry->email }}.
                            </p>

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

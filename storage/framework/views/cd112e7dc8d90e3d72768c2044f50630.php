<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Agent Request</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; padding:30px; border-radius:8px;">

                    <tr>
                        <td>
                            <h2 style="margin-top:0;">New Agent Registration Request</h2>
                            <p>Hello Admin,</p>
                            <p>You have received a new agent registration request.</p>

                            <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">

                            <p><strong>Name:</strong> <?php echo e($data['name']); ?></p>
                            <p><strong>Email:</strong> <?php echo e($data['email']); ?></p>
                            <p><strong>Phone:</strong> <?php echo e($data['phone']); ?></p>

                            <div style="text-align:center; margin:30px 0;">
                                <a href="<?php echo e(url('/admin')); ?>"
                                   style="background:#2563eb; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:5px; display:inline-block;">
                                    View in Admin Panel
                                </a>
                            </div>

                            <p style="font-size:12px; color:#777;">
                                This is an automated message from your Real Estate System.
                            </p>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/mail/agent_request_notification.blade.php ENDPATH**/ ?>
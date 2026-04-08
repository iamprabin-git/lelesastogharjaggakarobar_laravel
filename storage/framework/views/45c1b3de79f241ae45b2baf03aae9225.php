<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; padding:30px; border-radius:8px;">
                    <tr>
                        <td>
                            <h2 style="margin-top:0;">Welcome, <?php echo e($data['name']); ?></h2>
                            <p>Your agent registration was received successfully.</p>
                            <p>An administrator will review your request. When your account is activated, use the email and password you registered with to sign in here:</p>
                            <p style="text-align:center; margin:24px 0;">
                                <a href="<?php echo e(url('/agent/login')); ?>"
                                   style="background:#2563eb; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:5px; display:inline-block;">
                                    Agent dashboard login
                                </a>
                            </p>
                            <p style="font-size:13px; color:#555;">You will only be able to log in after approval. If login fails, your account may still be pending.</p>
                            <p style="font-size:12px; color:#777;"><?php echo e(config('app.name')); ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/mail/agent_welcome.blade.php ENDPATH**/ ?>
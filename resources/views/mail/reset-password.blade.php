<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>

<body>
    <!-- Email title -->
    <h1 style="font-size: 24px; color: #4a90e2; font-weight: bold;">Password Reset</h1>

    <!-- Email body -->
    <p style="font-size: 16px; color: #333; line-height: 1.5;">
        Hello, {{ $userName }}
        <br><br>
        You have requested to reset your password. Please use the code below to complete the password reset process:
    </p>

    <!-- Four-digit code -->
    <div
        style="background-color: #f4f4f4; padding: 10px; border-radius: 5px; font-size: 20px; font-weight: bold; text-align: center; letter-spacing: 3px; color: #2c3e50;">
        {{ $verification_code }}
    </div>

    <!-- Message for those who didn't request a password reset -->
    <p style="font-size: 16px; color: #333; line-height: 1.5;">
        If you did not request a password reset, please ignore this email.
    </p>

    <!-- Button with a link -->
    <table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <a href="{{ $resetPasswordUrl }}"
                    style="background-color: #28a745; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">
                    Reset Password
                </a>
            </td>
        </tr>
    </table>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>

</html>

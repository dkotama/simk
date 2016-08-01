<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Dear {{ $title }}. {{ $name }}

You are receiving this email because you have registered for an account at SIMK Conference Management Systems.

<br>Please  <a href="{{ route('user.activate', $token)}}">click here</a>. You have 24 hours to activate your account using this link.

<br>If you are having difficulties activating your Account, then please contact the System Administrator at: admin@simk.dev

<br>This message comes from an unmonitored mailbox. Please do not reply to this message.
</p>

</body>
</html>

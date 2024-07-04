<!DOCTYPE html>
<html>
<head>
    <title>{{ $mailData['title'] }}</title>
</head>
<body>
    <p>Click here to reset your password: <a href='{{ $mailData['body'] }}'>resetLink</a></p>
</body>
</html>

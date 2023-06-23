<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - Let's Calendar</title>
    <style>
        .btn-primary{
            position: relative;
            color: #eee;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            border: 1px solid #ddd;
            background-color: #24293D;
            box-shadow: none;
            overflow: hidden;
        }
    </style>
</head>
<body>
    Hi {{$name}}, 
    <p>You recently requested to reset the password for your Let's Calendar account. Click the button below to proceed. If you did not request a password reset, please ignore this email or reply to let us know.</p>

    <a href="{{$button_link}}" class="btn-primary">{{$button}}</a>
    <p>Thank you</p>
</body>
</html>
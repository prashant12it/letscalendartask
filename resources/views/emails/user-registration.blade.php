<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful - Let's Calendar</title>
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
    <h2>Hey {{ $details['name'] }}</h2>
    <h4>Congratulations! Welcome to Let's Calendar.</h4>
    
    click on below button to verify your account.
    <p>
        <a class="btn-primary" href="{{url('/reset-password/'.base64_encode($details['email']))}}" target="_blank">Verify this email</a> 
    </p>
   
    <p>Thank you</p>
</body>
</html>
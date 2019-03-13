<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user['name']}}</h2>
<br/>
    Your registered email-id is {{$user['email']}}
    But you haven't verify your account yet!
    Please click the button below to verify your account.
        <button type="button"><a href="{{route('verify_token',['token' => $user['verification_code']])}}">VERIFY MY ACCOUNT</a> </button>
</body>

</html>
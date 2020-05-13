<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user['email']}}</h2>
<br/>
Your registered email is {{$user['email']}} <br><br>
Your registered password is {{$user['password']}}
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h4>You have a new message from: {{ Session::get('email') }} :</h4>
        <h4>
        This message says:
        </h4>
        <p>
            {{ Session::get('message') }}
        </p>
</body>
</html>

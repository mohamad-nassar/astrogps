<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Astro night invitation</h4>
    <p>You are invited to attend an astronomical evening on a date <b>{{ Session::get('date') }}</b> at <b>{{ Session::get('time') }}</b> in  <b>{{ Session::get('place') }}</b>.
    Thank you.
    </p>
</body>
</html>

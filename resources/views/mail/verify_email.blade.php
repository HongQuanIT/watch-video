
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <p><label>Hello {{ $first_name }},</label></p></br>
    <p><bold>You register account successfully !</bold></p></br>
    <p>To active , you need verify {{ $email }} : <a href="{{ URL::to('verify/'. $userId .'/'. $verify_code) }}">here</a> </p></br>
</body>
</html>
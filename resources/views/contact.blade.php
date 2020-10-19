<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    @csrf
    <div>
        <label for="">Fullname</label>
        <input type="text" name="fullname"/>
    </div>

    <div>
        <label for="">Email</label>
        <input type="email" name="email"/>
    </div>

    <div>
        <label for="">Message</label>
        <textarea name="message" id="" cols="30" rows="10"></textarea>
    </div>

    <div>
        <input type="submit" value="Contact us"/>
    </div>
</form>
</body>
</html>
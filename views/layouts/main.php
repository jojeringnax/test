<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Null</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
</head>

<body>

<?= \jojer\core\App::$isGuest ?
    '<a href="/login" style="width:100%;height: 60px">Login</a>' :
    '<a href="/logout" style="width:100%;height: 60px">Logout('.\jojer\core\App::$user->username . (\jojer\core\App::$isAdmin ? '(Admin)': '') . ')</a>' ?>
</body>

</html>
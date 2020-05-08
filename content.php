<?php
session_start();
$connection =  new PDO('mysql:host=localhost; dbname=site;
charset=utf8', 'root', 'root');
$login = $connection->query("SELECT * FROM login");
if (!$_SESSION['login'] or !$_SESSION['password']) {
    header("Location: index.php");
    die();
}

if ($_POST['unlogin']) {
    session_destroy();
    header("Location: login.php");
}

?>

<body style="font-size: 40px">
<p>Сайт только для залепания</p>
<img src="https://uwalls.ru/gallery/2/source/29435.jpg" alt="Picture" width="600" style="display: block">

<form action="" method="post" style="margin: 40px; font-size: 40px">
    <input style="font-size: 30px" type="submit" name="unlogin" value="Хорош, пора работать">

</form>
</body>
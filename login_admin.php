<?php
session_start();
$connection =  new PDO('mysql:host=localhost; dbname=site;
charset=utf8', 'root', 'root');
$log = $connection->query("SELECT * FROM admil");

if ($_POST['login']) {
    foreach ($log as $value) {
        if (htmlspecialchars($_POST['login']) == $value['login'] and htmlspecialchars($_POST['password']) == $value['password']) {
            $_SESSION['login'] = htmlspecialchars($_POST['login']);
            $_SESSION['password'] = htmlspecialchars($_POST['password']);
            header("Location:admin.php");
        }
    }
}

?>

<style>
    body {
        margin: 50px;
        font-family: Arial;
    }
    input, textarea, button {
        margin: 15px;
        display: block;
        font-size: 30px;
    }
</style>

<h2>Вход в админку</h2>

<form method="post">
    <input type="login" name="login" required placeholder="Логин">
    <input type="password" name="password" required placeholder="Пароль">
    <input type="submit" value="Войти" name="admin">
</form>
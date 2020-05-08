<?php

session_start();
$connection =  new PDO('mysql:host=localhost; dbname=site;
charset=utf8', 'root', 'root');
$login = $connection->query("SELECT * FROM login");

if ($_POST['login']) {
    foreach ($login as $log) {
        if ($_POST['login'] == $log['login'] and $_POST['password'] == $log['password']) {
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['password'] = $_POST['password'];
            header("Location: content.php");
        }
    }

    echo 'Неверный логин или пароль';
}
?>


<style>
    body {
        margin: 200px 300px;
    }
    input, p {
        font-size: 30px;
        margin: 10px;
    }
</style>


<form action="" method="post">
    <p>Авторизируйтесь</p>
    <input type="login" name="login" required placeholder="Логин"> <br>
    <input type="password" name="password" required placeholder="Пароль"> <br>
    <input type="submit" >
</form>


<?php

session_start();
$connection = new PDO('mysql:host=localhost; dbname=site;
charset=utf8', 'root', 'root');
if ($_POST['login']) {
    $newName = $_POST['name'];
    $newSurname = $_POST['surname'];
    $newYear = $_POST['year'];
    $newCity = $_POST['city'];
    $newEmail = $_POST['email'];
    $newLogin = $_POST['login'];
    $newPassword = $_POST['password'];
    $login = $connection->query("SELECT * FROM login");
    foreach ($login as $log) {
        if ($newEmail == $log['email']) {
            echo "Пользователь с такой почтой уже зарегестрирован";
            die();
        }
    }

        $connection->query("INSERT INTO login(name, surname, year, city, email, login, password) 
            VALUES ('$newName', '$newSurname', '$newYear', '$newCity', '$newEmail', '$newLogin', '$newPassword')");
    header('Location: content.php');

}
if(isset($_GET['log'])) {
    header('Location: login.php');
}

?>

<form action="" method="post">
    <h2>Регистрация</h2>
    <input type="name" name="name" required placeholder="Имя"> <br> <br>
    <input type="surname" name="surname" required placeholder="Фамилия"><br> <br>
    <input type="year" name="year" required placeholder="Год Рождения"><br> <br>
    <input type="city" name="city" required placeholder="Город"><br> <br>
    <input type="email" name="email" required placeholder="Почта"><br> <br>
    <input type="login" name="login" required placeholder="Номер телефона"><br> <br>
    <input type="password" id='pas' name="password" required placeholder="Придумайте пароль"><br>
    <input type="submit" value="Зарегестрироваться" style="color: blue">
    <h3>Уже зарегестрированы?</h3>
</form>
<form action="">
    <input type="submit" value="Войти" name="log">
</form>

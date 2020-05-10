<?php

$connection = new PDO('mysql:host=localhost; dbname=site;
charset=utf8', 'root', 'root');

function generateRandomString() {
    $char = '0123456789qwertyuioplkjhgfdsazxcvbnmMNBVCXZASDFGHJKLPOIUYTREWQ';
    $random = '';
    for ($i=0; $i<20; $i++) {
        $random .= $char[rand(0, (strlen($char)-1))];
    }
    return $random;
}


if ($_POST['login']) {
    $newName = htmlspecialchars($_POST['name']);
    $newSurname = htmlspecialchars($_POST['surname']);
    $newYear = htmlspecialchars($_POST['year']);
    $newCity = htmlspecialchars($_POST['city']);
    $newEmail = htmlspecialchars($_POST['email']);
    $newLogin = htmlspecialchars($_POST['login']);
    $newPassword = htmlspecialchars($_POST['password']);
    $authKey = generateRandomString();



    $login = $connection->query("INSERT INTO login (name, surname, year, city, email, auth_key, login, password) 
            VALUES ('$newName', '$newSurname', '$newYear', '$newCity', '$newEmail', '$authKey', '$newLogin', '$newPassword')");

    if ($login) {

        mail($newEmail, 'Подтвердите почту', "http://registrationsite/?auth=$authKey");
        echo "<h2 style='color: crimson'>Письмо с подтверждением отправлено на вашу почту</h2>";

    } else {

        $search = $connection->query("SELECT * FROM login WHERE login = '$newLogin'");
        $search = $search->fetch();
        if ($search) {
            echo "<h2 style='color: red'>Такой логин уже существует, придумайте другой</h2>";
        } else {
            $findUser = $connection->query("SELECT * FROM login WHERE email='$newEmail'");
            $findUser = $findUser->fetch();
            if (!$findUser['validate']) {
                echo "<h2 style='color: darkred'>Подтвердите почту</h2>";
            } else {
                echo "<h2 style='color: green'>Вы уже зарегестрированы. Войдите на сайт</h2>";
            }
        }

    }
}


if ($_GET['auth']) {
    $auth = $_GET['auth'];
    $search = $connection->query("SELECT * FROM login WHERE auth_key = '$auth'");
    if ($search) {
        $connection->query("UPDATE login SET validate = true, updated_at = current_timestamp 
WHERE auth_key = '$auth'");
        echo "<h2 style='color: green'>Ваша почта подтверждена. Войдите на сайт</h2>";

    }

}

if($_GET['log']) {
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
    <input type="login" name="login" required placeholder="Придумайте логин"><br> <br>
    <input type="password" id='pas' name="password" required placeholder="Придумайте пароль"><br>
    <input type="submit" value="Зарегестрироваться" style="color: blue">
    <h3>Уже зарегестрированы?</h3>
</form>
<form method="get">
    <input type="submit" value="Войти" name="log">
</form>



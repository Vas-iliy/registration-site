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
    //$newPassword1 = $_POST['password1'];
    //if ($newPassword == $newPassword1) {
        $connection->query("INSERT INTO login(name, surname, year, city, email, login, password) 
            VALUES ('$newName', '$newSurname', '$newYear', '$newCity', '$newEmail', '$newLogin', '$newPassword')");
    header('Location: index.php');
    //}
   /* else {
        echo 'Введенные пароли не совпадают';
        header('Location: index.php');
    }*/
}

?>

<form action="" method="post">
    <input type="name" name="name" required placeholder="Имя"> <br> <br>
    <input type="surname" name="surname" required placeholder="Фамилия"><br> <br>
    <input type="year" name="year" required placeholder="Год Рождения"><br> <br>
    <input type="city" name="city" required placeholder="Город"><br> <br>
    <input type="email" name="email" required placeholder="Почта"><br> <br>
    <input type="login" name="login" required placeholder="Придумайте логин"><br> <br>
    <input type="password" name="password" required placeholder="Придумайте пароль"><br>
    <!--<input type="password1" name="password1" required placeholder="Повторите пароль"><br>-->
    <input type="submit" value="Зарегестрироваться" style="color: blue">

</form>

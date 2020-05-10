<?php
session_start();
if (!$_SESSION['login']) {
    header("Location:login_admin.php");
}

if ($_POST['exit']) {
    session_destroy();
    header("Location:login_admin.php");
}

$connection = new PDO('mysql:host=localhost; dbname=site;charset=utf8', 'root', 'root');
$comment = $connection->query("SELECT * FROM comments WHERE moderation = '0' ORDER BY date DESC ");

if ($_POST) {
    header("Location:admin.php");
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

<h1>Сайт админа</h1>
<form method="post">
    <?foreach ($comment as $com) {?>
    <select name="<?=$com['id']?>" id="<?=$com['id']?>">
        <option value="ok">Принять</option>
        <option value="no">Отклонить</option>
    </select>
    <label for="<?=$com['id']?>">
        <? echo $com['login'] . ' оставил коментарий: ' . $com['comment'] . "<br/>"?>
    </label>
        <?}?>
    <input type="submit" value="Модерировать" >
</form>


<form method="post">
    <input type="submit" name="exit" value="Выйти">
</form>

<?
foreach ($_POST as $num=>$checked) {
    if ( $checked == 'ok') {
        $connection->query("UPDATE comments SET moderation = 'ok' WHERE id = '$num'");
    } else {
        $connection->query("UPDATE comments SET moderation = 'no' WHERE id = '$num'");
    }
}
?>

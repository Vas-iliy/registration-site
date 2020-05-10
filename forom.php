<?
session_start();
if (!$_SESSION['login']) {
    header("Location:index.php");
}

if ($_POST['exit']) {
    session_destroy();
    header("Location: login.php");
}

$connection = new PDO('mysql:host=localhost; dbname=site;
charset=utf8', 'root', 'root');
$data = $connection->query("SELECT * FROM comments WHERE moderation = 'ok' ORDER BY date DESC ");

if ($_POST) {
    $login = htmlspecialchars($_POST['login']);
    $comment = htmlspecialchars($_POST['comment']);
    $time = date("Y:m:d H:i:s");
    $connection->query("INSERT INTO comments (login, comment,date) VALUES ('$login', '$comment', '$time')");

}
if ($_POST) {
    header("Location:forom.php");
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
<h1>Сайт для додиков</h1>
<img src="https://klv-oboi.kz/img/gallery/5/thumbs/thumb_l_4091.jpg" alt="картинка"> <br/>
 <h2>Напишите коментарий</h2>
<form method="post">
    <input type="login" name="login" required placeholder="Логин">
    <textarea type="comment" name="comment" required placeholder="Комментарий" id="" cols="30" rows="10"></textarea>
    <input type="submit" name="коментировать">
</form>

<h2>Оставьте свои коментарии</h2>
<h3>Сообщения проходят модерацию</h3>
<?
if ($data) {
    foreach ($data as $comment) {
?>

<div>
    <? echo $comment['date'] . ' Пользователь ' . $comment['login'] . ' отправил ' . $comment['comment']?>
</div>
<?}}?>

<form method="post">
    <input type="submit" value="Выйти" style="color: red" name="exit">
</form>

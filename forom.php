<?
session_start();
if (!$_SESSION['login']) {
    header("Location:index.php");
}

if ($_POST['exit']) {
    session_destroy();
    header("Location: login.php");
}

$connection = new PDO('mysql:host=localhost; dbname=site; charset=utf8', 'root', 'root');
$data = $connection->query("SELECT * FROM comments WHERE moderation = 'ok' ORDER BY date DESC ");

//тут мы работаем с файлами
if (isset($_POST['go'])) {
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTmp_name = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];
    $fileSize = $_FILES['file']['size'];

    //это массив, в котором будет [имя,расширение]
    $fileExtension = strtolower(end(explode('.', $fileName)));

   //тут мы рассматриваем, если элементов, разделенных точками больше двух
    if (count(explode('.', $fileName))>2) {
        $n = count(explode('.', $fileName))-2;
        for ($i=0; $i==$n; $i++) {
            $fileName .= explode('.', $fileName)[$i] . '.';
        }
    } else {
        $fileName = explode('.', $fileName)[0];
    }

    //замена всех цифр в файле на пустое место
    $fileName = preg_replace('/[0-9]/', '', $fileName);
    //массив допустимых разрешений
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExtension, $allowedExtensions)) {
        if ($fileSize < 5000000) {
            if ($fileError == 0) {
                $connection->query("INSERT INTO images (image, extension) VALUES ('$fileName', '$fileExtension') ");

                //тут мы выбираем последний добавленный айди
                $lastId = $connection->query("SELECT MAX(id) FROM images");
                $lastId = $lastId->fetch();
                $lastId = $lastId[0];

                //тут мы изменяем имя, добавляя айди перед именем
                $fileNameNew = $lastId . $fileName . '.' . $fileExtension;
                //тут указываем куда файл будет сохраняться
                $fileDestination = 'uploads/' . $fileNameNew;
                move_uploaded_file($fileTmp_name, $fileDestination);

            } else {
                echo 'Что-то пошло не так';
            }
        } else {
            echo 'Слишком большой размер файла';
        }
    } else {
        echo 'Недоступное разрешение файла';
    }

}

if ($_POST) {
    header("Location:forom.php");
}

//подключаемся к таблице с картинками
$imgData = $connection->query("SELECT * FROM images");

//создаем отдельный блок, где будут хранится картинки
echo "<div style='display: flex; align-items: flex-end; flex-wrap: wrap'>";

foreach ($imgData as $img) {
    //полный путь до картинки, которая уже записана в базу данных и сохранена в папке uploads
    $image = "uploads/" . $img['id'] . $img['image'] . '.' . $img['extension'];
    //если файл существует, мы добавляем его на сайт и добавляем кнопку удалить
    if (file_exists($image)) {
        echo "<div>";
        echo "<img width='200'  src='$image'>";
        echo "<form method='post'><input type='submit'  name='delete" . $img['id'] . "' value='Удалить'></form>";
        echo "</div>";
    }

    $delete = "delete" . $img['id'];
    if (isset($_POST[$delete])) {
        $imageId = $img['id'];
        //удаление из БД картинки с айди, кнопку которого нажали
        $connection->query("DELETE FROM images WHERE id = '$imageId'");

        //так же картинку удаляем и с сайта
        if (file_exists($image)) {
            unlink($image);
        }
    }
}

echo "</div>";


if ($_POST['login']) {
    $login = htmlspecialchars($_POST['login']);
    $comment = htmlspecialchars($_POST['comment']);
    $time = date("Y:m:d H:i:s");

    $search = $connection->query("SELECT login FROM login WHERE login = '$login'");
    $search = $search->fetch();
    if ($search) {
        $connection->query("INSERT INTO comments (login, comment,date) VALUES ('$login', '$comment', '$time')");
    }
        else {
        echo "<h2 style='color: darkred'>Для отправки коментария введите свой логин</h2>";
        die();
        }

}


?>

<style>
    body {
        margin: 20px;
        font-family: Arial;
    }
    input, textarea, button {
        margin: 15px;
        display: block;
        font-size: 20px;
    }
</style>

<h1>Сайт для додиков</h1>
<h2>Добавьте картинку на сайт</h2>

<!--тут мы добавляем файлы-->
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <input type="submit" name="go">
</form>

 <h2>Напишите коментарий</h2>

<form method="post">
    <input type="login" name="login" required placeholder="Логин"><br/>
    <textarea type="comment" name="comment" required placeholder="Комментарий" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="коментировать">
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

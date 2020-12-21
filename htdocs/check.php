<!DOCTYPE html>
<html lang="ru">
<?php
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);


//$pass = md5($pass . 'qweeqwweqweqweewq1123');

$mysql = new mysqli('localhost', 'root', 'root', 'cursa4');

$result = $mysql->query("SELECT * FROM `table1` WHERE `email` = '$login' AND `password` = '$pass'");
$user = $result->fetch_assoc();

if (count((array)$user) == 0) {
    echo "Такой пользователь не найден";
    exit();
}
else
{
	print ('SOSI BIBU');
}

echo "SOSI BIBU";
//setcookie('user', $user['name'], time() + 3600, "/");

$mysql->close();

header('Location:/2.html');
?>
<body>
<br>
<h1>JOAP </h1>
</br>
</body>

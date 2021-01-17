<?php include("php/autorization.php"); ?>

<!DOCTYPE HTML> 
<html>

<head>  <title>АНИМЕ"</title>
<meta charset="UTF­8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<? if(isAdmin())
{	
echo "<div id='header'>
<i><a href='index.php'>Главная</a><span>|</span>
<a  href='contracts.php'>Контракты</a><span>|</span>
	<a href='clientage.php'>Клиенты</a><span>|</span>
	<a href='employees.php'>Сотрудники</a><span>|</span>
	<a href='property_list.php'>Список недвижимости</a><span>
</div>
	<div id='content'>
 <p align='center'><img src='img/admin.jpg'></p>
 
 </div>";
}
else
{
	echo "<h1>Вы не являетесь администратором(ухади)<\h1>";
}
?>
 <div id="footer">
        
			О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020 <a href="index.html" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>
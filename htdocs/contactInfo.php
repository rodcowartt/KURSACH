<!DOCTYPE HTML> 
<html>

<head>  <title>Магазинчик</title>
<meta charset="UTF­8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="header">
<i><a  href="index.php">Главная</a><span>|</span>
	<a href="info.php">О нас</a><span>|</span>
	<a id="selected" href="#">Контакты</a><span>|</span>
	<?
	include("php/autorization.php");
if(login())
{
echo"<a href='property_list.php'>Список недвижимости</a><span>";
}
?>
</div>
<p align='center'><img src='img/call.jpg'></p>
<div id="content">
	<div id= "box_text">
	<p>телефон: 88005553535 почта: write_us@gmail.com</p>
	</div>
</div>

<div id="footer">
        
			О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020 <a href="index.html" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>
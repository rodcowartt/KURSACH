<!DOCTYPE HTML> 
<html>

<head>  <title>Магазин</title>
<meta charset="UTF­8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="header">
<i><a  href="index.php">Главная</a><span>|</span>
	<a id="selected" href="#">О нас</a><span>|</span>
	<a href="contactinfo.php">Контакты</a><span>|</span>
	
	<?
	include("php/autorization.php");
if(login())
{
echo"<a href='property_list.php'>Список недвижимости</a><span>";
}
?>
</div>
<div class="rovno_info">
<p>  </p>
<p align='center'><img src='img/team.jpg'></p>
<div id="content">
<div id= "box_text">
О нас:<p>
Действующие программы:
<br>
Просмотр и покупка недвижимости со всего мира.
<br>Материнский капитал ✓.
<br>Военная ипотека ✓.
<br>Обмен квартир ✓.
<br>При выборе программы проконсультируйтесь с нашим сотрудником по номеру телефона 88005553535 или по почте write_us@gmail.com



</p></div>
</div>
</div>
<div id="footer">
        
			О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020  <a href="index.html" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>
<!DOCTYPE HTML> 
<html>

<head>  <title>Магазин</title>
<meta charset="UTF­8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="header">
<i><a  id="selected" href="index.php">Главная</a><span>|</span>
	<a "info.php">О нас</a><span>|</span>
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

<div id="content">
<?
if(login())
{
$email=$_COOKIE['user_email'];
$query="SELECT amount FROM cards where fio=(select fio from clientage where client_login=?)";
$stmt = $s_user->prepare($query);
$stmt->bindParam(1, $email);
$stmt->execute();
$takeresult=$stmt->fetch();
$result=$takeresult;
echo "<p></p>";
echo "Ваш баланс: ";
echo $result['amount'];	
}
?>
<form action='php/bring.php' method='POST'>
		<input type='text' name='bring' value='' />
		<input type='submit' value='Занести денег' name = 'bring_accept' />
		</form>
</div>
</div>
<div id="footer">
        
			О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020  <a href="index.html" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>
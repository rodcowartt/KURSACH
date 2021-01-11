<?php include("php/autorization.php"); ?>

<!DOCTYPE HTML> 
<html>

<head>  <title>АНИМЕ</title>
<meta charset="UTF­8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="header">
<i><a href="index.php">Главная</a><span>|</span>
<a href="contracts.php">Контракты</a><span>|</span>
	<a href="clientage.php">Клиенты</a><span>|</span>
	<a id="selected" href="#">Сотрудники</a><span>|</span>
	<a href="property_list.php">Список недвижимости</a><span>
</div>

<div id="content ">
<?
	$query = "SELECT * FROM employees INNER JOIN users ON employees.user_id = users.user_id";
	$result = userexecuteRequest($query);
		
		if(mysqli_num_rows($result) > 0)
		{
			
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) 
			{ 
				$rows[] = $row; 
			}
			
			printf("<table border='1'>
					<tr><td>ID Работника</td><td>ID пользователя</td><td>Email</td><td>Дата</td></tr>
			");
			foreach($rows as $value)
			{
				
				printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$value['employee_id'],$value['user_id'],$value['Email'],$value['date']);
				
			}
			printf("</table>");
		}
?>

<form action='php/deleteempl.php' method='POST'>
		ID Работника<input type='text' name='id' value='' />
		<input type='submit' value='Уволить'/>
</form>

<form action='php/addempl.php' method='POST'>
		Email<input type='text' name='email' value='' />		
		<input type='submit' value='Взять на работу'/>
</form>
</div>

 <div id="footer">
        
			 О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020  <a href="index.html" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>
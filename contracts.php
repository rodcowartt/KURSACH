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
<a id="selected" href="#">Контракты</a><span>|</span>
	<a href="clientage.php">Клиенты</a><span>|</span>
	<a href="employees.php">Сотрудники</a><span>|</span>
	<a href="property_list.php">Список недвижимости</a><span>
</div>

<div id="content">
<?
	$query = "SELECT * FROM contracts";
	$result = userexecuteRequest($query);
		
		if(mysqli_num_rows($result) > 0)
		{
			//$result = mysqli_fetch_assoc($result);
			
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) 
			{ 
				$rows[] = $row; 
			}
			
			printf("<table border='1'>");
			printf("<tr><td>ID контракта</td><td>ID клиента</td><td>Адрес</td><td>Стоимость</td><td>Дата заключения</td></tr>");
			foreach($rows as $value)
			{
				printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$value['contract_id'],$value['client_id'],$value['address'],$value['cost'],$value['conclusion_date']);
			}
			printf("</table>");
		}
?>

<form action='php/terminate.php' method='POST'>
		ID контракта<input type='text' name='id' value='' />
		<input type='submit' value='Удалить'/>
</form>

</div>	

 <div id="footer">
        
			О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020 <a href="index.html" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>
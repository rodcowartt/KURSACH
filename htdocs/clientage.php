<?php include("php/autorization.php"); ?>
<!DOCTYPE HTML> 
<html>

<head>  <title>АНИМЕ"</title>
<meta charset="UTF­8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="header">
<i><a href="index.php">Главная</a><span>|</span>
<a href="contracts.php">Контракты</a><span>|</span>
	<a id="selected" href="#">Клиенты</a><span>|</span>
	<a href="employees.php">Сотрудники</a><span>|</span>
	<a href="property_list.php">Список недвижимости</a><span>
</div>

<div id="content">
<form action='' method='POST'>
		Email/login<input type='text' name='email' value='email' />
		<input type='submit' value='Найти'/>
</form>
<?
	$email =filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	
	if($email!="email")
	{
		$query = "SELECT * FROM clientage RIGHT JOIN users ON users.user_id = clientage.client_id WHERE Email='$email'";
		$result = userexecuteRequest($query);
	}
		
		if(mysqli_num_rows($result) > 0)
		{
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) 
			{ 
				$rows[] = $row; 
			}
			
			printf("<table border='1'>");
			printf("<tr><td>ID пользователя</td><td>ID клиента</td><td>Имя</td><td>Дата рождения</td><td>Почта</td></tr>");
			foreach($rows as $value)
			{
				
				printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$value['user_id'],$value['client_id'],$value['fio'],$value['birth_year'],$value['Email']);
				
			}
			printf("</table>");
		}
?>

<form action='php/deleteclient.php' method='POST'>
		Email<input type='text' name='email' value='' />
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
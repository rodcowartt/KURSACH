<?php include("php/autorization.php"); 
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE HTML> 
<html>

<head>  <title>АНИМЕ"</title>
<meta charset="UTF-8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="header">
<i><a href="index.php">Главная</a><span>|</span>
<?if(isAdmin()){
	echo"
<a href='contracts.php'>Контракты</a><span>|</span>
	<a href='clientage.php'>Клиенты</a><span>|</span>
	<a href='employees.php'>Сотрудники</a><span>|</span>
	";
	}
	?>
	<a id='selected' href='property_list.php'>Список недвижимости</a><span>
	
</div>

<div id="content">
<?	
	printf ("<form action='search.php' method='POST'>
		Адрес<input type='text' name='search' value='' />
		<input type='submit' value='Найти'/>
		</form>");
	$value1=$_COOKIE['search'];
	$scrolls=0;
	if (isset($_COOKIE['scrolls'])) $scrolls=$_COOKIE['scrolls'];
	$min='0';
	$max='0';
	$query = "SELECT * FROM property WHERE deleted='0' and id_property>$scrolls and address LIKE '%$value1%' limit 25";
	$result = executeRequest($query);
		
		if(mysqli_num_rows($result) > 0)
		{
			//$result = mysql_fetch_assoc($result);
			
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) 
			{ 
				$rows[] = $row; 
			}
			
			printf("<table border='1'>");
			foreach($rows as $value)
			{
				
				printf("<tr><td><form action='php/buy.php' method='POST'>
						<input type='text' name='id' value='%s' readonly />
						<input type='text' name='cost' value='%s' readonly />
						<input type='text' name='adress' value='%s' readonly />
						<input type='submit'  value='Купить'/>
						</form></td></tr>",
						$value['id_property'],$value['cost'],$value['address']
				);
				if ($min=='0') $min=$value['id_property'];
			}
			printf("</table>");
			setcookie('prev',$min);
			setcookie('next',$value['id_property']);
			printf ("<form action='previous.php' method='POST'>
			<input type='submit' name='previous' value='previous'/>
			</form>
			<form action='next.php' method='POST'>
			<input type='submit' name='next' value='next'/>
			</form>");
		}
?>
</div>	

 <div id="footer">
        
			О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020 <a href="index.html" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>
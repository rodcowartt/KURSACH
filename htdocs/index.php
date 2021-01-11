<?php 
if(isset($_POST['log_out']))
    {
        setcookie('user_email',"");
		echo '<script>window.location="../index.php"</script>';
    }
include("php/autorization.php");
$error = enter(); ?>

<!DOCTYPE HTML> 
<html>

<head>  <title>АНИМЕ</title>
<meta charset="UTF-8">
		<title>Title</title>
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="header">
<i><a id="selected" href="#">Главная</a></i>
	<span>|</span><a href="info.php">О нас</a><span>|</span>
	<a href="contactinfo.php">Контакты</a>
	<?
	if(login())
	{
		printf("<span>|</span><a href='property_list.php'>Список недвижимости</a><span>");
	}
	?>
</div>
	<div id="autorization">
	<fieldset>
	<?
	if(login())
    {    
		$admin = isAdmin();
		$email=$_COOKIE['user_email'];
		echo "<p>Добро пожаловать:</p>";echo $_COOKIE['name'];
		$query="SELECT amount FROM cards where fio=(select fio from clientage where client_login='$email')";
		$amount=executeRequest($query);
		$result=$amount->fetch_assoc();
		echo "<p></p>";
		echo "Ваш баланс: ";
		echo $result['amount'];
        echo "<form action='index.php' method='POST'>
		<input type='submit' value='Выход' name = 'log_out' />
	     </form>";
		 if($admin)
		 {			 
		 echo "<a id='selected' href='admin_panel.php'>Панель администратора</a>";
		 }
    }
    else
    {
    echo "
	<legend><h2>Заполните форму авторизации</h2></legend>
	<form action=''  method='POST'>
		Логин<input type='text' name='user_email' value='' />
		Пароль<input type='password' name='user_password' value='' />
		<input type='submit' value='Войти' name = 'log_in' />
		<a href='registration.html'> Зарегистрироваться </a>
	</form>	";
		
	if(count((array)$error) == 0)
	{
		echo '<script>window.location="index.php"</script>';
	}
	 else
    {
	    echo "$error[0]";
    }
    }
	
    ?>
	</fieldset>	
	</div>
	<div class="rovno_index">
	<div id="content">
 <h1> Агентство Недвижимости Имени Михаила Евграфовича</h1>
 <p align="center"><img src="img/298.jpg" width="69%" height="69%"></p>
<div id="box_text">
 О нас:
<p>В нашем агентстве недвижимости мы собираем лучшие варианты жил. площади!
 <br>
 Только у нас самое оптимальное соотношение средние цены-среднее качество!
 Работа ведётся только с проверенными и надёжными поставщиками!
  </p></div>
 </div>
 </div>
 <div id="footer">
        
			О разработчиках: Белков А.И.,Тарасов И.С.,Вохминцев М.С. БИ-31 Copyright © 2020 <a href="index.php" target="_self">Недвижимость"</a>
			<br>
			<img src="img/images.jpg" alt="фотография">
		</div>
</body>
</html>

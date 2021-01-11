<?
	include("autorization.php");
	header('Content-Type: text/html; charset=utf-8');
	
	$login =  filter_var(trim($_POST['user_login']), FILTER_SANITIZE_STRING);
	$password =  filter_var(trim($_POST['user_password']), FILTER_SANITIZE_STRING);
	$fio =  filter_var(trim($_POST['fio']), FILTER_SANITIZE_STRING);
	$date =  filter_var(trim($_POST['birth_date']), FILTER_SANITIZE_STRING);
	$password = md5($password);
	
	
	
	$querychech = "SELECT Email FROM users WHERE Email='$login'";
	
	$chechresult = executeRequest($querychech);
	
	if(mysqli_num_rows($chechresult) == 0)
	{	
			
	$query = "INSERT INTO users(Email,user_password, is_admin) VALUES('$login','$password',false)";
	
	if (preg_match("#^[aA-zZ0-9\-_]+$#",$login) && $fio !="" && $date!="") 
	{
		executeRequest($query);
		$clientquery = "INSERT INTO clientage(client_login,fio,birth_year) VALUES('$login','$fio','$date')";
		executeRequest($clientquery);
		header("Location: ../success.html");
	} 
	else 
	{
		header("Location: ../error.php");
	}
	}
	else
	{
		header("Location: ../error.php");
	}
?>
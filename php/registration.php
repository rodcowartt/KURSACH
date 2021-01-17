<?
	include("autorization.php");
	header('Content-Type: text/html; charset=utf-8');
	
	$login =  filter_var(trim($_POST['user_login']), FILTER_SANITIZE_STRING);
	$password =  filter_var(trim($_POST['user_password']), FILTER_SANITIZE_STRING);
	$fio =  filter_var(trim($_POST['fio']), FILTER_SANITIZE_STRING);
	$date =  filter_var(trim($_POST['birth_date']), FILTER_SANITIZE_STRING);
	$card_number= filter_var(trim($_POST['card_number']), FILTER_SANITIZE_STRING);
	
	
	$querychech = "SELECT Email FROM users WHERE Email=?";
	$stmt = $dbh->prepare($querychech);
	$stmt->bindParam(1, $login);
	$stmt->execute();
	$chechresult=$stmt->fetch();
	//$chechresult = executeRequest($querychech);
	
	$password=password_hash($password, PASSWORD_DEFAULT);
	//if(mysqli_num_rows($chechresult) == 0)
	if(empty($chechresult) == 1)
	{	
			
	//$query = "INSERT INTO users(Email,user_password, is_admin) VALUES(?,?,false)";
	//$stmt = $dbh->prepare($query);
	//$stmt->bindParam(1, $login);
	//$stmt->bindParam(2, $password);
	
	if (preg_match("#^[aA-zZ0-9_.\@]+$#",$login) && $fio !="" && $date!="") 
	{
		$query = "INSERT INTO users(Email,user_password) VALUES(?,?)";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $login);
		$stmt->bindParam(2, $password);
		//executeRequest($query);
		$stmt->execute();
		
		$clientquery1 = "INSERT INTO clientage(client_login,fio,birth_year) VALUES(?,?,?)";
		$stmt = $dbh->prepare($clientquery1);
		$stmt->bindParam(1, $login);
		$stmt->bindParam(2, $fio);
		$stmt->bindParam(3, $date);
		$stmt->execute();
		
		$clientquery2 = "INSERT INTO cards(fio,card_number) VALUES(?,?)";
		$stmt = $dbh->prepare($clientquery2);
		$stmt->bindParam(1, $fio);
		$stmt->bindParam(2, $card_number);
		$stmt->execute();
		//executeRequest($clientquery);
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
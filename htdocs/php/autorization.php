<?
$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'root');
function bdConnect()
{
    $link = mysqli_connect('localhost', 'root', 'root', 'kurs');

	mysqli_close($link);
}
function userexecuteRequest($query)
{
	$mysql = new mysqli('localhost', 'root', 'root', 'kurs');
	$result = $mysql->query($query) ;	
	$mysql->close();
	
	return $result;
}

function executeRequest($query)
{
	$mysql = new mysqli('localhost', 'root', 'root', 'kurs');
	$result = $mysql->query($query) ;	
	$mysql->close();
	
	return $result;
}

function login()
{
	$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'root');
	//session_start();
	if(isset($_COOKIE['user_email']))
	{
		return true;
	}
	return false;
}


function isAdmin()
{
	$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'root');
	$email = $_COOKIE['user_email'];
	$query = "SELECT is_admin FROM users WHERE Email= ?";
	$stmt = $dbh->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->execute();
	$addresult=$stmt->fetch();
	$queryResult1=$addresult['is_admin'];
		if($queryResult1 == 1)
		{
			return 1;
			
		}
	
	return 0;
}

function enter()
{
	$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'root');
	
	$errors = array();
	if(!isset($_COOKIE["user_email"]))
	{
	//test();
	if($_POST['user_email'] !="" && $_POST['user_password'] != "")
	{
		
		$email = filter_var(trim($_POST['user_email']), FILTER_SANITIZE_STRING);
		$password = filter_var(trim($_POST['user_password']), FILTER_SANITIZE_STRING);
		$password = md5($password);
		
		$query = "SELECT * FROM users WHERE Email=? AND user_password=?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $email);
		$stmt->bindParam(2, $password);
		$stmt->execute();
		$result=$stmt->fetch();
		
		if(empty($result) == 0)
		{
			//$result = $queryResult->fetch_assoc();
			if(md5($password == $result["user_password"]))
			{		
				$user_email_result = $result["Email"];
				
				if(setcookie("user_email",$user_email_result,time()+3600))
				{	
					$query = "SELECT fio FROM clientage WHERE client_login='$email'";
					//$fio=executeRequest($query);
					//$result_fio = $fio->fetch_assoc();
					$stmt = $dbh->prepare($query);
					$stmt->bindParam(1, $email);
					$stmt->execute();
					$result_fio=$stmt->fetch();
					setcookie("name",$result_fio['fio'],time()+3600);
					return $errors;
				}
				$errors[] = "Не удалось установить куки";
				return $errors;
			}
			else
			{
				$errors[] = "Неверный логин или пароль";
				return $errors;	
			}
		}
		else
		{
			$errors[] = "Пользователь не найден";
			return $errors;		
		}
	}
	else
	{
		$errors[] = "Введите имя пользователя и пароль";
		return $errors;
	}
	}
	else{
		$error[] = "Куки уже заняты";
	}
}
?>
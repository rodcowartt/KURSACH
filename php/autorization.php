<?
$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'n9bVar8g49TGjhE');
$s_user = new PDO('mysql:host=localhost; dbname=kurs', 'simple_user', 'clhxShDTFMje1OQ');
function bdConnect()
{
    $link = mysqli_connect('localhost', 'root', 'n9bVar8g49TGjhE', 'kurs');

	mysqli_close($link);
}

function userexecuteRequest($query)
{
	$mysql = new mysqli('localhost', 'root', 'n9bVar8g49TGjhE', 'kurs');
	$result = $mysql->query($query) ;	
	$mysql->close();
	
	return $result;
}

function executeRequest($query)
{
	$mysql = new mysqli('localhost', 'root', 'n9bVar8g49TGjhE', 'kurs');
	$result = $mysql->query($query) ;	
	$mysql->close();
	
	return $result;
}

function login()
{
	$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'n9bVar8g49TGjhE');
	$s_user = new PDO('mysql:host=localhost; dbname=kurs', 'simple_user', 'clhxShDTFMje1OQ');
	if(isset($_COOKIE['user_email']))
	{
		return true;
	}
	return false;
}


function isAdmin()
{
	$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'n9bVar8g49TGjhE');
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
	$dbh = new PDO('mysql:host=localhost; dbname=kurs', 'root', 'n9bVar8g49TGjhE');
	$s_user = new PDO('mysql:host=localhost; dbname=kurs', 'simple_user', 'clhxShDTFMje1OQ');	
	$errors = array();
	if(!isset($_COOKIE["user_email"]))
	{

	if($_POST['user_email'] !="" && $_POST['user_password'] != "")
	{
		
		$email = filter_var(trim($_POST['user_email']), FILTER_SANITIZE_STRING);
		$password = filter_var(trim($_POST['user_password']), FILTER_SANITIZE_STRING);
				
		$query="SELECT * FROM users WHERE Email=?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $email);
		$stmt->execute();
		$result=$stmt->fetch();
		
		$hash=$result['user_password'];
		
		if(empty($result) == 0)
		{
			if (password_verify($password, $hash))
			{		
				$user_email_result = $result["Email"];
				
				if(setcookie("user_email",$user_email_result,time()+3600))
				{	
					$query = "SELECT fio,client_id FROM clientage WHERE client_login='$email'";
					
					$stmt = $dbh->prepare($query);
					$stmt->bindParam(1, $email);
					$stmt->execute();
					$result_fio=$stmt->fetch();
					setcookie("name",$result_fio['fio'],time()+3600);
					$user_id=$result_fio['client_id'];
					$date=date("Y-m-d H:i:s");
					setcookie("date",$date,time()+3600);
					$sesion_q="insert into sessions (user_id,log_in) values (?,?)";
					$stmt = $dbh->prepare($sesion_q);
					$stmt->bindParam(1, $user_id);
					$stmt->bindParam(2, $date);
					$stmt->execute();
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
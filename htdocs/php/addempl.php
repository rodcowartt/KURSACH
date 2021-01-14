<?
include("autorization.php");

$email  = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

$toisadmin = "UPDATE users SET is_admin = '1' where Email=?";
		$stmt = $dbh->prepare($toisadmin);
		$stmt->bindParam(1, $email);
		$stmt->execute();
//executeRequest($toisadmin);

$userid = "SELECT user_id FROM users WHERE Email=?";
		$stmt = $dbh->prepare($userid);
		$stmt->bindParam(1, $email);
		$stmt->execute();
		$takeresult=$stmt->fetch();
		$userid=$takeresult['user_id'];
		setcookie("user",$userid,time()+3600);
//$userid = mysqli_fetch_assoc($userid);
//$userid = $userid['user_id'];

$query = "INSERT INTO employees(user_id,date) VALUES(?,Now())";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $userid);
		$stmt->execute();
//$result = executeRequest($query);


header("Location: ../employees.php");
?>
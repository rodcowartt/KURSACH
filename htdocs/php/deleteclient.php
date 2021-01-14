<?
include("autorization.php");

$email =filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

$query = "DELETE FROM users WHERE Email=?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $email);
		$stmt->execute();
//executeRequest($query);

$query = "DELETE FROM clientage WHERE client_login=?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $email);
		$stmt->execute();
//executeRequest($query);

header("Location: ../clientage.php");

?>
<?
include("autorization.php");

$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);

$unadmin = "UPDATE users INNER JOIN employees ON users.user_id = employees.user_id SET is_admin = 0 WHERE employees.employee_id = ?";
		$stmt = $dbh->prepare($unadmin);
		$stmt->bindParam(1, $id);
		$stmt->execute();

//echo executeRequest($unadmin);

$query = "DELETE FROM employees WHERE employee_id=?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $id);
		$stmt->execute();
//$result = executeRequest($query);

header("Location: ../employees.php");
?>
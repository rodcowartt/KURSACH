<?
include("autorization.php");

$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);

$unadmin = "UPDATE users INNER JOIN employees ON users.user_id = employees.user_id SET is_admin = 0 WHERE employees.employee_id = '$id'";

echo executeRequest($unadmin);

$query = "DELETE FROM employees WHERE employee_id='$id'";

$result = executeRequest($query);

header("Location: ../employees.php");
?>
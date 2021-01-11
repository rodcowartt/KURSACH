<?
include("autorization.php");

$email  = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

$toisadmin = "UPDATE users SET is_admin = '1' where Email='$email'";

executeRequest($toisadmin);

$userid = executeRequest("SELECT user_id FROM users WHERE Email='$email'");

$userid = mysqli_fetch_assoc($userid);

$userid = $userid['user_id'];

$query = "INSERT INTO employees(user_id,date) VALUES('$userid',Now())";

$result = executeRequest($query);


header("Location: ../employees.php");
?>
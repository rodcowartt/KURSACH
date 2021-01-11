<?
include("autorization.php");

$email  = mysqli_real_escape_string($_POST['email']);

$query = "DELETE FROM users WHERE Email='$email'";

executeRequest($query);

$query = "DELETE FROM clientage WHERE client_login='$email'";

executeRequest($query);

header("Location: ../clientage.php");

?>
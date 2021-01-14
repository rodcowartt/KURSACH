<?

include("autorization.php"); 
$bring = filter_var(trim((int)$_POST['bring']), FILTER_SANITIZE_STRING);
$useremail = $_COOKIE['user_email'];

$take_id = "SELECT client_id FROM clientage WHERE client_login='$useremail'";
$stmt = $dbh->prepare($take_id);
$stmt->bindParam(1, $useremail);
$stmt->execute();
$takeresult=$stmt->fetch();
$client_id=$takeresult['client_id'];
/*
$takeresult = executeRequest($take_id);
$takeresult = mysqli_fetch_assoc($takeresult);
$client_id = $takeresult['client_id'];
*/
	
$updatebalance = "UPDATE cards set amount=amount+ ? where card_id= ?";
$stmt = $dbh->prepare($updatebalance);
$stmt->bindParam(1, $bring);
$stmt->bindParam(2, $client_id);
$stmt->execute();

header("Location: ../refill.php");
?>
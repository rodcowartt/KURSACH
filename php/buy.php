<?
include("autorization.php"); 

$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
$useremail = $_COOKIE['user_email'];
if (isset ($_COOKIE["error_msg"])) {setcookie("error_msg",'1',time () - 30, "/"); setcookie("success",'1',time () - 25,"/");}
$take_id = "SELECT client_id FROM clientage INNER JOIN users ON clientage.client_id = users.user_id WHERE client_login=?";
$stmt = $s_user->prepare($take_id);
$stmt->bindParam(1, $useremail);
$stmt->execute();
$takeresult1 = $stmt->fetch();

	$findproperty = "SELECT * FROM property WHERE user_id_prop = ?";
	$stmt = $s_user->prepare($findproperty);
    $stmt->bindParam(1, $id);
    $stmt->execute();
	$takeresult = $stmt->fetch();
	
	$id_prop = $takeresult['user_id_prop'];
	$address = $takeresult['address'];
	$cost = $takeresult['cost'];
	
	$address1= "SELECT address FROM property WHERE user_id_prop = ?";
	$stmt = $s_user->prepare($address1);
    $stmt->bindParam(1, $id);
    $stmt->execute();
	$addresult=$stmt->fetch();
	$addresult1=$addresult['address'];
	
	$client_id = $takeresult1['client_id'];

	$find_amount= "SELECT amount FROM cards WHERE card_id = ?";
	$stmt = $s_user->prepare($find_amount);
    $stmt->bindParam(1, $client_id);
    $stmt->execute();
	$result_amount=$stmt->fetch();
	$amount=$result_amount['amount'];	
	
	
if (($amount - $cost) >= 0)
{
	$take_card_id = "SELECT card_id FROM cards WHERE card_id=?";
	$stmt = $s_user->prepare($take_card_id);
	$stmt->bindParam(1, $client_id);
	$stmt->execute();
	$result = $stmt->fetch();
	$card_id = $result['card_id'];
	
	$s_user->beginTransaction();

		$queryToContracts = "INSERT INTO contracts(cost,client_id,address,conclusion_date) VALUES(?,?,?,Now())";
		$stmt = $s_user->prepare($queryToContracts);
		$stmt->bindParam(1, $cost);
		$stmt->bindParam(2, $client_id);
		$stmt->bindParam(3, $addresult1);
		$stmt->execute();
	//
	$deletePropertyQuery = "UPDATE property SET deleted = 1 WHERE user_id_prop=?";
	$stmt = $s_user->prepare($deletePropertyQuery);
	$stmt->bindParam(1, $id);
	$stmt->execute();
	
	$plus_q=("update cards set amount=amount + ? where card_id=1");
	$stmt = $s_user->prepare($plus_q);
	$stmt->bindParam(1, $cost);
	$stmt->execute();
	
	$minus_q=("update cards set amount=amount - ? where card_id=?");
	$stmt = $s_user->prepare($minus_q);
	$stmt->bindParam(1, $cost);
	$stmt->bindParam(2, $card_id);
	$stmt->execute();
	
	$s_user->commit();
	setcookie("success",'1',time () + 25,"/");
}
else
{
	setcookie("error_msg",'1',time () + 25,"/");
}
	
//
header("Location: ../property_list.php");
?>
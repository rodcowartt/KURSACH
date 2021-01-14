<?
include("autorization.php"); 

$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
$useremail = $_COOKIE['user_email'];

$take_id = "SELECT client_id FROM clientage INNER JOIN users ON clientage.client_id = users.user_id WHERE client_login=?";
$stmt = $dbh->prepare($take_id);
$stmt->bindParam(1, $useremail);
$stmt->execute();
$takeresult1 = $stmt->fetch();

//if(mysqli_num_rows($takeresult1) == 1)
//
	$findproperty = "SELECT * FROM property WHERE id_property = ?";
	$stmt = $dbh->prepare($findproperty);
    $stmt->bindParam(1, $id);
    $stmt->execute();
	$takeresult = $stmt->fetch();
	
	$address1= "SELECT address FROM property WHERE id_property = ?";
	$stmt = $dbh->prepare($address1);
    $stmt->bindParam(1, $id);
    $stmt->execute();
	$addresult=$stmt->fetch();
	$addresult1=$addresult['address'];
	
	//$findpropertyresult = executeRequest($findproperty);
	$client_id = $takeresult1['client_id'];
	//if(mysqli_num_rows($takeresult) == 1)
	
		
		$id_prop = $takeresult['id_property'];
		$address = $takeresult['address'];
		$cost = $takeresult['cost'];
		
		//$queryToSold = "INSERT INTO sold(id_property,property_type,address,client_id,date_sale) VALUES('$id_prop','$type','$address','$client_id',Now())";
		//executeRequest($queryToSold);
		$queryToContracts = "INSERT INTO contracts(cost,client_id,address,conclusion_date) VALUES(?,?,?,Now())";
		$stmt = $dbh->prepare($queryToContracts);
		$stmt->bindParam(1, $cost);
		$stmt->bindParam(2, $client_id);
		$stmt->bindParam(3, $addresult1);
		$stmt->execute();
	//
	$deletePropertyQuery = "UPDATE property SET deleted = 1 WHERE id_property=?";
	$stmt = $dbh->prepare($deletePropertyQuery);
	$stmt->bindParam(1, $id);
	$stmt->execute();
//
header("Location: ../property_list.php");
?>
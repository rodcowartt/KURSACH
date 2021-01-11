<?
include("autorization.php"); 

$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
$useremail = $_COOKIE['user_email'];

$take_id = "SELECT client_id FROM clientage INNER JOIN users ON clientage.client_id = users.user_id WHERE client_login='$useremail'";

$takeresult = executeRequest($take_id);

if(mysqli_num_rows($takeresult) == 1)
{
	$findproperty = "SELECT * FROM property WHERE id_property = '$id'";
	$address1= "SELECT address FROM property WHERE id_property = '$id'";
	/*$address1result = executeRequest($address1);
	$takeadd1 = mysqli_fetch_assoc($takeadd1);
	$address3= $takeadd1['address'];*/
	$address2=executeRequest($address1);
	$addresult=$address2->fetch_assoc();
	$addresult1=$addresult['address'];
	
	$findpropertyresult = executeRequest($findproperty);
	$takeresult = mysqli_fetch_assoc($takeresult);
	$client_id = $takeresult['client_id'];
	if(mysqli_num_rows($findpropertyresult) == 1)
	{
		$findpropertyresult = mysqli_fetch_assoc($findpropertyresult);
		
		$id_prop = $findpropertyresult['id_property'];
		$address = $findpropertyresult['address'];
		$cost = $findpropertyresult['cost'];
		
		//$queryToSold = "INSERT INTO sold(id_property,property_type,address,client_id,date_sale) VALUES('$id_prop','$type','$address','$client_id',Now())";
		//executeRequest($queryToSold);
		$queryToContracts = "INSERT INTO contracts(cost,client_id,address,conclusion_date) VALUES('$cost','$client_id','$addresult1',Now())";
		executeRequest($queryToContracts);
	}
	$deletePropertyQuery = "UPDATE property SET deleted = 1 WHERE id_property='$id'";
	executeRequest($deletePropertyQuery);
}
header("Location: ../property_list.php");
?>
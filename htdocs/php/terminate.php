<?
include("autorization.php");

$id  = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);

$query = "DELETE FROM contracts WHERE contract_id=?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $id);
		$stmt->execute();
//$result = executeRequest($query);

header("Location: ../contracts.php");
?>
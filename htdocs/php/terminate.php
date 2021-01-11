<?
include("autorization.php");

$id  = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);

$query = "DELETE FROM contracts WHERE contract_id='$id'";

$result = executeRequest($query);

header("Location: ../contracts.php");
?>
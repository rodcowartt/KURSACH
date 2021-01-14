<?
include("autorization.php");

$id  = mysql_real_escape_string($_POST['id']);
$fio  = mysql_real_escape_string($_POST['fio']);
$type  = mysql_real_escape_string($_POST['type']);
$adress  = mysql_real_escape_string($_POST['adress']);


$query = "UPDATE clientage SET fio='$fio',property_type='$type',property_adress='$adress'";

$result = executeRequest($query);

echo $result;
?>
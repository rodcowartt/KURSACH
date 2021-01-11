<?
include("autorization.php");

$value1= filter_var(trim($_POST['search']), FILTER_SANITIZE_STRING);

setcookie("search",$value1,time()+3600);

header("Location: ../property_list.php");
?>
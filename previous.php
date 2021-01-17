<?
include("autorization.php");
setcookie('scrolls',$_COOKIE['previous']);
header("Location: ../property_list.php");
?>
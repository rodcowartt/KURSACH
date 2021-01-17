<?
include("autorization.php");
setcookie('scrolls',$_COOKIE['next']);
header("Location: ../property_list.php");
?>
<?php 
session_start();
var_dump($_SESSION["XF_SESSION_MANAGE_USER"]);
$sessionManageUserArray=$_SESSION["XF_SESSION_MANAGE_USER"];
var_dump($sessionManageUserArray);

phpinfo();
?>
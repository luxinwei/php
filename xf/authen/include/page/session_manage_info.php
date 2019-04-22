<?php
session_start();
$sessionManageUserArray=$_SESSION["XF_SESSION_MANAGE_USER"];
$manageuseraccount=trim($sessionManageUserArray["USERACCOUNT"]);
$manageuserpwd=trim($sessionManageUserArray["PWD"]);
$manageapptype=trim($sessionManageUserArray["APPTYPE"]);

?>
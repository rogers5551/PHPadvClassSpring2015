<?php
include './bootstrap.php';
$util = new Util();
//$util->setLoggedin(false);
$util->logOut();
echo 'Logged out successfully';
$util->redirect("login.php");

<?php
include './bootstrap.php';
$util = new Util();
$util->setLoggedin(false);
echo 'Logged out successfully';
$util->redirect("login.php");

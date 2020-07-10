<?php
require('required/config.php');
gen_log('Logged Out', 2);
session_start();
session_destroy();
session_start();

setcookie("uid", "", time() - 60 * 5);
$_SESSION['flagLogout'] = "You have been succesfully logged out";
header("location:login");

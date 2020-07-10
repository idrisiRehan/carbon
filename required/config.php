<?php
session_start();
ob_start();
$mysqli = new mysqli("localhost", "root", "", "carbon_ecomm");
$global = "http://localhost/carbon_ecomm/";

if ($mysqli->connect_errno)
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

function secure($strToSecure)
{
    global $mysqli;
    $strToSecure = mysqli_real_escape_string($mysqli, $strToSecure);
    $strToSecure = strip_tags($strToSecure);
    $strToSecure = htmlentities($strToSecure);
    $strToSecure = trim($strToSecure);
    return $strToSecure;
}
function isLoggedIn()
{
    if (isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['name']))
        return true;
    else
        return false;
}
function Encrypt($data)

{
    $cipher = md5(md5("rehan") . secure($data) . md5("idrisi"));
    return $cipher;
}
function pass($id)
{
    $id =    urlencode(base64_encode($id));
    return str_replace("%3D", "", $id);
}
function grab($id)
{
    $id = str_replace("%3D", "", $id);
    return urldecode(base64_decode($id));
}
function clean_date($date)
{
    return date('D d, M Y ', strtotime($date));
}
function month_only($date)
{
    return strtolower(date('M', strtotime($date)));
}
function year_only($date)
{
    return strtolower(date('Y', strtotime($date)));
}
function clean_date_time($date)
{
    return date('D d, M Y h:i:m:s a', strtotime($date));
}
function gen_log($work, $type = 1)
{
    if (isset($_SESSION['uid']))
        $adminId = $_SESSION['uid'];
    else
        $adminId = 0;
    global $mysqli;
    if (isset($_SESSION['uid'])) {
        $_SESSION['flag'] = $work;
        $sql = "INSERT INTO `admin_log` (`admin_id`,`work`,`work_type`) VALUES ($adminId,'$work',$type)";
        $mysqli->query($sql);
    }
}

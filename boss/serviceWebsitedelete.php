<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}

include_once("../connect.php");
$cn = new connect();
$cn->connectdb();
$service_id = $_POST['service_id'];
$sql = "DELETE FROM tbl_service WHERE service_id='" . $service_id . "'";
//echo $sql;
$cn->insertdb($sql);
if (mysqli_affected_rows($cn->getConnection()) > 0) {
    echo "true";
} else {
    echo "false";
}
    //header("location:bagweightview.php");

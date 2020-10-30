<?
include_once("connect.php");
session_start();
$con=new connect();
$con->connectdb();
$email = $_GET['email'];
$password = mysqli_real_escape_string($con->_connection, $_GET['pwd']);
$sql = $con->selectdb("select * from tbl_shipper where `shipper_email` = '".$email."' and `password` COLLATE latin1_general_cs = '".$password."'");

if(mysqli_num_rows($sql) > 0)
{
	$row = mysqli_fetch_assoc($sql);
	$_SESSION['shipper_id']=$row['shipper_id'];
	$_SESSION['shipper_name']=$row['shipper_name'];
	echo 0;
}
else
{
	echo "Invalid Email or Password";
}
?>
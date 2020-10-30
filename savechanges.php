<?
session_start();
include_once("connect.php");
$con=new connect();
$con->connectdb();
if(isset($_SESSION['shipper_id']))
	$customer_id = $_SESSION['shipper_id'];
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

if($_GET['btn'] == "addnew")
{
	$year = $_POST['year'];
	$customer_id = $_POST['customer'];
	$sqlName = $con->selectdb("SELECT s.shipper_name,s.shipper_email FROM tbl_shipper s where s.shipper_id = ".$customer_id);
	$rowName = mysqli_fetch_assoc($sqlName);
	
	$pathCust = "boss/Documents/".str_replace(" ","",$rowName['shipper_name'])."-".$customer_id;
	$pathYear = "boss/Documents/".str_replace(" ","",$rowName['shipper_name'])."-".$customer_id."/".$year;
	if(!file_exists($pathCust))
		{
			mkdir($pathCust);
		}
	if(!file_exists($pathYear))
		{
			mkdir($pathYear);
		}
			//insert in tbl_files table
			    if($_POST['filename'] == "")
			    {
		            $file_name = $_FILES['file']['name'];
			    }
		        else
		        {
    				$file_name = $_FILES['file']['name'];
    				$ext = explode(".",$file_name);
    				$count = count($ext);
    				$file_name = str_replace(" ","",$_POST['filename']).".".$ext[$count-1];
		        }
				$file_size =$_FILES['file']['size'];
				$file_tmp =$_FILES['file']['tmp_name'];
				$file_type=$_FILES['file']['type'];  
			
				move_uploaded_file($file_tmp,$pathYear."/".$file_name);
				
				
				$sqlName = $con->selectdb("SELECT s.shipper_name,s.shipper_email,d.files,d.document_id,d.year FROM tbl_document d,tbl_shipper s where s.shipper_id = d.shipper_id and d.shipper_id = ".$customer_id." and d.year = '".$year."'");
				if(mysqli_num_rows($sqlName) > 0)
				{
					$rows = mysqli_fetch_assoc($sqlName);
					$files = $rows['files'].$file_name.",";
					$sql = $con->insertdb("UPDATE tbl_document SET files='".$files."' WHERE shipper_id = ".$customer_id." and year = '".$year."'");
				}
				else
				{
					$current_date = date('Y-m-d');
					$file_name = $file_name . ",";
					$sql = $con->insertdb("INSERT INTO `tbl_document`(`shipper_id`, `current_date`, `year`, `files`, `entrypersonname`) VALUES (".$customer_id.",'".$current_date."','".$year."','".$file_name."','".$customer_id."')");
				}
				
		
		$contact=$con->selectdb("SELECT email FROM tbl_contact WHERE `con_id`=2");
		$row_contact = mysqli_fetch_assoc($contact);
        $to	= $row_contact['email'];
		$from=$rowName['shipper_email'];
		$name = $rowName['shipper_name'];
		$headers = "From: ".$from."\r\n"."X-Mailer: php";
		$subject = $name." Uploaded Some Documents";
		
		$docname="Document Name :".$file_name;
		$email="Email :".$rowName['shipper_email'];
						
		
		$body = $name."\n\n".$email."\n\n".$docname;
		mail($to, $subject, $body, $headers);
		
		
			if($sql == 0)
				echo 0;
			else
				echo 1;
		
		
}
if($_GET['btn'] == "deletefile")
{
	$name = $_GET['filename'];
	$year = $_GET['year'];
	$customer_id = $_GET['id'];
$sqlName = $con->selectdb("SELECT s.shipper_name,d.files,d.document_id,d.year FROM tbl_document d,tbl_shipper s where s.shipper_id = d.shipper_id and d.shipper_id = ".$customer_id." and d.year = '".$year."'");
$rowName = mysqli_fetch_assoc($sqlName);

$path = "boss/Documents/".str_replace(" ","",$rowName['shipper_name'])."-".$customer_id."/".$rowName['year']."/".$name;
if(file_exists($path))
{
unlink($path);

}

$UpFiles = str_replace($name.",","",$rowName['files']);
$sql = $con->insertdb("UPDATE tbl_document SET files = '".$UpFiles."' WHERE document_id = ".$rowName['document_id']);
if($sql == 0)
{
	echo 0;
}
else
{
	echo "Oops There are some Issues.";
} 

	 
}
if($_GET['btn'] == "changepwd")
{
    $customer_id = $_SESSION['shipper_id'];
	$pwd = $_GET['pwd'];
	$cpwd = $_GET['cpwd'];
$sqlName = $con->selectdb("SELECT s.shipper_id,s.shipper_email FROM tbl_shipper s where s.shipper_id = ".$customer_id." and s.password = '".$cpwd."'");
if(mysqli_num_rows($sqlName) == 1)
{
    $row = mysqli_fetch_assoc($sqlName);
    $sql = $con->insertdb("UPDATE tbl_shipper SET password = '".$pwd."' WHERE shipper_email = '".$row['shipper_email']."'");
    if($sql == 0)
    {
    	echo 0;
    }
    else
    {
    	echo "Oops There are some Issues.";
    }
}
else
    echo "Invalid Current Password..!";

	 
}
if($_GET['btn'] == "forgotpwd")
{
   
	$email = $_GET['email'];
$sqlName = $con->selectdb("SELECT s.password FROM tbl_shipper s where s.shipper_email = '".$email."'");
if(mysqli_num_rows($sqlName) > 0)
{
   $row = mysqli_fetch_assoc($sqlName);
   	$contact=$con->selectdb("SELECT email FROM tbl_contact WHERE `con_id`=2");
	$row_contact = mysqli_fetch_assoc($contact);
	$from	= $row_contact['email'];
	$to=$email;
	$headers = "From: ".$from."\r\n"."X-Mailer: php";
	$subject = "Finmasters: Forgot Password Request";
	$msg="Your Password is : ".$row['password'];	
	$body = $msg;
	mail($to, $subject, $body, $headers);
    echo "0";
}
else
    echo "Invalid Email Address..!";

	 
}
?>
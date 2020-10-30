<?
include_once("connect.php");
$cn=new connect();
$cn->connectdb();

	//echo "<script> alert('called');</script>";
	//print_r($_POST);die;
	
	
	//$subject=$_POST['subject'];		
	
	$email=mysqli_escape_string($cn->getConnection(),$_POST['email']);
	

	$verif_box = $_REQUEST["verif_box"];
				
	if($_POST['name']=="")
		echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Enter Name! </div>';
	else if($_POST['email']=="")
		echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Enter Email! </div>';
	else if($_POST['phone']=="")
		echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Enter Contact Number! </div>';
	
	else if($_POST['subject']=="")
		echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Enter Subject!</div>';
	else if($_POST['message']=="")
		echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Enter Message!</div>';
				
	else if(md5($verif_box).'a4xn' == $_COOKIE['tntcon'])
	{
		
	
	
		$contact=$cn->selectdb("SELECT email FROM tbl_contact WHERE `con_id`=2");
		while($row_contact = mysqli_fetch_array($contact))
		{
				$to	= $row_contact['email'];
		}
		
		
		
		{
		//$to = "bansalrupali@gmail.com";
		
		$from=$_POST['email'];
		$phone="Phone : ".$_POST['phone'];
		$headers = "From: ".$from."\r\n"."X-Mailer: php";
		$subject = "Morakhiya And Associates: You have an Inquiry from the ".$from;
		
		
		if(isset($_POST['message']))
			$msg="Message:".$_POST['message'];
		else
			$msg="";	
		
		if(isset($_POST['name']))
			$name="Name:".$_POST['name'];
		else
			$name="";
		$course="Subject :".$_POST['subject'];
		$email="Email :".$_POST['email'];
						
						
		
						//$items="Phone :".$_POST['items'];
						//$amount="Phone :".$_POST['amount'];
						//$chqno="Phone :".$_POST['chqno'];
						
		$body = $name."\n\n".$email."\n\n".$course."\n\n".$phone."\n\n".$msg;
						//$body = $name."\n\n".$phone."\n\n".$email."\n\n".$address."\n\n".$items."\n\n".$amount."\n\n".$chqno;
		if($domain!="localhost")
		{
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Message Sent Successfully! </div>';
			mail($to, $subject, $body, $headers);
		}
		else{
			echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Message Not Sent! </div>';
		}
		}
			
	}//if
					
	else {
				// if verification code was incorrect then return to contact page and show error
			echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Verification Code entered wrong! </div>';
		}
?>
  <?
include_once("connect.php");
$cn=new connect();
$cn->connectdb();

$sql = $cn->selectdb("SELECT * FROM  `tbl_page` where page_id=$page_id" );
//	echo mysqli_num_rows($sql2);
if (mysqli_num_rows($sql) > 0) 
{
	$row1 = mysqli_fetch_assoc($sql);
}

if(isset($_GET['sid']))
{
	$sql = $cn->selectdb("SELECT * FROM  `tbl_service` where slug='".$_GET["sid"]."'" );
	if (mysqli_num_rows($sql) > 0) 
	{
		$row1 = mysqli_fetch_assoc($sql);
		
		
	}
}
if(isset($_GET['cid']))
{
	$sql = $cn->selectdb("SELECT * FROM  `tbl_category` where slug='".$_GET['cid']."'" );
	if (mysqli_num_rows($sql) > 0) 
	{
		$row1 = mysqli_fetch_assoc($sql);
		
		
	}
}
if(isset($_GET['bid']))
{
	$sql = $cn->selectdb("SELECT * FROM  `tbl_blog` where slug='".$_GET['bid']."'" );
	if (mysqli_num_rows($sql) > 0) 
	{
		$row1 = mysqli_fetch_assoc($sql);
		
		
	}
}
?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
  <?
    //Base Path Domain Set Here
    $cn->setdomain();
    ?>
     <title>FINMASTERS | <?echo $row1['meta_tag_title'];?></title>
	<meta charset="utf-8">
	<meta name="description" content="FINMASTERS | <?echo $row1['meta_tag_description']?>">
	<meta name="keywords" content="FINMASTERS | <?echo $row1['meta_tag_keywords']?>">
	<meta name="title" content="FINMASTERS | <?echo $row1['meta_tag_title']?>">
	<meta property="og:image" content="<? echo $domain ?>/3.jpg" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <?
    $sqlFav = $cn->selectdb("SELECT image_name FROM  `tbl_favicon` " );
    if (mysqli_num_rows($sqlFav) > 0) 
    {
        $rowFav = mysqli_fetch_assoc($sqlFav);
        extract($rowFav);
        ?>
        <link href="favicon/big_img/<?echo $image_name?>" rel="icon" type="image/png">
        <?
    }
    ?>

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700%7CPlayfair+Display:400,700,700i,900,900i">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
		<![endif]-->
    <style>
.shadoweffect
{
box-shadow:0px 9px 57px 0px rgba(0, 0, 0, 0.39);
}
</style>
<style>
    .description ul li {
    padding: 5px;
    list-style-type:none;
    
    }
    .description ul li:before {
        margin-left:30px;
    content: "\e5c8";
    color:inherit;
    font-family: "Material Icons";
    padding-right:5px;
    }
	/* .main
	{
		padding-bottom:30px;
	} */
    </style>
  </head>
  <body>
    <div class="page-loader page-loader-variant-1">
      <div>
        <div class="page-loader-body">
          <div id="spinningSquaresG">
            <div class="spinningSquaresG" id="spinningSquaresG_1"></div>
            <div class="spinningSquaresG" id="spinningSquaresG_2"></div>
            <div class="spinningSquaresG" id="spinningSquaresG_3"></div>
            <div class="spinningSquaresG" id="spinningSquaresG_4"></div>
            <div class="spinningSquaresG" id="spinningSquaresG_5"></div>
            <div class="spinningSquaresG" id="spinningSquaresG_6"></div>
            <div class="spinningSquaresG" id="spinningSquaresG_7"></div>
            <div class="spinningSquaresG" id="spinningSquaresG_8"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="page">
      <header class="page-head">
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-corporate-dark" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="53px" data-lg-stick-up-offset="53px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-inner">
              <div class="rd-navbar-aside novi-background">
                <div class="rd-navbar-aside-toggle" data-custom-toggle=".rd-navbar-aside" data-custom-toggle-disable-on-blur="true"><span></span></div>
                <div class="rd-navbar-aside-content context-dark">
                  <ul class="rd-navbar-aside-group list-units">
						<?
						$sql = $cn->selectdb("select * from tbl_contact where con_id = 1");
						$row = mysqli_fetch_assoc($sql);
						extract($row);
						$contact = explode(",",$contact_no);
						$mail = explode(",",$email);
						?>
						 
					<li>
                      <div class="unit unit-horizontal unit-spacing-xs">
                        <div class="unit-left"><span class="novi-icon icon icon-xxs icon-primary fa-envelope-o offset-top-2"></span></div>
                        <div class="unit-body">
                            
                          <p class="text-white">
                              <? for($i=0;$i<count($mail);$i++){ ?>
                              <a class="link-white-v2" href="mailto:<? echo $mail[$i]; ?>" target="_BLANK"><? echo $mail[$i]; ?></a> | 
                               <? } ?>    
                              </p>
                            
                        </div>
                      </div>
                    </li>
					<li>
                      <div class="unit unit-horizontal unit-spacing-xs">
                        <div class="unit-left"><span class="novi-icon icon icon-xxs icon-primary fa-clock-o offset-top-2"></span></div>
                        <div class="unit-body">
                          <p class="text-white"><? echo $opening_hours; ?></p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="unit unit-horizontal unit-spacing-xs">
                      <? for($i=0;$i<count($contact);$i++){ ?>
                        <div class="unit-left"><span class="novi-icon icon icon-xxs icon-primary material-icons-phone icon-shift-2"></span></div>
                        <div class="unit-body"><a class="link-white-v2" href="tel:<?echo $contact[$i]; ?>"><?echo $contact[$i]; ?></a></div>
                        <? } ?>     
                      </div>
                    </li>
                  </ul>
                  <div class="rd-navbar-aside-group">
                      <div class="font-italic text-white">Follow Us:</div>
                    <ul class="list-inline list-inline-reset" style="margin-left:10px;margin-top:0px;">
					<?
								$sql = $cn->selectdb("select * from tbl_socialmedia order by recordListingID");
								while($row = mysqli_fetch_assoc($sql))
								{
									extract($row);
								
								?>
                               
								<li><a class="novi-icon icon icon-round icon-abbey-filled icon-xxs-smallest <? echo $description; ?>" href="<? echo $link_url; ?>" target="_BLANK"></a></li>

                                <?
								}
								?>
                      
                     
                    </ul>
                  </div>
                </div>
              </div>
              <div class="rd-navbar-group rd-navbar-search-wrap novi-background">
                <div class="rd-navbar-panel">
                  <button class="rd-navbar-toggle" data-custom-toggle=".rd-navbar-nav-wrap" data-custom-toggle-disable-on-blur="true"><span></span></button>
				  
				  <a class="rd-navbar-brand brand" href="Home/">
				  <?
						$sql = $cn->selectdb("SELECT * FROM  `tbl_logo` where logo_id=1" );
						//	echo mysqli_num_rows($sql2);
						if (mysqli_num_rows($sql) > 0) 
						{
							$row1 = mysqli_fetch_assoc($sql);
						}
					?>
                       
				  <img src="logo/big_img/<?echo $row1['image_name']?>" alt="<?echo $row1['image_name']?>" class="logoimg" style="margin-top:5px;"/>
				  </a>
                </div>
                <div class="rd-navbar-nav-wrap">
                  <div class="rd-navbar-nav-inner">
                    
                          <ul class="rd-navbar-nav">
                            <li class="<? if($page_id == 29)echo "active"; ?>"><a href="Home/">Home</a>
                            </li>
                           
                            <li class="<? if($page_id == 31)echo "active"; ?>"><a href="Services/">Services</a>
                              <ul class="rd-navbar-dropdown">
							  <?
							  $sql = $cn->selectdb("SELECT slug,`service_name` FROM  `tbl_service` order by recordListingID ASC" );
							  if(mysqli_num_rows($sql) > 0)
							  {
								  while($row = mysqli_fetch_Assoc($sql))
								  {
									  extract($row);
							  ?>
                                <li ><a href="Service_Detail/<?echo $slug;?>/"><? echo $service_name; ?></a></li>
								  <? }
							  }  ?>
                               
                              </ul>
                            </li>
                            
                            <li class="<? if($page_id == 39)echo "active"; ?>"><a href="Contact-Us/">Contact Us</a>
                            </li>
                            <? if(!isset($_SESSION['shipper_id'])){ ?>
                            <li class="<? if($page_id == 61)echo "active"; ?>"><a href="Login/">Login</a>
                            </li>
                            <? }else{ ?>
                              <li class="<? if($page_id == 62)echo "active"; ?>"><a href="MyDocuments/">My Documents</a>
                              <ul class="rd-navbar-dropdown">
                                  <li class="<? if($page_id == 61)echo "active"; ?>"><a href="ChangePassword/">Change Password</a>
                                 </li>
                                  <li class="<? if($page_id == 61)echo "active"; ?>"><a href="Logout/">Logout</a>
                                </li>
                                  </ul>
                            </li>
                              
                            <? } ?>
                          </ul>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
	
	
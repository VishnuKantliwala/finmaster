<?php
ob_start();
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");

include_once("image_lib_rname.php"); 
$con=new connect();
$con->connectdb();
$page_id= 36;

$social_id=$_GET['social_id'];

  
if(isset($_POST['updateSlider']))
{
		
		 $social_title = $_POST['social_title'];
		 $icon_name = $_POST['icon_name'];
			//$code = $_POST['code'];
			$description = $_POST['description'];
			//$image = $_POST['image'];
			$urllink = $_POST['urllink'];
					  		
				
				$frontimg2=$_POST['frontimg2'];
				
				if($_FILES["image_name"]['error']>0)
				
				{
				
				$con->insertdb("UPDATE `tbl_socialmedia` SET `social_title` = '".$social_title."', `description` = '".$description."', `image_name` = '".$frontimg2."', `link_url` = '".$urllink."' WHERE `tbl_socialmedia`.`social_id` = '".$social_id."'");
				}
				else
				{
				@unlink("../social/big_img/". $frontimg2);
				@unlink("../social/". $frontimg2);
							
                $sliderImage = createImage('image_name',"../social/");
				
				$con->insertdb("UPDATE `tbl_socialmedia` SET `social_title` = '".$social_title."', `description` = '".$description."', `image_name` = '".$sliderImage."', `link_url` = '".$urllink."' WHERE `tbl_socialmedia`.`social_id` = '".$social_id."'");
				}
				


	echo "<script>alert('Social Media is updated...');</script>;";
	
	header("location: socialView.php");
}


if(isset($_GET["Image"]))
{
	//print_r($_GET);die;
	$page=$_GET['page'];
	$social_id= $_GET['social_id'];
	$records=$con->selectdb("SELECT * FROM tbl_socialmedia where social_id=".$social_id."");
	while($row=mysqli_fetch_row($records))
	{
	  unlink('../social/'.$row[1]);
	  unlink('../social/big_img/'.$row[1]);

	}
	$con->selectdb("update tbl_socialmedia set image_name='' where social_id = '".$social_id."'");
	header("location: socialUpdate.php?social_id=".$social_id."&page=".$page);


}	

?>


<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>Finmasters</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">


        <!--Morris Chart-->
        <link rel="stylesheet" href="assets/libs/morris-js/morris.css" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css?v=<?echo time();?>" rel="stylesheet" type="text/css" />

        <!-- dropify -->
        <link href="assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.php" class="logo text-center">
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="16">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="assets/images/logo-sm.png" alt="" height="24">
                    </span>
                </a>
            </div>
            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>
                <li>
                    <h4 class="page-title-main">Social Media Update</h4>
                </li>
            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?include_once("menu.php");?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="mt-0 mb-2 header-title">Social Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">
                                    <input type="hidden" name="page" id="page" value="<? echo $_GET['page'];?>">
									 
                                    <?php
										$records=$con->selectdb("SELECT * FROM tbl_socialmedia where social_id=".$social_id."");
										while($row=mysqli_fetch_assoc($records))
										{
                                    ?>
                                                        
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Social Media Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="social_title" name="social_title" placeholder="Social Media Name" value="<? echo $row['social_title']; ?>">
                                        </div>
                                    </div>

                                    			
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><? echo $row['description']; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="image_name" name="image_name" class="dropify" data-default-file="<? if($row['image_name']!=''){echo "../social/". $row['image_name'];}?>"/>
                                            <? if($row['image_name']!=''){?>
                                                <a href="socialUpdate.php?social_id=<?php echo $row['social_id']; ?>&Image=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>
                                            <? } ?>
                                            <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row['image_name']?>"  />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">URL Link:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="urllink" name="urllink" placeholder="URL Link" value="<? echo $row['link_url']; ?>">
                                        </div>
                                    </div>	                              
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="updateSlider" id="updateSlider" class="btn btn-success">Update</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='socialView.php'; return false;" >Cancel</button>	
                                        </div>
                                    </div>
                                    <? } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- dropify js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>

    <!-- form-upload init -->
    <script src="assets/js/pages/form-fileupload.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <!-- ckeditor -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>

    </body>

</html>
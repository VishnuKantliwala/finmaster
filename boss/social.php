<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}
include_once("../connect.php");

$cn=new connect();
$cn->connectdb();
$page_id= 36;

include_once("image_lib_rname.php"); 


    if(isset($_POST['addSlider']))
    {	    
        
        $Image = createImage('image_name',"../social/");
        $social_title = $_POST['social_title'];
        $icon_name = $_POST['icon_name'];
        //$code = $_POST['code'];
        $description = $_POST['description'];
        //$image = $_POST['image'];
        $urllink = $_POST['urllink'];
                        
        $cn->insertdb("INSERT INTO `tbl_socialmedia` (`social_title`,`description`, `image_name`, `link_url`) VALUES ('".$social_title."', '".$description."', '".$Image."', '".$urllink."');");
            
        echo "<script>alert('Social Media is created...');</script>;";	
        
        header("location:socialView.php");
        
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
                    <h4 class="page-title-main">Social Media Add</h4>
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
                                <h4 class="mt-0 mb-2 header-title">Social Media Form</h4>
                                <form class="form-horizontal" method="post" action="#" id="myform" name="myform" enctype="multipart/form-data">				
                                                            
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Social Media Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="social_title" name="social_title" placeholder="Social Media Name">
                                        </div>
                                    </div>										
                                                            
                                   	<div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Image</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="image_name" name="image_name" class="dropify"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-12 control-label">URL Link</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="urllink" name="urllink" placeholder="URL Link">
                                        </div>
                                    </div>					
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="addSlider" id="addSlider" class="btn btn-success">Add</button>
                                            <button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='socialView.php'; return false;" >Cancel</button>
                                        </div>
                                    </div>
                                    
                                    
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
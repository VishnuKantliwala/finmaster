<?php
ob_start();
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
include_once("../sitemap.php");
$con=new connect();
$con->connectdb();

$page_id= 7;

$logo_id=$_GET['logo_id'];

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>Finmasters</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
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
                    <h4 class="page-title-main">Logo Edit</h4>
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
                                <h4 class="mt-0 header-title">Logo Form</h4>
                                <form class="form-horizontal" method="post" action="logo_upload.php" id="myform" name="myform" enctype="multipart/form-data">
									<?php
									$records=$con->selectdb("SELECT * FROM tbl_logo where logo_id=".$logo_id."");
									while($row=mysqli_fetch_row($records))
									{
									?>
									    <input id="logo_id" name="logo_id" type="hidden" value="<?php echo $row[0]; ?>"/>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-4">
											    <input type="file" id="frontimg" name="frontimg" class="dropify" data-default-file="<? if($row[1]!=''){echo "../logo/".$row[1];}?>"/>
                                            </div>
											<div class="col-sm-4">
                                                <? if($row[1]!=''){?>
                                                    <a href="logo_upload.php?id=<?php echo $row[0]; ?>&Image=Del" class="btn btn-lighten-danger" onClick="return confirm('Are you sure want to delete?');">Delete</a>
                                                <? } ?>
                                                <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row[1]?>" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="editbtn" id="editbtn" class="btn btn-success">Update</button>
												<button type="submit" name="myButton" id="myButton" class="btn btn-lighten-danger" onClick="window.location.href='logoView.php'; return false;" >Cancel</button>
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

    </div><!-- End page -->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- dropify js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>

    <!-- form-upload init -->
    <script src="assets/js/pages/form-fileupload.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
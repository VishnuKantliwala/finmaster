<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
include_once("../connect.php");
include_once("../navigationfun.php");
include_once("image_lib_rname.php"); 
$cn = new connect();
$cn->connectdb();
$page_id=37;
if (!isset($_GET['service_id'])) {
    header("location:serviceWebsiteview.php");
}
$service_id = $_GET['service_id'];
$sql = "SELECT * FROM tbl_service WHERE service_id='$service_id'";
$result = $cn->selectdb($sql);
if ($cn->numRows($result) > 0) {
    $row = $cn->fetchAssoc($result);
} else {
    header("location:serviceWebsiteview.php");
}
?>
<?php
if (isset($_POST['Submit'])) {
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    $meta_tag_title=$_POST['meta_tag_title'];
    $meta_tag_description=$_POST['meta_tag_description'];
    $meta_tag_keywords=$_POST['meta_tag_keywords'];					  		
    $slug=$_POST['slug'];
    $frontimg2=$_POST['frontimg2'];
    if($_FILES["frontimg"]['error'] > 0)// it means no new image selected insert previous one......
    {
    
        $con->insertdb("UPDATE `tbl_service` SET `service_name`='".$name."',`description`='".$desc."',`service_image`='".$frontimg2."', meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where service_id='".$service_id."'");
    }
    else
    {
    
        @unlink("../product/big_img/". $frontimg2);
        @unlink("../product/". $frontimg2);
        $single_image = createImage('frontimg',"../product/");

        $con->insertdb("UPDATE `tbl_service` SET `service_name`='".$name."',`description`='".$description."',service_image='".$single_image."',meta_tag_title='".$meta_tag_title."',meta_tag_description='".$meta_tag_description."',meta_tag_keywords='".$meta_tag_keywords."',slug='".$slug."' where service_id='".$service_id."'");
    }
  
    header("location:serviceWebsiteview.php");
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
    <link href="assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
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
                    <h4 class="page-title-main">Service Update</h4>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->

        <?php
        include 'menu.php';
        ?>

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
                                <h4 class="m-t-0 header-title">Update Service</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-2">
                                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Slug</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?php echo $row["slug"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="txtName">Service Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="txtName" class="form-control" placeholder="Service Name" value="<?php echo $row['service_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="txtDesc">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea required name="txtDesc" class="form-control" placeholder="Description"><?php echo $row['description']; ?></textarea>
                                                        <script>
                                                            CKEDITOR.replace('txtDesc');
                                                          </script>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="frontimg" name="frontimg" class="dropify" data-default-file="<? if($row["service_image"]!=''){echo "../product/".$row["service_image"];}?>"/>
                                                       
                                                        <input type="hidden" id="frontimg2" name="frontimg2" value="<?php echo $row["service_image"]?>"  />
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title"  value="<?php echo $row["meta_tag_title"]?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Description</label>
                                                    <div class="col-sm-4">
                                                        <textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description" ><?php echo $row["meta_tag_description"]?></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Keywords</label>
                                                    <div class="col-sm-4">
                                                        <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"><?php echo $row["meta_tag_keywords"]?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="example-placeholder"></label>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary width-md" name="Submit">Update</button>
                                                        <a href="serviceview.php" class="btn btn-lighten-primary waves-effect waves-primary  width-md">Cancel</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-box -->
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
            </div> <!-- content -->
            <?php
            include 'footer.php';
            ?>

            <!-- Vendor js -->
            <script src="assets/js/vendor.min.js"></script>
            <script src="assets/libs/switchery/switchery.min.js"></script>
            <!-- App js -->
            <script src="assets/js/app.min.js"></script>
            <!-- dropify js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>

<!-- form-upload init -->
<script src="assets/js/pages/form-fileupload.init.js"></script>
            <script>
                $(document).ready(function() {
                    $('[data-plugin="switchery"]').each(function(e, t) {
                        new Switchery($(this)[0], $(this).data())
                    });
                });
            </script>
</body>

</html>

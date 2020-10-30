<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
$cn = new connect();
$cn->connectdb();
$page_id=37;
?>
<?php
if (isset($_POST['Submit'])) {
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    $code = $_POST['txtCode'];
    $gst = $_POST['txtGST'];
    if(isset($_POST['chkRenew'])){
        $renew = 'yes';
    }else{
        $renew = 'no';
    }
    // If serice is task then
    if(isset($_POST['chkTask'])){
        $task = 'yes';
    }else{
        $task = 'no';
    }
    $sql = "INSERT INTO tbl_product(name,`desc`,code,is_renew,gst_rate,is_task) VALUES('" . $name . "','".$desc."','".$code."','".$renew."','".$gst."', '".$task."')";
    //echo $sql;
    $cn->insertdb($sql);
    header("location:serviceview.php");
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
                    <h4 class="page-title-main">Service</h4>
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
                                <h4 class="m-t-0 header-title">Add Service</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-2">
                                        <form class="form-horizontal" role="form" method="post">
                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="txtName">Service Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required name="txtName" class="form-control" placeholder="Service Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="txtDesc">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea required name="txtDesc" class="form-control" placeholder="Description"></textarea>
                                                        <script>
                                                            CKEDITOR.replace('txtDesc');
                                                          </script>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="frontimg" name="frontimg" class="dropify" />
                                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label"><span style="color:#F00; font-weight:bold;">*</span> Meta Tag Title</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="Meta Tag Title">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Description</label>
                                                    <div class="col-sm-4">
                                                        <textarea cols="5" rows="5" class="form-control" id="meta_tag_description" name="meta_tag_description" placeholder="Meta Tag Description" ></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">Meta Tag Keywords</label>
                                                    <div class="col-sm-4">
                                                        <textarea cols="5" rows="5" class="form-control" id="meta_tag_keywords" name="meta_tag_keywords" placeholder="Meta Tag Keywords"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="example-placeholder"></label>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary width-md" name="Submit">Add</button>
                                                        <a href="serviceWebsiteview.php" class="btn btn-lighten-primary waves-effect waves-primary  width-md">Cancel</a>
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
            <script>
                $(document).ready(function() {
                    $('[data-plugin="switchery"]').each(function(e, t) {
                        new Switchery($(this)[0], $(this).data())
                    });
                });
            </script>
</body>

</html>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
if ($_SESSION['control'] != "admin") {
    header("location:login.php");
}
include_once("../connect.php");
include_once("../navigationfun.php");
$cn = new connect();
$cn->connectdb();
$page_id=29;
if (!isset($_GET['sub_product_id'])) {
    header("location:subserviceview.php");
}
$sub_product_id = $_GET['sub_product_id'];
$sql = "SELECT * FROM tbl_sub_product WHERE sub_product_id=".$sub_product_id;
$result = $cn->selectdb($sql);
if ($cn->numRows($result) > 0) {
    $row = $cn->fetchAssoc($result);
} else {
    header("location:subserviceview.php");
}
?>
<?php
if (isset($_POST['Submit'])) {
    $service_id = $_POST['service_id'];
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    if($service_id != 0)
    {
        $sql = "UPDATE tbl_sub_product SET product_id = ".$service_id.",sub_product_name='" . $name . "', `description`='".$desc."' WHERE sub_product_id='" . $sub_product_id . "'";
        //echo $sql;
        $cn->insertdb($sql);
        header("location:subserviceview.php");
    }
    else
    {
        echo "<script>alert('Please Select Main Service or Add Main Service First..!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Finmaster</title>
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
                                <h4 class="m-t-0 header-title">Update Sub Service</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-2">
                                            <form class="form-horizontal" role="form" method="post">
                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="service_id">Select Service</label>
                                                    <div class="col-sm-4">
                                                        <select id="service_id" name="service_id" class="form-control">
                                                        <?
                                                        $sqlService = $cn->selectdb("SELECT product_id,`name` FROM tbl_product ORDER BY product_id DESC");
                                                        if($cn->numRows($sqlService) > 0)
                                                        {
                                                            while($rowService = $cn->fetchAssoc($sqlService))
                                                            {
                                                                ?>
                                                                <option value="<? echo $rowService['product_id'] ?>" <? if($row['product_id'] == $rowService['product_id']) echo "selected"; ?>><? echo $rowService['name'] ?></option>
                                                                <?
                                                            }
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="0">--No Service Available--</option>
                                                            <?
                                                        }
                                                        ?>
                                                            
                                                        </select>
                                                    </div>
                                                    <label class="col-sm-2  col-form-label" for="txtName">Sub Service Name</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" required name="txtName" class="form-control" placeholder="Sub Service Name" value="<?php echo $row['sub_product_name']; ?>">
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
            <script>
                $(document).ready(function() {
                    $('[data-plugin="switchery"]').each(function(e, t) {
                        new Switchery($(this)[0], $(this).data())
                    });
                });
            </script>
</body>

</html>

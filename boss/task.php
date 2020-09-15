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
include_once("./image_lib_rname.php");
$cn = new connect();
$cn->connectdb();
$page_id=22;
?>
<?php
$error = "";
if (isset($_POST['Submit'])) {
    $customer = $_POST['txtShipperID'];
    $taskName = $_POST['txtTaskName'];
    $taskQuantity = $_POST['txtTaskQuantity'];
    $desc = $_POST['txtDesc'];
    $files = "";
    $date = date("Y-m-d h:i:s");
    $status = 0;

    //$date = getdate();
    //$date = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].":".$date['minutes'].":".$date['seconds'];
    
    if(trim($customer) == ""){
        $error = "* No customer exists with same name";

    }
    else
    {
        //-----------------------------
        //Multiple Files
        //-----------------------------
        
        $files = createFiles('download_file', "./task_files/");
        


        $shipper_id = $customer;
        $sql = "INSERT INTO tbl_task(service_inclusion_id, shipper_id, task_name, task_quantity, task_description, task_date, task_status) VALUES('0','".$shipper_id."','".$taskName."','".$taskQuantity."','".$desc."','".$date."','".$status."')";
        $cn->insertdb($sql);

        $task_id = $cn->getLastInsertedID();

        foreach( $files as $file ) {
            if($file != '0')
            {
                $sql = "INSERT INTO tbl_task_file(task_id, task_file_name) values (".$task_id.", '".$file."')";
                $cn->insertdb($sql);
            }
        }

        header("location:notAssignedTaskView.php");
    }

    

    


    // echo $sql;
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ICED Infotech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- dropify -->
    <link href="assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    
    <style type="text/css">
    #shipper-list {
        float: left;
        list-style: none;
        margin-top: -3px;
        padding: 0;
        width: 97%;
        position: absolute;
        z-index: 1;
    }

    #shipper-list li {
        padding: 10px;
        background: #f0f0f0;
        border-bottom: #bbb9b9 1px solid;
    }

    #shipper-list li:hover {
        background: #ece3d2;
        cursor: pointer;
    }
    </style>
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
                    <h4 class="page-title-main">Task</h4>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->

        <?php
        include 'menu.php';
        ?>

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title">Add Task</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-2">
                                            <form class="form-horizontal" enctype="multipart/form-data" role="form"
                                                method="post">
                                                <div class="form-group row">
                                                    <h3 style="color:red">
                                                        <?echo $error?>
                                                    </h3>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtCustomer">Customer</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="txtShipper" name="txtShipper"
                                                            class="form-control" placeholder="Customer Name">
                                                        <div id="suggesstion-box"></div>
                                                        <input type="hidden" id="txtShipperID" name="txtShipperID"
                                                            class="form-control" value="">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="txtCustomer">Task
                                                        Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="txtTaskName" name="txtTaskName"
                                                            class="form-control" placeholder="Task Name">


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtCustomer">Quantity</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" id="txtTaskQuantity" name="txtTaskQuantity"
                                                            class="form-control" placeholder="Quantity">


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtDesc">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="txtDesc" id="txtDesc" class="form-control">
                                                      </textarea>
                                                        <script>
                                                        CKEDITOR.replace('txtDesc');
                                                        </script>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="download_file">Files</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" id="download_file" name="download_file[]" class="dropify" multiple />
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="example-placeholder"></label>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary width-md"
                                                            name="Submit">Add</button>
                                                        <a href="notAssignedTaskView.php"
                                                            class="btn btn-lighten-primary waves-effect waves-primary width-md">Cancel</a>
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

            <!-- dropify js -->
            <script src="assets/libs/dropify/dropify.min.js"></script>          

            <!-- form-upload init -->
            <script src="assets/js/pages/form-fileupload.init.js"></script>  

            <!-- App js -->
            <script src="assets/js/app.min.js"></script>

            <script type="text/javascript">
            $("#txtShipper").keyup(function() {
                if ($("#txtShipper").val() == "") {
                    $("#txtShipperID").val('');
                    $("#suggesstion-box").hide();
                    $("#chkOther").prop("checked", true);
                } else {
                    $("#chkOther").prop("checked", false);
                    $.ajax({
                        type: "POST",
                        url: "fetch_shipper.php",
                        data: 'keyword=' + $(this).val(),
                        success: function(data) {
                            $("#suggesstion-box").show();
                            $("#suggesstion-box").html(data);
                            $("#txtShipper").css("background", "#FFF");
                        }
                    });
                }
            });

            function selectShipper(name, id) {
                $("#txtShipper").val(name);
                $("#txtShipperID").val(id);
                $("#suggesstion-box").hide();
            }
            </script>

</body>

</html>
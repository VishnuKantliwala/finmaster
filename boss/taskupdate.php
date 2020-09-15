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

$task_id = $_GET['task_id'];
$sql = "SELECT * FROM tbl_task t, tbl_shipper s where t.shipper_id = s.shipper_id  and t.task_id=".$task_id;
$result = $cn->selectdb($sql);
if ($cn->numRows($result) > 0) {
    $row = $cn->fetchAssoc($result);
    extract($row);
} else {
    // header("location:nonAssignedTaskview.php");
}


?>
<?php
$error = "";
if (isset($_POST['Submit'])) {
    
    $task_id = $_POST['task_id'];
    $taskName = $_POST['txtTaskName'];
    $desc = $_POST['txtDesc'];
    
    $sql = "UPDATE tbl_task SET task_name = '".$taskName."',  task_description = '".$desc."' WHERE task_id=".$task_id;
    $cn->insertdb($sql);

    $files = createFiles('download_file', "./task_files/");

    foreach( $files as $file ) {
        if($file != '0')
        {
            $sql = "INSERT INTO tbl_task_file(task_id, task_file_name) values (".$task_id.", '".$file."')";
            $cn->insertdb($sql);
        }
    }
    
    header("location:notAssignedTaskView.php");


    


    // echo $sql;
    
}

//multiple pdf delete Product..
if(isset($_REQUEST["btnDeleteFiles"]))
{
	$product_id = $_POST['task_id'];

	
	if(isset($_REQUEST["fileEdit"]))
	{
		foreach($_REQUEST['fileEdit'] as $row)
		{
            $sqlFile = $cn->selectdb("SELECT task_file_name FROM tbl_task_file WHERE task_file_id = ".$row);
            if( $cn->numRows($sqlFile) > 0 )
            {
                $rowFile = $cn->fetchAssoc($sqlFile);
                @unlink('./task_files/'.$rowFile['task_file_name']);			 
            }
			 
		}
        
        $cn->selectdb("DELETE FROM tbl_task_file WHERE task_file_id IN (".implode(',',$_REQUEST['fileEdit']) .")");
		
		header("location: taskupdate.php?task_id=".$task_id);
	}
	else
	{
		$error = 'No file selected';
	}
		
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

    <link href="assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />

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
                                <h4 class="m-t-0 header-title">Update Task</h4>
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
                                                        <input readonly type="text" id="txtShipper" name="txtShipper"
                                                            class="form-control" placeholder="Customer Name"
                                                            value="<?echo $shipper_name?>">
                                                        <div id="suggesstion-box"></div>

                                                        <input type="hidden" id="txtShipperID" name="txtShipperID"
                                                            class="form-control" value="">

                                                        <input type="hidden" id="task_id" name="task_id"
                                                            class="form-control" value="<?echo $task_id?>">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="txtCustomer">Task
                                                        Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="txtTaskName" name="txtTaskName"
                                                            class="form-control" placeholder="Task Name"
                                                            value="<?echo $task_name?>">


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtCustomer">Quantity</label>
                                                    <div class="col-sm-10">
                                                        <input readonly type="number" id="txtTaskQuantity"
                                                            name="txtTaskQuantity" class="form-control"
                                                            placeholder="Quantity" value="<?echo $task_quantity?>">


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtDesc">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="txtDesc" id="txtDesc" class="form-control">
                                                      <?echo $task_description?>
                                                      </textarea>
                                                        <script>
                                                        CKEDITOR.replace('txtDesc');
                                                        </script>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">
                                                        Files</label>
                                                    <input type="hidden" class="form-control" id="frontpdf"
                                                        name="frontpdf" placeholder="Multiple pdfs"
                                                        value="<? echo $row['pdf_file']; ?>">

                                                    <div class="col-sm-10">
                                                        <input type="file" id="download_file" name="download_file[]"
                                                            class="dropify" multiple />
                                                        <div class="attached-files mt-4">
                                                            <div class="task-tags mt-2">
                                                                <h5>Files</h5>
                                                                <?
                                                                if(isset($_GET["task_id"]))
                                                                {
                                                                    $sqlFiles = $cn->selectdb( "SELECT task_file_name, task_file_id FROM tbl_task_file WHERE task_id = ".$task_id );
                                                                    if( $cn->numRows($sqlFiles) > 0 )
                                                                    {
                                                                        while($rowFiles = $cn->fetchAssoc($sqlFiles))
                                                                        {
                                                                ?>
                                                                <li class="list-inline-item file-box">
                                                                    <input type="checkbox" name="fileEdit[]" value="<?php echo $rowFiles['task_file_id']; ?>"data-plugin="switchery" data-color="#1AB394" data-secondary-color="#ED5565" data-size="small" /> <?echo $rowFiles['task_file_name'];?>

                                                                    
                                                                </li>
                                                                <?php
                                                                        }
                                                                        echo '<div class="row mt-2 mb-2"><div class="col-12"><input type="submit" class="btn btn-lighten-danger" name="btnDeleteFiles" value="Delete Selected files"></div></div>';
                                                                    }
                                                                    else {
                                                                        echo "No files";
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="example-placeholder"></label>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary width-md"
                                                            name="Submit">Update</button>
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

            <script src="assets/libs/switchery/switchery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('[data-plugin="switchery"]').each(function(e, t) {
                        new Switchery($(this)[0], $(this).data())
                    });
                });
            </script>


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
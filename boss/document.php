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
$page_id=22;
?>
<?php
$error = "";
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}	  
if(isset($_POST['addProduct']))
{
    
    $clientname = $_POST['clientname'];
    $customer_id = $_POST['selectcustomer'];
    $selectservice = $_POST['selectservice'];
    $selectagent = $_POST['selectagent'];
    $parts = explode('-', date("d-m-Y"));
    $current_date  = "$parts[2]-$parts[1]-$parts[0]";
    $parts1 = explode('-', $_POST['start_date']);
    $start_date  = "$parts1[2]-$parts1[1]-$parts1[0]";
    $parts2 = explode('-', $_POST['end_date']);
    $end_date  = "$parts2[2]-$parts2[1]-$parts2[0]";
    $premium = $_POST['premium'];
    $companyname = $_POST['companyname'];
    $policyno = $_POST['policyno'];
                
    $con->insertdb("INSERT INTO `tbl_document`(`client_name`,`shipper_id`, `product_id`, `agent_id`, `current_date`, `start_date`, `end_date`, `premium`, `company_name`, `policy_no`,`entrypersonname`) VALUES ('".$clientname."',".$customer_id.",".$selectservice.",".$selectagent.",'".$current_date."','".$start_date."','".$end_date."','".$premium."','".$companyname."','".$policyno."','".$_SESSION['user']."')");
    $last_id = mysqli_insert_id($con->getConnection());
    if(!file_exists("Documents/".$customer_id))
    {
        mkdir("Documents/".$customer_id);
    }
        //insert in tbl_files table
    if(isset($_FILES['file'])){

        foreach($_FILES['file']['tmp_name'] as $key => $tmp_name)
        {
            $file_name = rand(100, 999).$_FILES['file']['name'][$key];
            $file_size =$_FILES['file']['size'][$key];
            $file_tmp =$_FILES['file']['tmp_name'][$key];
            $file_type=$_FILES['file']['type'][$key];  
        
            move_uploaded_file($file_tmp,"Documents/".$customer_id."/".$file_name);
            if($file_type != "application/pdf")
            {
                $source_img = "Documents/".$customer_id."/".$file_name;
                $destination_img = "Documents/".$customer_id."/".$file_name;

                $d = compress($source_img, $destination_img, 85);
            }
            if($file_name != "")
                $con->insertdb("INSERT INTO `tbl_files`(`shipper_id`,`document_id`, `file_name`,`fdate`) VALUES (".$customer_id.",".$last_id.",'".$file_name."','".date('Y-m-d')."')");
        }
    }	
            
    header("location:documentView.php");
    
    // echo $sql;
    
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
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="./assets/js/vendor.min.js"></script>
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
                    <h4 class="page-title-main">Document</h4>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->

        <?php
        include 'menu.php';
        ?>
        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post">
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row nameBoxWrap" name="nameBoxWrap">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title">Add Document</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="p-2">

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
                                                        <input type="hidden" id="txtShipperID" name="selectcustomer"
                                                            class="form-control" value="">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtService">Service</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="selectservice"
                                                            name="selectservice">
                                                            <option value="0" disabled selected>Select Service</option>
                                                            <?
                                                            $sql = $con->selectdb("select * from tbl_product ORDER BY name");
                                                            while($row = mysqli_fetch_assoc($sql))
                                                            {
                                                            ?>
                                                            <option value="<? echo $row['product_id'] ?>">
                                                                <? echo $row['name'] ?>
                                                            </option>
                                                            <? 
                                                            }
                                                            ?>
                                                        </select>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtService">Agent</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="selectagent"
                                                            name="selectagent">
                                                            <option value="0" disabled selected>Select Agent</option>
                                                            <?
                                                            $sql = $con->selectdb("select * from tbl_agent ORDER BY agent_name");
                                                            while($row = mysqli_fetch_assoc($sql))
                                                            {
                                                            ?>
                                                            <option value="<? echo $row['agent_id'] ?>">
                                                                <? echo $row['agent_name'] ?>
                                                            </option>
                                                            <? 
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="companyname">Company
                                                        Name</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" id="companyname" name="companyname"
                                                            class="form-control" placeholder="Company Name">
                                                    </div>

                                                    <label class="col-sm-2  col-form-label" for="companyname">Policy
                                                        Number</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" id="policyno" name="policyno"
                                                            class="form-control" placeholder="Policy Number">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="companyname">Start
                                                        Date:</label>
                                                    <div class="col-sm-4">
                                                        <input data-date-format='dd-mm-yyyy' type="date"
                                                            class="form-control" id="start_date" name="start_date"
                                                            placeholder="Select Date">
                                                    </div>

                                                    <label class="col-sm-2  col-form-label" for="companyname">From
                                                        Date</label>
                                                    <div class="col-sm-4">
                                                        <input tdata-date-format='dd-mm-yyyy' type="date"
                                                            class="form-control" id="end_date" name="end_date"
                                                            placeholder="Select Date">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="premium">Premium</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="premium" name="premium"
                                                            class="form-control" placeholder="Premium">


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label" for="txtCustomer">Document
                                                        Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="txtDocumentName" name="txtDocumentName"
                                                            class="form-control" placeholder="Document Name">


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2  col-form-label"
                                                        for="txtCustomer">Quantity</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" id="txtDocumentQuantity"
                                                            name="txtDocumentQuantity" class="form-control"
                                                            placeholder="Quantity">


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
                                                        for="example-placeholder"></label>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary width-md"
                                                            name="Submit">Add</button>
                                                        <a href="documentView.php"
                                                            class="btn btn-lighten-primary waves-effect waves-primary width-md">Cancel</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div> <!-- end card-box -->
                            </div><!-- end col -->
                            <input type="hidden" id="addSectionCount" value="1" name="addSectionCount">
                            <div class="col-md-6" > 
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title">Document1:</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="p-2">
                                                <div class="form-group row">
                                                    <div class="col-md-9">

                                                        <input type="file" id="file" name="file[]"
                                                            accept="image/jpeg,image/jpg,image/jpe,image/png,image/gif,image/webp,image/bmp,image/tiff,application/pdf">
                                                        <p class="text text-danger">(MAX FILE UPLOAD SIZE 2 MB)</p>
                                                        <script type="text/javascript">
                                                        $('#file').bind('change', function() {

                                                            var fileSize = this.files[0].size / 1024;

                                                            var maxSize = 2000;
                                                            var ext = $('#file').val().split('.').pop()
                                                                .toLowerCase();
                                                            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg',
                                                                    'pdf'
                                                                ]) == -1) {
                                                                alert('Invalid File!');
                                                                $('#file').val('');
                                                                return false;
                                                            } else {
                                                                if (fileSize > maxSize) {
                                                                    alert(
                                                                        'Please Select File Less Than 2 MB');
                                                                    $('#file').val('');
                                                                    return false;

                                                                }
                                                            }

                                                        });
                                                        </script>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button type="button" onClick="addNameSection()"
                                                            class="btn btn-success">ADD MORE</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div>
                                    <div class="card-box">
                                        <h4 class="m-t-0 header-title">Add Document</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <?php
            include 'footer.php';
            ?>
        </form>
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

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

        <script>

        function addNameSection(){
            
            var addSectionCount=$("#addSectionCount").val();
            addSectionCount++;
            $("#addSectionCount").val(addSectionCount);

            $('#nameBoxWrap').append('<div id="nameBox'+addSectionCount+'" class="col-md-6"><div class="card-box"><h4 class="m-t-0 header-title">Document'+addSectionCount+':</h4><div class="row"><div class="col-12"><div class="p-2"><div class="form-group row"><div class="col-md-9"><input type="file" id="file'+addSectionCount+'" name="file[]" accept="image/jpeg,image/jpg,image/jpe,image/png,image/gif,image/webp,image/bmp,image/tiff,application/pdf"><p class="text text-danger">(MAX FILE UPLOAD SIZE 2 MB)</p></div><div class="col-md-3"><button type="button" onClick="addNameSection()" class="btn btn-success">ADD MORE</button><input type="button"  class="button" value="REMOVE" onclick=removeNameSection("'+addSectionCount+'")/></div></div></div></div></div></div></div>');

            

        }

        function removeNameSection(removeId){
            var addSectionCount=$("#addSectionCount").val();
            if(addSectionCount > 1){
                addSectionCount--;
                $("#addSectionCount").val(addSectionCount);
                $("#nameBox"+removeId).remove();
            }
        }

        </script>

</body>

</html>
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
    
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="./assets/js/vendor.min.js"></script>
    <style type="text/css">
    #customer-list{
        float:left;
        list-style:none;
        margin-top:-3px;
        padding:0;
        width:97%;
        position: absolute;
        z-index:1;
    }
    #customer-list li{
        padding: 10px;
        background: #f0f0f0;
        border-bottom: #bbb9b9 1px solid;
    }
    #customer-list li:hover{
        background:#ece3d2;
        cursor: pointer;
    }
    </style>
    <!-- dropify -->
    <link href="assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="assets/libs/x-editable/bootstrap-editable.css" rel="stylesheet" type="text/css" />

    <!-- Treeview css -->
    <link href="assets/libs/treeview/style.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
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

                                                    <div id="progressbarwizard">

                                                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-1">
                                                            <li class="nav-item">
                                                                <a href="#account-2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                                    <i class="mdi mdi-account-circle mr-1"></i>
                                                                    <span class="d-none d-sm-inline">Basic Details</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#profile-tab-2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                                    <i class="mdi mdi-face-profile mr-1"></i>
                                                                    <span class="d-none d-sm-inline">Category</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#finish-2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                                    <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                                    <span class="d-none d-sm-inline">Upload Documents</span>
                                                                </a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content border-0 mb-0">

                                                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                                            </div>

                                                            <div class="tab-pane" id="account-2">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group row mb-3">
                                                                            <label class="col-sm-2  col-form-label" for="txtCustomer">Customer</label>
                                                                            <div class="col-sm-4">
                                                                                <input type="text" id="txtShipper" name="txtShipper" class="form-control" placeholder="Customer Name" autocomplete="off">
                                                                                <div id="suggesstion-box"></div>
                                                                            </div>
                                                                            <label class="col-sm-1  col-form-label" for="txtCustomer">ID</label>
                                                                            <div class="col-sm-4">
                                                                                <input type="text" id="txtShipperID" name="selectcustomer" class="form-control" placeholder="Customer ID" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-3">
                                                                            <label for="inputEmail3" class="col-sm-2 control-label">Select Year:</label>
                                                                            <div class="col-sm-3">
                                                                                <select id="year" name="year" class="form-control">
                                                                                    <option disabled readonly>Select Year</option>
                                                                                    <option value="BasicDocs">Basic Documents</option>
                                                                                    <?
                                                                                $d = date("Y");
                                                                                $syear = $d - 5;
                                                                                $eyear = $d + 1;
                                                                                for($i=$syear;$i<=$eyear;$i++)
                                                                                {
                                                                                ?>
                                                                                    <option value="<? echo $i ."-".intval($i+1); ?>">
                                                                                        <? echo $i ."-".intval($i+1); ?>
                                                                                    </option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                                </div> <!-- end row -->
                                                            </div>

                                                            <div class="tab-pane" id="profile-tab-2">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group row mb-3">
                                                                            <label class="col-md-3 col-form-label" for="name1"> Add/Select Category</label>
                                                                            <div class="col-md-9">
                                                                                <div id="checkTree">
                                                                                    <ul>
                                                                                        <li>No Category</li>
                                                                                        <li data-jstree='{"type":"file"}'>Test
                                                                                            <ul>
                                                                                                <li data-jstree='{"opened":true}'>Assets
                                                                                                    <ul>
                                                                                                        <li data-jstree='{"type":"file"}'>Css</li>
                                                                                                        <li data-jstree='{"opened":true}'>Plugins
                                                                                                            <ul>
                                                                                                                <li data-jstree='{"selected":true,"type":"file"}'>Plugin one</li>
                                                                                                                <li data-jstree='{"type":"file"}'>Plugin two</li>
                                                                                                            </ul>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li data-jstree='{"opened":true}'>Email Template
                                                                                                    <ul>
                                                                                                        <li data-jstree='{"type":"file"}'>Email one</li>
                                                                                                        <li data-jstree='{"type":"file"}'>Email two</li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li data-jstree='{"icon":"mdi mdi-view-dashboard"}'>Dashboard</li>
                                                                                                <li data-jstree='{"icon":"mdi mdi-format-font"}'>Typography</li>
                                                                                                <li data-jstree='{"opened":true}'>User Interface
                                                                                                    <ul>
                                                                                                        <li data-jstree='{"type":"file"}'>Buttons</li>
                                                                                                        <li data-jstree='{"type":"file"}'>Cards</li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                                <li data-jstree='{"icon":"mdi mdi-texture"}'>Forms</li>
                                                                                                <li data-jstree='{"icon":"mdi mdi-view-list"}'>Tables</li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <li><a href="#" id="inline-firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname">Add Category</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div> <!-- end col -->
                                                                </div> <!-- end row -->
                                                            </div>

                                                            <div class="tab-pane" id="finish-2">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group row mb-3">
                                                                            <input type="file" class="dropify" name="file[]" data-height="200" multiple/>
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                                </div> <!-- end row -->
                                                            </div>

                                                            <ul class="list-inline mb-0 wizard">
                                                                <li class="previous list-inline-item">
                                                                    <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                                                </li>
                                                                <li class="next list-inline-item float-right">
                                                                    <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                                                                </li>
                                                            </ul>

                                                        </div> <!-- tab-content -->
                                                    </div> <!-- end #progressbarwizard-->



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
        </form>
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        <script type="text/javascript">
        $("#txtShipper").keyup(function(){
            if($.trim($("#txtShipper").val()) == ""){
                $("txtShipper").val('');
                $("#txtShipperID").val('');
            }else{
                $.ajax({
                    type: "POST",
                    url: "fetch_customer.php",
                    data:'keyword='+$(this).val(),
                    success: function(data){
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#txtShipper").css("background","#FFF");
                    }
                });
            }
        });

        function selectCustomer(name, id) {
            $("#txtShipper").val(name);
            $("#txtShipperID").val(id);
            $("#suggesstion-box").hide();
        }
        </script>
        <script>
            fillTreeView();
            function fillTreeView()
            {
                var nodes = "";
                $.ajax({		
                    type:'GET',
                    url:'document_interaction.php?type=fillTreeView',			
                    success:function(data)
                    {
                        console.log(data);
                        // nodes = "<tr id='loaderRowPayment'><td colspan='8' style='text-align:center;'><img src='Loader.gif' style='width:17%;' id='loader'/></td></tr>";
                        // $('#paymentList > tbody:last-child').append(loaderRow);
                        // setTimeout(() => {
                        //     $('#paymentList > tbody').empty();
                        //     $('#paymentList > tbody').append(data);
                           
                        // }, 1000);
                    }
                });
            }
        </script>

        <!-- Plugins js-->
        <script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-wizard.init.js"></script>

        <!-- Tree view js -->
        <script src="assets/libs/treeview/jstree.min.js"></script>
        <script src="assets/js/pages/treeview.init.js"></script>

        <!-- Plugins js -->
        <script src="assets/libs/moment/moment.js"></script>
        <script src="assets/libs/x-editable/bootstrap-editable.min.js"></script>

        <!-- dropify js -->
        <script src="assets/libs/dropify/dropify.min.js"></script>

        <!-- form-upload init -->
        <script src="assets/js/pages/form-fileupload.init.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-xeditable.init.js"></script>
</body>

</html>
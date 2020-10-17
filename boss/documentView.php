<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}

include_once("../connect.php");
$cn = new connect();
$cn->connectdb();
$page_id=31;
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
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css -->
    <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <style>
    .form-control {
        padding: 10px;
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
                    <h4 class="page-title-main">Documents</h4>
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
                    <div class="card-box">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <a href="document.php" class="btn btn-primary width-md">Add</a>
                            </div>

                            <!-- <div class="col-sm-1">
                                <button id="clearFilter" class="btn btn-primary width-md openTaskModal">Open modal</button>
                            </div> -->
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-md-4">
                                <select class="form-control" type="text" name="ddl_shipper_id"
                                    id="ddl_shipper_id" >
                                    <option value="0">-- SELECT CLIENT --</option>
                                    <?
                                    $sqlShipper = $cn->selectdb("SELECT s.shipper_name, s.shipper_id FROM tbl_shipper AS s, tbl_task AS t WHERE s.shipper_id = t.shipper_id ORDER BY s.shipper_name");
                                    if( $cn->numRows($sqlShipper) > 0 )
                                    {
                                        while($rowShipper = $cn->fetchAssoc($sqlShipper))
                                        {
                                    ?>
                                    <option value="<?echo $rowShipper['shipper_id']?>"><?echo $rowShipper['shipper_name']?></option>
                                    <?
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" type="text" name="ddl_user_id"
                                    id="ddl_user_id" >
                                    <option value="0">-- SELECT USER --</option>
                                    <?
                                    $sqlShipper = $cn->selectdb("SELECT u.user_name, u.user_id FROM tbl_user AS u, tbl_task_emp AS te WHERE u.user_id = te.user_id ORDER BY u.user_name");
                                    if( $cn->numRows($sqlShipper) > 0 )
                                    {
                                        while($rowShipper = $cn->fetchAssoc($sqlShipper))
                                        {
                                    ?>
                                    <option value="<?echo $rowShipper['user_id']?>"><?echo $rowShipper['user_name']?></option>
                                    <?
                                        }
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="col-md-4">
                                <select class="form-control" type="text" name="ddl_task_status"
                                    id="ddl_task_status" >
                                    <option value="0">All Tasks</option>
                                    <option value="1">Running Tasks</option>
                                    <option value="2">Complete Tasks</option>
                                    
                                </select>

                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input class="form-control input-daterange-datepicker" type="text" name="daterange"
                                    id="daterange" placeholder="Select Date Range" />
                            </div>
                            <div class="col-md-2">
                                <button id="applyFilter" class="btn btn-primary width-md">Filter</button>
                            </div>
                            <div class="col-md-2">
                                <button id="clearFilter" class="btn btn-primary width-md">Clear</button>
                            </div>
<!-- 
                            <div class="col-md-2">
                                <button id="sorting" class="btn btn-primary width-md">Sorting</button>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table id="datatable" class="table table-bordered dt-responsive ">
                                    <thead>
                                        <tr> 
                                            <th>View</th>
                                            
                                            <!--<th>Copy</th>-->
                                            <? 
                                            if( $_SESSION['control'] == "admin" ) { 
                                            ?>
                                            <th>Delete</th>
                                            <? 
                                            } 
                                            ?>
                                            <th>Document ID</th>
                                            <th>Customer Name</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>View</th>
                                       
                                            <!--<th>Copy</th>-->
                                            <? 
                                            if( $_SESSION['control'] == "admin" ) { 
                                            ?>
                                            <th>Delete</th>
                                            <? 
                                            } 
                                            ?>
                                            <th>Document ID</th>
                                            <th>Customer Name</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="results">
                                        <?
                                        $sql = $cn->selectdb("SELECT d.*,s.shipper_name FROM tbl_document d,tbl_shipper s WHERE s.shipper_id = d.shipper_id ORDER BY document_id DESC");
                                        if($cn->numRows($sql) > 0)
                                        {
                                            while($row = $cn->fetchAssoc($sql))
                                            {
                                                ?>
                                                <tr>
                                                    <td><a href="documentViewClientWise.php?document_id=<? echo $row['document_id']; ?>"><i class="fa fa-eye"></i></a></td>
                                                    <td><a onClick="deleteRecord(<?php echo $row['document_id']; ?>)"><i class="mdi mdi-delete"></i></a></td>
                                                    <td><? echo $row['document_id']; ?></td>
                                                    <td><? echo $row['shipper_name']; ?></td>
                                                </tr>
                                                <?
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    
                                </table>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
            </div> <!-- content -->
            
            <?php
            include 'footer.php';
            ?>

            <!-- Vendor js -->
            <script src="assets/js/vendor.min.js"></script>
            <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
            <script src="assets/js/pages/sweet-alerts.init.js"></script>
            <!-- third party js -->
            <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
            <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
            <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
            <!-- third party js ends -->
            <!-- <script src="assets/libs/select2/select2.min.js"></script> -->
            <script src="assets/libs/multiselect/jquery.multi-select.js"></script>
            <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
            <script src="assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
            <script src="assets/libs/moment/moment.js"></script>
            <script src="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
            <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
            <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
            <script src="assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
            <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
            <!-- Init js-->
            <script src="assets/js/pages/form-advanced.init.js"></script>
            <!-- App js -->
            <script src="assets/js/app.min.js"></script>
            <script>
                function deleteRecord(id) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        confirmButtonClass: "btn btn-success mt-2",
                        cancelButtonClass: "btn btn-danger ml-2 mt-2",
                        buttonsStyling: !1
                    }).then(function(t) {
                        if (t.value) {
                            $.ajax({
                                type: "GET",
                                async: false,
                                url: "document_interaction.php?type=deleteDocument&document_id="+id,
                                success: function(data) {
                                    if (data == 'true') {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Your record has been deleted.",
                                            type: "success"
                                        }).then(function(){
                                          window.open('documentView.php', '_self');
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Something went to wrong!",
                                            type: "error"
                                        });
                                    }
                                }
                            });
                        } else if (t.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelled",
                                type: "error"
                            });
                        }
                    });
                }
            </script>
            
</body>

</html>
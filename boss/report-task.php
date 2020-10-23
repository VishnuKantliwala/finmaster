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
include_once("image_lib_rname.php");
$cn = new connect();
$cn->connectdb();
$page_id=24;
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
    <link href="assets/libs/tablesaw/tablesaw.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/libs/multiselect/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="assets/libs/switchery/switchery.min.css" rel="stylesheet" />
    <link href="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- third party css -->
    <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    
    <style>
    .loader {
        opacity: 0.6;
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: rgb(249, 249, 249);
        display: none;
    }

    .centered {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        color: darkred;
        display: inline-flex;
        border: 1px solid grey;
        padding: 10px;
        background: black;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 800px;
        }
    }
    </style>
</head>

<body>
    <div class="loader" id="customLoader">
        <div class="centered">
            <img src="loader1.gif" style="height:40px;" />
            <h4 style="color:#d0d0d0;margin-left:10px;" id="loaderText">Please Wait...</h4>
        </div>
    </div>
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
                    <h4 class="page-title-main">Project Work Report</h4>
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
                                <h4 class="m-t-0 header-title">Project Work</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-2">
                                        <form method="POST" id="EmpTaskForm">
                                            <div class="form-group row">
                                                <label class="col-sm-2  col-form-label" for="txtEmp">Employee Name</label>
                                                <div class="col-sm-4">
                                                    <select name="txtEmp" id="txtEmp" class="form-control">
                                                        <?php
                                                            $sql="SELECT user_name,user_id FROM tbl_user";
                                                            $result = $cn->selectdb($sql);
                                                            while ($row1=$cn->fetchAssoc($result)) {
                                                        ?>
                                                        <option value="<?php echo $row1['user_id'];?>">
                                                            <?php echo $row1['user_name'];?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-primary width-md"
                                                        name="Submit">Search</button>
                                                </div>

                                            </div>
                                        </form>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <div style="width:100%;border:1px dashed black;margin-top:7px;"></div>
                                            </div>
                                            <div class="col-sm-1" style="text-align:center;">
                                                <label>OR</label>
                                            </div>
                                            <div class="col-sm-4">
                                            <div style="width:100%;border:1px dashed black;margin-top:7px;"></div>
                                            </div>
                                        </div>
                                        <form method="POST" id="DateWiseEmpTaskForm">
                                            <div class="form-group row">
                                                <label class="col-sm-2  col-form-label" for="datepicker">Date</label>
                                                <div class="col-sm-4">
                                                    <div class="input-daterange input-group" id="date-range">
                                                        <input type="text" required placeholder="from"
                                                            class="form-control" name="FromDate" id="FromDate" autocomplete="off">
                                                        <input type="text" required placeholder="to"
                                                            class="form-control" name="ToDate" id="ToDate" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-primary width-md"
                                                        name="Submit">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-box -->

                        </div><!-- end col -->
                    </div><!-- end row -->
                    <div class="row" id="loaderRow" style="display:none;">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title">Search Result of <label id="Emp_ID"></label></h4>
                                <div id="EmpWiseResult" style="display:none;">
                                <table id="datatable" class="table table-bordered dt-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Task Name</th>
                                            <th>Client Name</th>
                                            <th>Assigned Date</th>
                                            <th>Accepted Date</th>
                                            <th>Submitted Date</th>
                                            <th>Status</th>
                                            <th>Time Taken</th>
                                            <th>Time Expected</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="EmployeeSearchResult">

                                    </tbody>

                                </table>
                                </div>
                                <div id="DateWiseResult" style="display:none;">
                                <table id="datatableDateWise" class="table table-bordered dt-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Emp Name</th>
                                            <th>Task Name</th>
                                            <th>Client Name</th>
                                            <th>Assigned Date</th>
                                            <th>Accepted Date</th>
                                            <th>Submitted Date</th>
                                            <th>Status</th>
                                            <th>Time Taken</th>
                                            <th>Time Expected</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="EmployeeSearchResultDate">

                                    </tbody>

                                </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div> <!-- container-fluid -->

            </div> <!-- content -->
            <?php
            include 'footer.php';
            ?>
            <script src="assets/js/vendor.min.js"></script>
            <!-- Vendor js -->
            <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
            <script src="assets/libs/switchery/switchery.min.js"></script>
            <script src="assets/libs/multiselect/jquery.multi-select.js"></script>
            <script src="assets/libs/jquery-quicksearch/jquery.quicksearch.min.js"></script>
            <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
            <script src="assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
            <script src="assets/libs/moment/moment.js"></script>
            <script src="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
            <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
            <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
            <script src="assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
            <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
            <script src="assets/js/pages/form-advanced.init.js"></script>
            <script src="assets/libs/toastr/toastr.min.js"></script>
            <!-- DataTables -->
            <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
            <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
            <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
            <!-- <script src="assets/js/pages/datatables.init.js"></script> -->
            <!-- Tablesaw js -->
            <!-- App js -->
            <script src="assets/js/app.min.js"></script>
            <script>
            jQuery("#timepicker22").timepicker({
                showMeridian: !1,
                icons: {
                    up: "mdi mdi-chevron-up",
                    down: "mdi mdi-chevron-down"
                }
            });
            </script>
            <script>
            $("#EmpTaskForm").on("submit",function(event){
                    event.preventDefault();
                    $("#customLoader").show();
                    $.ajax({  
                        url:"fetchTaskReportResult.php?type=EmployeeWise",  
                        method:"POST",  
                        data:$('#EmpTaskForm').serialize(),
                        success:function(data){  
                            //console.log(data);
                            row = "";
                            $("#Emp_ID").html($("#txtEmp option:selected").text());
                            if(data != 0)
                            {
                                data = JSON.parse(data);
                                //console.log(data.length);
                                for(i=0;i<data.length;i++)
                                {
                                    row += "<tr>"+
                                            "<td>"+data[i].task_name+"</td>"+
                                            "<td>"+data[i].shipper_name+"</td>"+
                                            "<td>"+data[i].date_assign+"</td>"+
                                            "<td>"+data[i].date_accept+"</td>"+
                                            "<td>"+data[i].date_submit+"</td>"+
                                            "<td>"+data[i].task_emp_status+"</td>"+
                                            "<td style='text-align:center;'>"+data[i].task_emp_duration+"</td>"+
                                            "<td style='text-align:center;'>"+data[i].task_emp_expected_time+"</td>"+
                                            "</tr>";
                                }
                            }
                            else
                            {
                                row = "<tr><td colspan='8'>No Records Found..!</td></tr>";
                            }
                            setTimeout(() => {
                                $("#customLoader").hide();
                                $('#DateWiseResult').hide();
                                $("#loaderRow").show();
                                $("#EmpWiseResult").show();
                                $("#EmployeeSearchResult").html(row);
                                $('#datatable').DataTable();
                            }, 1500);
                            
                        }
                    });
            });
            function getFormattedDate(date) {
                date = new Date(date);
                let year = date.getFullYear();
                let month = (1 + date.getMonth()).toString().padStart(2, '0');
                let day = date.getDate().toString().padStart(2, '0');
            
                return day + '/' + month + '/' + year;
            }
            $("#DateWiseEmpTaskForm").on("submit",function(event){
                event.preventDefault();
                $("#customLoader").show();
                $.ajax({  
                    url:"fetchTaskReportResult.php?type=DateWiseEmpTaskForm",  
                    method:"POST",  
                    data:$('#DateWiseEmpTaskForm').serialize(),
                    success:function(data){  
                        //console.log(data);
                        row = "";
                        var fromDate = getFormattedDate($("#FromDate").val());
                        var toDate = getFormattedDate($("#ToDate").val());
                        $("#Emp_ID").html(" Dates Between "+fromDate+" AND "+toDate);
                        if(data != 0)
                        {
                            data = JSON.parse(data);
                            //console.log(data.length);
                            for(i=0;i<data.length;i++)
                            {
                                row += "<tr>"+
                                        "<td>"+data[i].emp_name+"</td>"+
                                        "<td>"+data[i].task_name+"</td>"+
                                        "<td>"+data[i].shipper_name+"</td>"+
                                        "<td>"+data[i].date_assign+"</td>"+
                                        "<td>"+data[i].date_accept+"</td>"+
                                        "<td>"+data[i].date_submit+"</td>"+
                                        "<td>"+data[i].task_emp_status+"</td>"+
                                        "<td style='text-align:center;'>"+data[i].task_emp_duration+"</td>"+
                                        "<td style='text-align:center;'>"+data[i].task_emp_expected_time+"</td>"+
                                        "</tr>";
                            }
                        }
                        else
                        {
                            row = "<tr><td colspan='9'>No Records Found..!</td></tr>";
                        }
                        setTimeout(() => {
                            $("#customLoader").hide();
                            $('#EmpWiseResult').hide();
                            $("#loaderRow").show();
                            $('#DateWiseResult').show();
                            $("#EmployeeSearchResultDate").html(row);
                            $('#datatableDateWise').DataTable();
                        }, 1500);
                        
                    }
                });
            });
            </script>
</body>

</html>
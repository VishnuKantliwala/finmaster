<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
if ($_SESSION['control'] != "admin") {
    header("location:login.php");
}
include_once("../connect.php");
$cn = new connect();
$cn->connectdb();
$page_id=19;
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
                    <a href="index.html" class="logo text-center">
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
                        <h4 class="page-title-main">Sales Report (Client wise / Date wise / Service wise)</h4>
                    </li>
        
                </ul>
            </div>
            <!-- end Topbar -->

            <?php include 'menu.php';?>

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box">
                                    <form method="POST" id="ShipperSalesForm">
                                        <div class="form-group row">
                                            <label class="col-sm-2  col-form-label" for="txtShipper">Client Name</label>
                                            <div class="col-sm-4 row">
                                                <div class="col-sm-6">
                                                    <select name="txtShipper" id="txtShipper" class="form-control">
                                                        <?php
                                                            $sql="SELECT shipper_name,shipper_id FROM tbl_shipper";
                                                            $result = $cn->selectdb($sql);
                                                            while ($row1=$cn->fetchAssoc($result)) {
                                                        ?>
                                                        <option value="<?php echo $row1['shipper_id'];?>">
                                                            <?php echo $row1['shipper_name'];?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6" style="padding:10px;">
                                                    <input type="checkbox" name="allClients" id="allClients"/>&nbsp;<label for="allClients">All Clients</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-primary width-md"
                                                    name="Submit">Search</button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary width-md"
                                                    name="Print" id="PrintShipperWise">Print</button>
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
                                    <form method="POST" id="DateWiseSalesForm">
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
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary width-md"
                                                    name="Print" id="PrintDateWise">Print</button>
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
                                    <form method="POST" id="ServiceWiseSalesForm">
                                        <div class="form-group row">
                                            <label class="col-sm-2  col-form-label" for="txtService">Service Name</label>
                                            <div class="col-sm-4">
                                                <select name="txtService" id="txtService" class="form-control">
                                                    <?php
                                                        $sql="SELECT `name`,`product_id` FROM tbl_product";
                                                        $result = $cn->selectdb($sql);
                                                        while ($row1=$cn->fetchAssoc($result)) {
                                                    ?>
                                                    <option value="<?php echo $row1['product_id'];?>">
                                                        <?php echo $row1['name'];?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-primary width-md"
                                                    name="Submit">Search</button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary width-md"
                                                    name="Print" id="PrintServiceWise">Print</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- end col-->
                        </div>
                        <!-- end row -->
                        <div class="row" id="loaderRow" style="display:none;">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title">Search Result of <label id="shipper_ID"></label></h4>
                                    <div id="ShipperWiseResult" style="display:none;">
                                    <table id="datatable" class="table table-bordered dt-responsive" >
                                        <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Service Name</th>
                                                <th>Invoice Type</th>
                                                <th>Entry Date</th>
                                                <th>Entry Person</th>
                                                <th>Duration</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="ShipperSearchResult">

                                        </tbody>

                                    </table>
                                    </div>
                                    <div id="DateWiseResult" style="display:none;">
                                        <table id="datatableDateWise" class="table table-bordered dt-responsive" >
                                            <thead>
                                                <tr>
                                                    <th>Client Name</th>
                                                    <th>Service Name</th>
                                                    <th>Invoice Type</th>
                                                    <th>Entry Date</th>
                                                    <th>Entry Person</th>
                                                    <th>Duration</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody id="ShipperSearchResultDate">

                                            </tbody>

                                        </table>
                                    </div>
                                    <div id="ServiceWiseResult" style="display:none;">
                                        <table id="datatableServiceWise" class="table table-bordered dt-responsive" >
                                            <thead>
                                                <tr>
                                                    <th>Client Name</th>
                                                    <th>Invoice Type</th>
                                                    <th>Entry Date</th>
                                                    <th>Entry Person</th>
                                                    <th>Duration</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody id="SearchResultService">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                        </div>
                        </div><!-- end row -->
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <?php include 'footer.php';?>

            </div>

        </div>
        <!-- END wrapper -->

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
            $("#PrintShipperWise").on("click",function(){
                if($('#allClients').is(':checked'))
                   window.open("reportSaleView.php?task=ClientWise&client_id=AllClients","_BLANK");
                else
                    window.open("reportSaleView.php?task=ClientWise&client_id="+$("#txtShipper option:selected").val(),"_BLANK");
            });
            $("#PrintDateWise").on("click",function(){
                window.open("reportSaleView.php?task=DateWise&FromDate="+$("#FromDate").val()+"&ToDate="+$("#ToDate").val(),"_BLANK");
            });
            $("#PrintServiceWise").on("click",function(){
                window.open("reportSaleView.php?task=ServiceWise&service_id="+$("#txtService option:selected").val(),"_BLANK");
            });
            
            $("#allClients").on("change",function(){
                if($('#allClients').is(':checked'))
                {
                    $("#txtShipper").attr('disabled', true);
                }
                else
                {
                    $("#txtShipper").attr('disabled', false);
                }
            });
            function getFormattedDate(date) {
                date = new Date(date);
                let year = date.getFullYear();
                let month = (1 + date.getMonth()).toString().padStart(2, '0');
                let day = date.getDate().toString().padStart(2, '0');
            
                return day + '/' + month + '/' + year;
            }
            $("#ShipperSalesForm").on("submit",function(event){
                event.preventDefault();
                $("#customLoader").show();
                //console.log($('#ShipperSalesForm').serialize());
                $.ajax({  
                    url:"fetchSalesReportResult.php?type=ClientWise",  
                    method:"POST",  
                    data:$('#ShipperSalesForm').serialize(),
                    success:function(data){  
                        //console.log(data);
                        row = "";
                        if($('#allClients').is(':checked'))
                            $("#shipper_ID").html("All Clients");
                        else
                            $("#shipper_ID").html($("#txtShipper option:selected").text());
                        if(data != 0)
                        {
                            data = JSON.parse(data);
                            //console.log(data.length);
                            for(i=0;i<data.length;i++)
                            {
                                row += "<tr>"+
                                        "<td>"+data[i].shipper_name+"</td>"+
                                        "<td>"+data[i].service_name+"</td>"+
                                        "<td>"+data[i].invoice_type+"</td>"+
                                        "<td>"+data[i].entry_date+"</td>"+
                                        "<td>"+data[i].entry_person+"</td>"+
                                        "<td>"+data[i].duration+"</td>"+
                                        "<td>"+data[i].quantity+"</td>"+
                                        "<td style='text-align:center;'>"+data[i].total_amount+"</td>"+
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
                            $('#ServiceWiseResult').hide();
                            $("#loaderRow").show();
                            $("#ShipperWiseResult").show();
                            $("#ShipperSearchResult").html(row);
                            $('#datatable').DataTable();
                            
                        }, 1500);
                        
                    }
                });
            });
            $("#DateWiseSalesForm").on("submit",function(event){
                event.preventDefault();
                $("#customLoader").show();
                $.ajax({  
                    url:"fetchSalesReportResult.php?type=DateWise",  
                    method:"POST",  
                    data:$('#DateWiseSalesForm').serialize(),
                    success:function(data){  
                        //console.log(data);
                        row = "";
                        var fromDate = getFormattedDate($("#FromDate").val());
                        var toDate = getFormattedDate($("#ToDate").val());
                        $("#shipper_ID").html(" Dates Between "+fromDate+" AND "+toDate);
                        if(data != 0)
                        {
                            data = JSON.parse(data);
                            //console.log(data.length);
                            for(i=0;i<data.length;i++)
                            {
                                row += "<tr>"+
                                        "<td>"+data[i].shipper_name+"</td>"+
                                        "<td>"+data[i].service_name+"</td>"+
                                        "<td>"+data[i].invoice_type+"</td>"+
                                        "<td>"+data[i].entry_date+"</td>"+
                                        "<td>"+data[i].entry_person+"</td>"+
                                        "<td>"+data[i].duration+"</td>"+
                                        "<td>"+data[i].quantity+"</td>"+
                                        "<td style='text-align:center;'>"+data[i].total_amount+"</td>"+
                                        "</tr>";
                            }
                        }
                        else
                        {
                            row = "<tr><td colspan='8'>No Records Found..!</td></tr>";
                        }
                        setTimeout(() => {
                            $("#customLoader").hide();
                            $('#ShipperWiseResult').hide();
                            $('#ServiceWiseResult').hide();
                            $("#loaderRow").show();
                            $("#DateWiseResult").show();
                            $("#ShipperSearchResultDate").html(row);
                            $('#datatableDateWise').DataTable();
                        }, 1500);
                        
                    }
                });
            });
            $("#ServiceWiseSalesForm").on("submit",function(event){
                event.preventDefault();
                $("#customLoader").show();
                $.ajax({  
                    url:"fetchSalesReportResult.php?type=ServiceWise",  
                    method:"POST",  
                    data:$('#ServiceWiseSalesForm').serialize(),
                    success:function(data){  
                        //console.log(data);
                        row = "";
                        $("#shipper_ID").html($("#txtService option:selected").text() + " Service");
                        if(data != 0)
                        {
                            data = JSON.parse(data);
                            //console.log(data.length);
                            for(i=0;i<data.length;i++)
                            {
                                row += "<tr>"+
                                        "<td>"+data[i].shipper_name+"</td>"+
                                        "<td>"+data[i].invoice_type+"</td>"+
                                        "<td>"+data[i].entry_date+"</td>"+
                                        "<td>"+data[i].entry_person+"</td>"+
                                        "<td>"+data[i].duration+"</td>"+
                                        "<td>"+data[i].quantity+"</td>"+
                                        "<td style='text-align:center;'>"+data[i].total_amount+"</td>"+
                                        "</tr>";
                            }
                        }
                        else
                        {
                            row = "<tr><td colspan='7'>No Records Found..!</td></tr>";
                        }
                        setTimeout(() => {
                            $("#customLoader").hide();
                            $('#ShipperWiseResult').hide();
                            $('#DateWiseResult').hide();
                            $("#loaderRow").show();
                            $("#ServiceWiseResult").show();
                            $("#SearchResultService").html(row);
                            $('#datatableServiceWise').DataTable();
                        }, 1500);
                        
                    }
                });
            });
            </script>
    </body>
</html>
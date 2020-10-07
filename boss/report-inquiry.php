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
$page_id=20;
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
    <!-- third party css end -->
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
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
        .loader{
                opacity:0.6;
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: rgb(249,249,249);
                display:none;
            }
            .centered {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                
                color:darkred;
                display:inline-flex;
                border:1px solid grey;
                padding:10px;
                background:black;
            }
            @media (min-width: 576px)
            {
                .modal-dialog {
                    max-width:800px;
                }
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
                    <h4 class="page-title-main">Inquiry Report</h4>
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
                                    <h4 class="m-t-0 header-title">Inquiry</h4>
                                    <div class="row">
                                      <div class="col-12">
                                          <div class="p-2">
                                          <form class="form-horizontal" autocomplete="off" role="form" method="post" id="searchformClient">
                                                  <div class="form-group row">
                                                      <label class="col-sm-2  col-form-label" for="txtInquiry">Client Name</label>
                                                      <div class="col-sm-10">
                                                        <input type="text" name="txtInquiry" id="txtInquiry" class="form-control" placeholder="Name">
                                                        <div id="suggesstion-box"></div>
                                                        <input type="hidden" name="txtInquiryID" id="txtInquiryID" value="0">
                                                        <br> All Clients
                                                        <input  type="checkbox" name="chkCompany" id="chkCompany" />
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label class="col-sm-2  col-form-label" for="example-placeholder"></label>
                                                      <div class="col-sm-10">
                                                          <button type="submit" class="btn btn-primary width-md" name="filterResultClient" id="filterResultClient">Search</button>
                                                          <label id="clientformresultmsg" style="font-style:italic;color:red;"></label>
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
                                                <form class="form-horizontal" autocomplete="off" role="form" method="post" id="searchform">
                                                   
                                                    <div class="form-group row">
                                                        <label class="col-sm-2  col-form-label" for="datepicker">Date</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-daterange input-group" id="date-range">
                                                                    <input type="text" placeholder="from" class="form-control" name="FromDate" required>
                                                                    <input type="text" placeholder="to" class="form-control" name="ToDate" required>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2  col-form-label" for="example-placeholder"></label>
                                                        <div class="col-sm-10">
                                                            <button type="submit" class="btn btn-primary width-md" name="filterResult" id="filterResult">Search</button>
                                                            
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
                        <div id="FollowUpsDataModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Inquiry FollowUps of <label id="FollowUpsClient"></label></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body" id="FollowUpsDataModalBody">

                                        <table id="FollowUps" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Entry Date</th>
                                                    <th>From Date</th>
                                                    <th>To Date</th>
                                                    <th>Status</th>
                                                    <th>Entry Person</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody id="FollowUpsTbody">
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="InquiryDetailDataModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Inquiry Details of <label id="InquiryDetailClient"></label></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                    </div>
                                    <div class="modal-body" id="InquiryDetailDataModalBody">

                                        <table id="InquiryDetail" class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>Description :</th>
                                                    <td id="descriptionHere"></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Documents :</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" id="documentsHere">
                                                        <ul class="list-inline files-list">
                                                                    
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="loader" id="customLoader">
                            <div class="centered">
                                <img src="loader1.gif" style="height:40px;"/>
                                <h4 style="color:#d0d0d0;margin-left:10px;" id="loaderText">Please Wait...</h4>
                            </div>
                        </div>
                        <div class="row" id="loaderRow" style="display:none;">
                        <div class="col-12">
                            <div class="card-box" >
                            	<h4 class="m-t-0 header-title">Search Result</h4>
                                
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" >
                                      <thead>
                                          <tr>
                                          	  <th>Client Name</th>
                                              <th>Attendant Name</th>
                                              <th>Mobile No.</th>
                                              <th>Email-ID</th>
                                              <th>Inquiry Status</th>
                                              <th>FollowUps</th>
                                           </tr>
                                      </thead>
                                      <tfoot>
                                          <tr>
                                              <th>Client Name</th>
                                              <th>Attendant Name</th>
                                              <th>Mobile No.</th>
                                              <th>Email-ID</th>
                                              <th>Inquiry Status</th>
                                              <th>FollowUps</th>
                                          </tr>
                                      </tfoot>
                                      <tbody id="ClientSearchResult">
                                          
                                      </tbody>

                                  </table>
                            </div>
                        </div>
                    </div>
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
            <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
            <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
            <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
            <!-- <script src="assets/js/pages/datatables.init.js"></script> -->
            <!-- Tablesaw js -->
            <!-- App js -->
            <script src="assets/js/app.min.js"></script>
            <script>
                $("#searchformClient").on("submit",function(event){
                    event.preventDefault();
                    var txtInquiry = $("#txtInquiry").val();
                    var txtInquiryID = $("#txtInquiryID").val();
                    if(txtInquiry != "" && txtInquiryID == 0)
                    {
                        $("#clientformresultmsg").html("Please select client name from suggestion..!");
                        setTimeout(() => {
                            $("#clientformresultmsg").html("");
                        }, 1500);
                    }
                    else if($("#chkCompany").prop("checked") == false && txtInquiry == "")
                    {
                        $("#clientformresultmsg").html("Please select either \"All Client\" Or Client Name from suggestion..!");
                        setTimeout(() => {
                            $("#clientformresultmsg").html("");
                        }, 2000);
                    }
                    else
                    {
                        $("#customLoader").show();
                        $.ajax({  
                            url:"fetchInquiryReportResult.php?type=ClientWise",  
                            method:"POST",  
                            data:$('#searchformClient').serialize(),
                            success:function(data){  
                                //console.log(data);
                                row = "";
                                if(data != 0)
                                {
                                    data = JSON.parse(data);
                                    //console.log(data.length);
                                    for(i=0;i<data.length;i++)
                                    {
                                        row += "<tr>"+
                                               "<td>"+data[i].shipper_name+"</td>"+
                                               "<td>"+data[i].attendant_name+"</td>"+
                                               "<td>"+data[i].shipper_phone1+"</td>"+
                                               "<td>"+data[i].shipper_email+"</td>"+
                                               "<td>"+data[i].inquiry_status+"</td>"+
                                               "<td style='text-align:center;'><i class='fa fa-info-circle' style='cursor:pointer;' onClick='openFollowUpsModal("+data[i].inquiry_id+",\"ClientWise\")'></i></td>"+
                                               "</tr>";
                                    }
                                }
                                else
                                {
                                    row = "<tr><td colspan='6'>No Records Found..!</td></tr>";
                                }
                                setTimeout(() => {
                                    $("#customLoader").hide();
                                    $("#loaderRow").show();
                                    $("#ClientSearchResult").html(row);
                                    $('#datatable').DataTable();
                                }, 1500);
                                
                            }
                        });
                    }
                });
                var inquiryDetails = "";
                function openFollowUpsModal(inquiry_id,type)
                {
                    var Formdata = "";
                    if(type == "DateWise")
                    {
                        Formdata = $('#searchform').serialize();
                    }
                    $("#customLoader").show();
                    $.ajax({  
                            url:"fetchInquiryReportResult.php?type=FollowUps&Form="+type+"&inquiry_id="+inquiry_id,  
                            method:"POST",
                            data:Formdata,
                            success:function(data){  
                                //console.log(data);
                                row = "";
                                if(data != 0)
                                {
                                    data = JSON.parse(data);
                                    inquiryDetails = data;
                                    //console.log(data.length);
                                    $("#FollowUpsClient").html(data[0].shipper_name);
                                    $("#InquiryDetailClient").html(data[0].shipper_name);
                                    for(i=0;i<data.length;i++)
                                    {
                                        row += "<tr>"+
                                               "<td>"+data[i].entry_date+"</td>"+
                                               "<td>"+data[i].inquiry_stime+"</td>"+
                                               "<td>"+data[i].inquiry_etime+"</td>"+
                                               "<td>"+data[i].status+"</td>"+
                                               "<td>"+data[i].user_name+"</td>"+
                                               "<td style='text-align:center;'><i class='fa fa-info-circle' style='cursor:pointer;' onClick='openInquiryDetailsModal("+data[i].inquiry_detail_id+")'></i></td>"+
                                               "</tr>";
                                    }
                                    
                                }
                                else
                                {
                                    row = "<tr><td colspan='6'>No Records Found..!</td></tr>";
                                }
                                $("#customLoader").hide();
                                $("#FollowUpsTbody").html(row);
                                $("#FollowUpsDataModal").modal('show');
                                $("#FollowUpsDataModal").css("opacity","1");
                            }
                        });
                }
                function openInquiryDetailsModal(inquiry_detail_id)
                {
                    if(inquiryDetails != "")
                    {
                        for(i=0;i<inquiryDetails.length;i++)
                        {
                           if(inquiry_detail_id == inquiryDetails[i].inquiry_detail_id)
                           {
                               if($.trim(inquiryDetails[i].description) != "")
                               {
                                    $("#descriptionHere").html(inquiryDetails[i].description);
                               }
                               else
                               {
                                    $("#descriptionHere").html("Description is Empty..!");
                               }
                               if(inquiryDetails[i].meeting_document != "")
                                {
                                    var imgs = inquiryDetails[i].meeting_document.split(",");
                                    imgs.pop();
                                    var img = "";
                                    jQuery.each(imgs,function(j,val) {
                                        var ext = val.substring(val.lastIndexOf(".")+1);
                                        if(ext=="pdf"){
                                            $img_name = "assets/file/pdf.png";
                                        }else if(ext=="png" || ext=="jpg" || ext=="jpeg" || ext=="gif"){
                                            $img_name = "inquiry/"+inquiryDetails[i].shipper_id+"/"+val;
                                        }else if(ext=="doc" || ext=="docx"){
                                            $img_name = "assets/file/doc.png";
                                        }else if(ext=="xls" || ext=="xlsx"){
                                            $img_name = "assets/file/xls.png";
                                        }else if(ext=="txt"){
                                            $img_name = "assets/file/txt.png";
                                        }
                                        img+="<li class='list-inline-item file-box'><a href='inquiry/"+inquiryDetails[i].shipper_id+"/"+val+"' target='_blank'><img src='"+$img_name+"' class='img-fluid img-thumbnail' alt='attached-img' width='80'></a><p class='font-13 mb-1 text-muted'></p></li>";
                                    });
                                    $("#documentsHere ul li").remove();
                                    $("#documentsHere ul").append(img);
                                }
                                else
                                {
                                    $("#documentsHere ul li").remove();
                                    $("#documentsHere ul").append("<li>No Documents..!<li>");
                                }
                           }
                        }
                        // $("#FollowUpsDataModal").modal('hide');
                        // $("#FollowUpsDataModal").css("opacity","0");
                        $("#InquiryDetailDataModal").modal('show');
                        $("#InquiryDetailDataModal").css("opacity","1");
                    }
                }
                $("#searchform").on("submit",function(event){
                    event.preventDefault();
                    $("#customLoader").show();
                    $.ajax({  
                        url:"fetchInquiryReportResult.php?type=DateWise",  
                        method:"POST",  
                        data:$('#searchform').serialize(),
                        success:function(data){  
                            //console.log(data);
                            row = "";
                            if(data != 0)
                            {
                                data = JSON.parse(data);
                                //console.log(data.length);
                                for(i=0;i<data.length;i++)
                                {
                                    row += "<tr>"+
                                            "<td>"+data[i].shipper_name+"</td>"+
                                            "<td>"+data[i].attendant_name+"</td>"+
                                            "<td>"+data[i].shipper_phone1+"</td>"+
                                            "<td>"+data[i].shipper_email+"</td>"+
                                            "<td>"+data[i].inquiry_status+"</td>"+
                                            "<td style='text-align:center;'><i class='fa fa-info-circle' style='cursor:pointer;' onClick='openFollowUpsModal("+data[i].inquiry_id+",\"DateWise\")'></i></td>"+
                                            "</tr>";
                                }
                            }
                            else
                            {
                                row = "<tr><td colspan='6'>No Records Found..!</td></tr>";
                            }
                            setTimeout(() => {
                                $("#customLoader").hide();
                                $("#loaderRow").show();
                                $("#ClientSearchResult").html(row);
                                $('#datatable').DataTable();
                            }, 1500);
                            
                        }
                    });
                });
                $("#txtInquiry").keyup(function(){
                    if($("#txtInquiry").val() == ""){
                        $("#txtInquiryID").val('');
                        $("#chkCompany").prop("checked",true);
                        $("#suggesstion-box").hide();
                    }else{
                        //$("#chkCompany").removeAttr("checked");
                        $("#chkCompany").prop("checked",false);
                        $.ajax({
                            type: "POST",
                            url: "fetch_customer.php",
                            data:'keyword='+$(this).val(),
                            success: function(data){
                                $("#suggesstion-box").show();
                                $("#suggesstion-box").html(data);
                                $("#txtInquiry").css("background","#FFF");
                            }
                        });
                    }
                });
                function selectCustomer(name,id) {
                    $("#txtInquiry").val(name);
                    $("#txtInquiryID").val(id);
                    $("#suggesstion-box").hide();
                }
                jQuery("#timepicker22").timepicker({
                    showMeridian: !1,
                    icons: {
                        up: "mdi mdi-chevron-up",
                        down: "mdi mdi-chevron-down"
                    }
                });
            </script>

</body>

</html>

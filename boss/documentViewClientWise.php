<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
include_once("../connect.php");
$cn = new connect();
$cn->connectdb();
$page_id=31;
$document_id = $_GET['document_id'];
$sqlCust = $cn->selectdb("SELECT s.shipper_name FROM tbl_shipper s,tbl_document d WHERE d.shipper_id = s.shipper_id AND d.document_id = ".$document_id);
if($cn->numRows($sqlCust) > 0)
{
    $rowCust = $cn->fetchAssoc($sqlCust);
    $Customer_name = $rowCust["shipper_name"];
}
else
{
    $Customer_name = "";
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
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
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
<div class="loader" id="customLoader">
            
    <div class="centered">
        <img src="loader1.gif" style="height:40px;"/>
        <h4 style="color:#d0d0d0;margin-left:10px;" id="loaderText">Please wait...</h4>
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
                    <h4 class="page-title-main">Documents of <? echo $Customer_name; ?></h4>
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
                        <div class="row nameBoxWrap" name="nameBoxWrap">
                            <div class="col-12">
                            <div class="card-box">
                                    <form name="basicForm" id="basicForm" method="post">
                                    <h4 class="m-t-0 header-title">Filter Documents</h4>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-12">
                                           
                                            <div class="form-group row ">
                                                <input type="hidden" id="document_id" value="<? echo $document_id; ?>"/>
                                                <label for="inputEmail3" class="col-sm-2 control-label">Select Year:</label>
                                                <div class="col-sm-3">
                                                    <select id="year" name="year" class="form-control" required>
                                                        <option disabled readonly>Select Year</option>
                                                        <?
                                                        $sqlDocYear = $cn->selectdb("SELECT dy.document_year FROM tbl_document_year dy WHERE dy.document_id = ".$document_id." GROUP BY dy.document_year");
                                                        if($cn->numRows($sqlDocYear) > 0)
                                                        {
                                                            while($rowDoc = $cn->fetchAssoc($sqlDocYear))
                                                            {
                                                                ?>
                                                                <option value="<? echo $rowDoc["document_year"]; ?>">
                                                                    <? echo $rowDoc["document_year"]=="BasicDocs"?"Basic Documents":$rowDoc["document_year"]; ?>
                                                                </option>
                                                                <?
                                                            }
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="0">
                                                                  Documents are not uploaded..!  
                                                            </option>
                                                            <?
                                                        }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-primary width-sm" id="FilterDocs" name="FilterDocs">Filter</button>
                                                    <button type="button" class="btn btn-primary width-sm" id="ClearFilterDocs" name="ClearFilterDocs">Clear Filter</button>
                                                    <a href="documentView.php" class="btn btn-lighten-primary waves-effect waves-primary  width-sm">Cancel</a>
                                                </div>
                                            </div>
                                            
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    </form>
                                    <!-- end row -->
                                </div> <!-- end card-box -->
                                <div class="card-box">
                                    
                                    <div class="row">
                                        <div class="col-12" id="documentsView">
                                           
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                   
                                    <!-- end row -->
                                </div> <!-- end card-box -->
                            </div><!-- end col -->
                            
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->

                </div> <!-- content -->
            </div>
            <div class="modal fade none-border" id="documentViewModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title mt-0"><strong>Document</strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" id="documentViewModalBody">
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0" id="fileID" />
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" id="btnDelete" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div><!-- END MODAL -->
                <?php
            include 'footer.php';
            ?>
        
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/js/pages/sweet-alerts.init.js"></script>
        <script src="assets/js/vendor.min.js"></script>        

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
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

        <script>
        var data;
        $("#FilterDocs").on("click",function(){
            var year = $("#year").val();
            $("#customLoader").show();
            setTimeout(() => {
                $("#customLoader").hide();
                printDocs(year);
            }, 500);
        });
        $("#ClearFilterDocs").on("click",function(){
            $("#customLoader").show();
            setTimeout(() => {
                $("#customLoader").hide();
                printDocs("All");
            }, 500);
        });
        fetchDocuments("All");
        function fetchDocuments(year)
        {
            var document_id = $("#document_id").val();
            var yearFlag = false;
            
            if(year != "All" && year != "0")
                yearFlag = true;
            
                $.ajax({
                type:'GET',
                url:'document_interaction.php?type=fetchDocuments&document_id='+document_id,
                success:function(dataSource){
                    data = JSON.parse(dataSource);
                    $("#customLoader").show();
                    setTimeout(() => {
                        $("#customLoader").hide();
                        printDocs("All");
                    }, 500);
                }
            });
            
            
        }
        function printDocs(year)
        {
            var docs = '<button type="button" class="btn btn-primary" name="DeleteMulDoc" id="DeleteMulDoc" onClick="deleteMulDocs()" style="margin:5px;"><i class="fa fa-trash"></i> Delete Selected Files</button>';
            var flag = false;
            if(data != "")
            {
                for(i=0;i<data.document_year.length;i++)
                {
                    if(year != "All" && data.document_year[i].document_year_name == year)
                        flag = true;
                    else if(year == "All")
                        flag = true;
                    else
                        flag = false;
                    if(flag)
                    {
                        docs += '<div class="row">';
                        var yearname = data.document_year[i].document_year_name == "BasicDocs" ? "Basic Documents" : data.document_year[i].document_year_name;
                        var shipper_name = data.shipper_name;
                        docs += '<div class="col-12" style="border-bottom:1px dashed grey;border-top:1px dashed grey;display:flex;"><h3>'+yearname+'</h3></div>';
                        if(data.document_year[i].hasOwnProperty("document_year_cat"))
                        {
                            for(j=0;j<data.document_year[i].document_year_cat.length;j++)
                            {
                                var catname = data.document_year[i].document_year_cat[j].cat_name;
                                docs += '<div class="col-12" style="margin-left:45px;"><h4>Category - '+catname+'</h4></div>';
                                if(data.document_year[i].document_year_cat[j].hasOwnProperty("files"))
                                {
                                    docs += '<div class="col-12 row" style="margin-left:45px;margin-bottom:15px;">';
                                    for(k=0;k<data.document_year[i].document_year_cat[j].files.length;k++)
                                    {
                                        var filename = data.document_year[i].document_year_cat[j].files[k].file_name;
                                        var ext = filename.split(".");
                                        var count = ext.length;
                                        var path = "Documents/"+shipper_name.replace(/ /g,"")+"/"+data.document_year[i].document_year_name+"/"+catname.replace(/ /g,"")+"/"+filename;
                                        var image_name = "assets/file/file.png";
                                        var doc_type = "Document";
                                        if(ext[count-1] == "png" || ext[count-1] == "jpg" || ext[count-1] == "jpeg" || ext[count-1] == "webp" || ext[count-1] == "gif")
                                        {
                                            doc_type = "Image File";
                                        }
                                        else if(ext[count-1] == "doc" || ext[count-1] == "docx")
                                        {
                                            doc_type = "Document File";
                                        }
                                        else if(ext[count-1] == "pdf")
                                        {
                                            doc_type = "PDF File";
                                        }
                                        else if(ext[count-1] == "txt")
                                        {
                                            doc_type = "TXT File";
                                        }
                                        else if(ext[count-1] == "xls" || ext[count-1] == "xlsx")
                                        {
                                            doc_type = "Excel File";
                                        }
                                        docs += '<div class="col-3 row">'+
                                                    '<div class="col-6">'+
                                                    '<input type="checkbox" name="file_id[]" value="'+data.document_year[i].document_year_cat[j].files[k].file_id+'">'+
                                                    '<a onClick="openDocumentModal(\''+path+'\',\''+ext[count-1]+'\',\''+data.document_year[i].document_year_cat[j].files[k].file_id+'\')" title="File Name : '+filename+'"><img src="'+image_name+'" style="width:100%;"/></a>'+
                                                    '<div class="col-12" style="text-align:center;">'+
                                                        '<button type="button" class="btn btn-primary" name="DeleteDoc" onClick="DeleteDoc('+data.document_year[i].document_year_cat[j].files[k].file_id+')"><i class="fa fa-trash"></i></button>'+
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="col-6" style="margin-top:12px;">'+
                                                        '<div class="col-12">'+
                                                        '<label style="font-weight:bold;">Date:&nbsp;</label>'+data.document_year[i].document_year_cat[j].files[k].entry_date+
                                                        '</div>'+
                                                        '<div class="col-12">'+
                                                        '<label style="font-weight:bold;">Entry Person:&nbsp;</label>'+data.document_year[i].document_year_cat[j].files[k].entry_person_name+
                                                        '</div>'+
                                                        '<div class="col-12">'+
                                                        '<label style="font-weight:bold;">Document Type:&nbsp;</label><br/>'+doc_type+
                                                        '</div>'+
                                                        
                                                    '</div>'+
                                                '</div>';
                                    }
                                    docs += '</div>';
                                }
                                else
                                {
                                    docs += '<div class="col-12" style="margin-left:45px;"><h4>No Documents available in this category..!</h4></div>';
                                }
                            }
                        }
                        else
                        {
                            docs += '<div class="col-12" style="margin-left:45px;"><h4>No Documents available in this year..!</h4></div>';
                        }    
                        docs += '</div>';
                    }
                   
                }
            }
            $("#documentsView").html(docs);
        }
        function DeleteDoc(file_id)
        {
            $("#loaderText").html("Please wait we are deleting your document..");
            $("#customLoader").show();
            $.ajax({
                type:'GET',
                url:'document_interaction.php?type=deleteFile&file_id='+file_id,
                success:function(data){
                    console.log(data);
                    if(data == "1")
                    {
                        setTimeout(() => {
                            $("#loaderText").html("Deleted.");
                            $("#customLoader").hide();
                            fetchDocuments("All");
                        }, 500);
                    }
                    else
                    {

                    }
                }
            });
        }
        function openDocumentModal(path,ext,file_id)
        {
           // alert(path);
           $("#fileID").val(file_id);
           if(ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "webp" || ext == "gif")
           {
                $("#documentViewModalBody").html("<img src='"+path+"' width='100%' />");
           }
           else if(ext == "pdf")
           {
                $("#documentViewModalBody").html("<iframe src='"+path+"' width='100%'></iframe>");
           }
           else
           {
               window.open(path,"_BLANK");
                $("#documentViewModalBody").html("Preview not available for this type of file..!");
           }
            $("#documentViewModal").modal("show");
        }
        $("#btnDelete").on("click",function(){
            var file_id = $("#fileID").val();
            $("#documentViewModal").modal("hide");
            if(file_id != 0)
            {
                DeleteDoc(file_id);
            }
        });
        function deleteMulDocs(){
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
                    $("#loaderText").html("Please wait we are deleting your document..");
                    $("#customLoader").show();
                    var file_ids = $('input[type="checkbox"][name="file_id\\[\\]"]:checked').map(function() { return this.value; }).get();
                    $.ajax({
                        type:'POST',
                        url:'document_interaction.php?type=deleteMulFile',
                        data:{file_ids:file_ids},
                        success: function(data) {
                            // console.log(data);
                            if (data == 'true') {
                                setTimeout(() => {
                                    $("#loaderText").html("Deleted.");
                                    $("#customLoader").hide();
                                    fetchDocuments("All");
                                }, 500);
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
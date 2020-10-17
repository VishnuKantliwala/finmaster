<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
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
       
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row nameBoxWrap" name="nameBoxWrap">
                            <div class="col-12">
                                <div class="card-box">
                                    <form name="basicForm" id="basicForm" method="post">
                                    <h4 class="m-t-0 header-title">Basic Details</h4>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-3">
                                                <label class="col-sm-2  col-form-label" for="txtCustomer">Customer</label>
                                                <div class="col-sm-4">
                                                    <input type="text" id="txtShipper" name="txtShipper" class="form-control" placeholder="Customer Name" autocomplete="off" required>
                                                    <div id="suggesstion-box"></div>
                                                </div>
                                                
                                                <label class="col-sm-1  col-form-label" for="txtCustomer">ID</label>
                                                <div class="col-sm-4">
                                                    <input type="text" id="txtShipperID" name="txtShipperID" class="form-control" placeholder="Customer ID" readonly>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Select Year:</label>
                                                <div class="col-sm-3">
                                                    <select id="year" name="year" class="form-control" required>
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
                                            <div class="form-group row mb-3">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary width-sm" id="saveBasicDetails" name="saveBasicDetails">Save Basic Details</button>
                                                    <a href="serviceConfirmationView.php" class="btn btn-lighten-primary waves-effect waves-primary  width-sm">Cancel</a>
                                                    <img src='loader1.gif' style='width:2%;display:none;' id='custloader'/>
                                                    <label id="Message" style="font-weight:bold;color:green;"></label>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    </form>
                                    <!-- end row -->
                                </div> <!-- end card-box -->
                                <div class="card-box">
                                    <form name="docsForm" id="docsForm" method="post" enctype="multipart/form-data">
                                    <h4 class="m-t-0 header-title">Select Category & Upload Documents</h4>
                                    <hr/>
                                    <input type="hidden" id="document_id" name="document_id" class="form-control">
                                    <input type="hidden" id="document_year_id" name="document_year_id" class="form-control">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="catTree">
                                                <ul>
                                                    
                                                </ul>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-3">
                                                <input type="file" class="dropify" name="file[]" id="files" data-height="200" multiple/>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div class="form-group row mb-3">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary width-sm" id="addConfirmation" name="addConfirmation">Upload Documents</button>
                                            <a href="documentView.php" class="btn btn-lighten-primary waves-effect waves-primary  width-sm">Cancel</a>
                                            <input type="hidden" id="txtResultDocs">
                                            <img src='loader1.gif' style='width:2%;display:none;' id='custloaderDocs'/>
                                            <label id="MessageDocs" style="font-weight:bold;color:green;"></label>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- end row -->
                                </div> <!-- end card-box -->
                            </div><!-- end col -->
                            
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->

                </div> <!-- content -->
            </div>
                <?php
            include 'footer.php';
            ?>
        
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
                        //console.log(data);
                        data = JSON.parse(data);
                        var checkBox = "";
                        //alert(data.length);
                        var row = '';
                        for(i=0;i<data.length;i++)
                        {
                            if(data[i].sub_cat.length == 0)
                                checkBox = '<input type="radio" name="cat_id" id="cat_id_'+data[i].cat_id+'" value="'+data[i].cat_id+'"/>';
                            else
                                checkBox = "";
                            row += '<li>'+checkBox+'&nbsp;<label for="cat_id_'+data[i].cat_id+'">'+data[i].cat_name+'</label>';
                            if(data[i].sub_cat.length > 0)
                            {
                                row += "<ul>";
                                for(j=0;j<data[i].sub_cat.length;j++)
                                {
                                    row += '<li><input type="radio" name="cat_id" id="sub_cat_id_'+data[i].sub_cat[j].cat_id+'" value="'+data[i].sub_cat[j].cat_id+'"/>&nbsp;<label for="sub_cat_id_'+data[i].sub_cat[j].cat_id+'">'+data[i].sub_cat[j].cat_name+'</label></li>';
                                }
                                row += "</ul>";
                            }
                            row += "</li>";
                        }
                        // row += '<li><a href="#" id="inline-firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname">Add Category</a></li>';
                        $("#catTree > ul").html(row);
                    }
                });
            }
        </script>
        <script>
        $('#basicForm').on('submit',function(event){  
			event.preventDefault();
			$('#lbl').html("");  
            $("#custloader").show();
            $('#Message').html("Saving..");
			$('#saveBasicDetails').val("Saving..");  
			setTimeout(() => {
				$.ajax({  
					url:"document_interaction.php?type=SaveBasicDetails",  
					method:"POST",  
					data:$('#basicForm').serialize(),  
					success:function(data){
                        data = JSON.parse(data);
                        $("#document_id").val(data.lastDocInsID);
                        $("#document_year_id").val(data.lastDocYearInsID);
						$('#saveBasicDetails').val("Saved Successfully"); 
						$('#Message').html("Basic Details Saved Successfully.");
						setTimeout(() => {
                            $("#custloader").hide();
                            $('#Message').html("");
							$('#saveBasicDetails').val("Save Basic Details"); 
						}, 1000);
						//$("#basicForm :input").prop("disabled",true);
						
					},
                    error:function(data)
                    {
                        $("#custloader").hide();
						$('#Message').html(data); 
                    } 
				});  
			}, 2000);
			
			
        });  
        $('#docsForm').on('submit',function(event){  
			event.preventDefault();
            //console.log(JSON.stringify($('#docsForm').serialize()));
            $("#custloaderDocs").show();
            $('#MessageDocs').html("Uploading..");
            $('#saveBasicDetails').val("Uploading..");  
            var form = $('#docsForm')[0];
            var formdata = new FormData(form);
			//setTimeout(() => {
				$.ajax({  
					url:"document_interaction.php?type=UploadDocs",  
					method:"POST",
                    enctype: 'multipart/form-data',
                    processData: false,  // Important!
                    contentType: false,
                    cache: false,
					data:formdata,
					success:function(data){
                        //data = JSON.parse(data);
                        //console.log(data);
                        if(data == 1)
                        {
                            $('#saveBasicDetails').val("Saved Successfully"); 
                            $('#MessageDocs').html("Docs Uploaded Successfully.");
                            setTimeout(() => {
                                $("#custloaderDocs").hide();
                                $('#MessageDocs').html("");
                                $('#saveBasicDetails').val("Upload Documents"); 
                                $(".dropify-clear").trigger("click");
                            }, 1000);
                            
                        }
                        else
                        {
                            $("#custloaderDocs").hide();
                            $('#MessageDocs').html("Something went wrong, Please try again later..!");
                            $('#saveBasicDetails').val("Upload Documents"); 
                        }
						//$("#basicForm :input").prop("disabled",true);
						
					},
                    error:function(data)
                    {
                        $("#custloaderDocs").hide();
						$('#MessageDocs').html(data); 
                    } 
				});  
			//}, 2000);
			
			
        });
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
<?
session_start();
if(!isset($_SESSION['shipper_id']))
    header("Location:../Login/");
$page_id = 62;
include_once("header.php");

$sql = $cn->selectdb("select * from tbl_page p where p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);
$shipper_id = $_SESSION['shipper_id'];
$document_id = 0;
$sqlDocument = $cn->selectdb("SELECT document_id FROM tbl_document WHERE shipper_id = ".$shipper_id);
if($cn->numRows($sqlDocument) > 0)
{
    $row = $cn->fetchAssoc($sqlDocument);
    $document_id = $row["document_id"];
}
?>

<section
    class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image"
    style="background-image: url(page/big_img/<? echo $image; ?>);">
    <div class="container">
        <div class="page-title">
            <h2>
                <? echo $page_name ?>
            </h2>
        </div>
    </div>
</section>
<style>
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
.centered h4{
    margin-top:0px;
}
@media only screen and (max-width:768px)
{
    .doc{
        display:block;
        width:100%;
        max-width:none !important;
        flex:none !important;
    }
}   
</style>
<div class="loader" id="customLoader">
            
    <div class="centered">
        <img src="boss/loader1.gif" style="height:40px;"/>
        <h4 style="color:#d0d0d0;margin-left:10px;" id="loaderText">Please wait...</h4>
    </div>
</div>
<section class="section-60 section-md-100 section-xl-bottom-120">
    <div class="container">

        <h5 class="text-center">
            Documents of <? echo $_SESSION['shipper_name'] ?>
        </h5>
        <div class="row justify-content-md-center row-30">
            <div class="col-xl-12">
                <div class="card-box">
                    <form name="basicForm" id="basicForm" method="post">
                    <h4 class="m-t-0 header-title">Filter Documents</h4>
                    <hr/>
                    <div class="row" style="padding-bottom:10px;">
                        <div class="col-12">
                            
                            <div class="form-group row ">
                                <input type="hidden" id="shipper_id" value="<? echo $shipper_id; ?>"/>
                                <input type="hidden" id="document_id" value="<? echo $document_id; ?>"/>
                                <label for="inputEmail3" class="col-sm-2 control-label">Select Year:</label>
                                <div class="col-sm-3">
                                    <select id="year" name="year" required>
                                        <option disabled readonly>Select Year</option>
                                        <?
                                        $sqlDocYear = $cn->selectdb("SELECT dy.document_year FROM tbl_document_year dy,tbl_document d WHERE d.document_id = dy.document_id AND d.shipper_id = ".$shipper_id." GROUP BY dy.document_year");
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
                                <div class="col-md-2" style="padding-top:5px;">
                                    <button type="button" class="btn btn-primary width-sm" id="FilterDocs" name="FilterDocs">Filter</button>
                                </div>
                                <div class="col-md-2" style="padding-top:5px;">
                                    <button type="button" class="btn btn-primary width-sm" id="ClearFilterDocs" name="ClearFilterDocs">Clear Filter</button>
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
                
            </div>

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
                        <!-- <button type="button" id="btnDelete" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Delete</button> -->
                    </div>
                </div>
            </div>
        </div><!-- END MODAL -->
    </div>
</section>
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
                url:'boss/document_interaction.php?type=fetchDocuments&document_id='+document_id,
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
            var docs = '';
            // docs += '<button type="button" class="btn btn-primary" name="DeleteMulDoc" id="DeleteMulDoc" onClick="deleteMulDocs()" style="margin:5px;"><i class="fa fa-trash"></i> Delete Selected Files</button>';
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
                        docs += '<div class="col-12" style="border-bottom:1px dashed grey;border-top:1px dashed grey;display:flex;"><h4>'+yearname+'</h4`></div>';
                        if(data.document_year[i].hasOwnProperty("document_year_cat"))
                        {
                            for(j=0;j<data.document_year[i].document_year_cat.length;j++)
                            {
                                var catname = data.document_year[i].document_year_cat[j].cat_name;
                                docs += '<div class="col-12" style="margin-left:45px;"><h6>Category - '+catname+'</h6></div>';
                                if(data.document_year[i].document_year_cat[j].hasOwnProperty("files"))
                                {
                                    docs += '<div class="col-12 row" style="margin-left:45px;margin-bottom:15px;">';
                                    for(k=0;k<data.document_year[i].document_year_cat[j].files.length;k++)
                                    {
                                        var filename = data.document_year[i].document_year_cat[j].files[k].file_name;
                                        var ext = filename.split(".");
                                        var count = ext.length;
                                        var path = "boss/Documents/"+shipper_name.replace(/ /g,"")+"/"+data.document_year[i].document_year_name+"/"+catname.replace(/ /g,"")+"/"+filename;
                                        var image_name = "boss/assets/file/file.png";
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
                                        docs += '<div class="col-4 doc" style="display:flex;">'+
                                                    '<div class="col-6">'+
                                                    // '<input type="checkbox" name="file_id[]" value="'+data.document_year[i].document_year_cat[j].files[k].file_id+'">'+
                                                    '<a onClick="openDocumentModal(\''+path+'\',\''+ext[count-1]+'\',\''+data.document_year[i].document_year_cat[j].files[k].file_id+'\')" title="File Name : '+filename+'"><img src="'+image_name+'" style="width:100%;"/></a>'+
                                                    // '<div class="col-12" style="text-align:center;">'+
                                                    //     '<button type="button" class="btn btn-primary" name="DeleteDoc" onClick="DeleteDoc('+data.document_year[i].document_year_cat[j].files[k].file_id+')"><i class="fa fa-trash"></i></button>'+
                                                    // '</div>'+
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
                url:'boss/document_interaction.php?type=deleteFile&file_id='+file_id,
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
                        url:'boss/document_interaction.php?type=deleteMulFile',
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
<? include_once("footer.php"); ?>
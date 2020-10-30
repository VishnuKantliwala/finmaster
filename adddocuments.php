<?
$page_id = 63;
session_start();
include_once("header.php");
if(!isset($_SESSION['userid']))
    header("Location:../Login/");
$sql = $cn->selectdb("select * from tbl_page p where p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);

?>
<!-- For Custom Input Type -->
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link rel="stylesheet" type="text/css" href="css/normalize.css" />

<!-- For Custom Input Type -->
<section
    class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image"
    style="background-image: url(page/big_img/<? echo $image; ?>);">
    <div class="container">
        <div class="page-title">
            <h2>
                <? echo $page_name; ?>
            </h2>
        </div>
    </div>
</section>
<section class="section-35 section-md-75 section-xl-100 novi-background bg-cover bg-whisper-lighten">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5 text-center">

                <form method="post" id="addnew" name="addnew" enctype="multipart/form-data">
                    <label for="inputEmail3" class="col-sm-12 control-label">Member Name:</label>
                    <div class="col-sm-12">
					
                        <select id="customer" name="customer" class="form-control">
                            <option disabled readonly>Member Name</option>
                            <?
                            $sqlShipper = $cn->selectdb("SELECT s.shipper_name,s.shipper_id from tbl_shipper s where s.shipper_group = '".$_SESSION['groupname']."' order by s.shipper_id asc");
                            while($rowShipper = mysqli_fetch_assoc($sqlShipper))
                             {
                            ?>
                            <option value="<? echo $rowShipper['shipper_id'] ?>">
                                <? echo $rowShipper['shipper_name'] ?>
                            </option>
                            <? } ?>
                        </select>
                        
                    </div>
					<br/>
                    <label for="inputEmail3" class="col-sm-12 control-label">Select Year:</label>
                    <div class="col-sm-12">
					
                        <select id="year" name="year" class="form-control">
                            <option disabled readonly>Select Year</option>
                            <option value="BasicDocs">Basic Documents</option>
                            <?
                                               $d = date("Y");
                                               $syear = $d - 10;
                                               $eyear = $d + 1;
                                               for($i=$syear;$i<=$eyear;$i++)
                                               {
                                                   $val =  $i ."-".intval($i+1);
                                               ?>
                            <option value="<? echo $val; ?>">
                                <? echo $val; ?>
                            </option>
                            <? } ?>
                        </select>
                    </div>
					<br/>
					<label for="inputEmail3" class="col-sm-12 control-label">File Name:</label>
                    <div class="col-sm-12">
					
                        <input type="text" id="filename" name="filename" class="form-input" placeholder="File Name" required/>
                            
                    </div>
					<label for="inputEmail3" class="col-sm-12 control-label"></label>
                    <div class="box">
                        <input type="file" name="file" id="file" class="inputfile inputfile-4"
                            data-multiple-caption="{count} files selected" style="display:contents;"/>
                        <label id="lblname" for="file">
                            <figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                    <path
                                        d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                    </svg></figure> <span>Choose a file&hellip;</span>
                        </label>
                    </div>

                    <img src="loader.gif" style="height:30px;margin-top:10px;display:none;" id="loader"/>
                    <label  id="lblsave" style="color:red"></label>
                    <label id="lblfile" style="color:red;"></label>
                    <br/>
                    <button class="btn btn-primary-outline" type="submit" id="save" name="save">ADD</button>
                    
                    
                </form>
            </div>
        </div>
    </div>
</section>
<script>
// $('#file').bind('change', function() {
//     var fileSize = this.files[0].size / 1024;
//     var maxSize = 2000;
//     var ext = $('#file').val().split('.').pop().toLowerCase();
//     var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
//     if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
//         $('#lblfile').html("Invalid File!");
//         $('#file').val('');
//         return false;
//     } 
//     else if (fileSize > maxSize) {
//         $('#lblfile').html("Please Select File Less Than 2 MB");
//         $('#file').val('');
//         return false;

//     }


// });
$(document).ready(function() {

    $("#addnew").submit(function(evt) {
        evt.preventDefault();
        var file = $("#file").val();
        //alert(file);
        if (file == "") {

            $('#lblfile').html("Please Select File.!");
            return false;
        } else {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "savechanges.php?btn=addnew",
                method: "POST",
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function() {
                    $("#loader").show();
                    $('#lblsave').html("Please Wait..");
                },
                success: function(data) {
                    
                    if (data == 0) {

                        $('#lblfile').html("");

                        $('#lblsave').html("Documents Uploaded Successfully..");
                        $('#file').val("");
                        window.location.replace("<? echo $domain; ?>MyDocuments/");
                    } else {
                        $('#lblfile').html("");
                        $('#lblsave').html("Oops There are some Issues Try Again Later..!");
						alert(data);
                    }
                   
                    setInterval(function() {
                        $('#lblsave').html("");

                    }, 3000);
                }
            });
        }

    });

});
</script>
<script src="js/custom-file-input.js"></script>
<? include_once("footer.php"); ?>
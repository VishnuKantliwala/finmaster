<?
session_start();
$page_id = 65;
include_once("header.php");

$sql = $cn->selectdb("select * from tbl_page p where p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);

?>

      <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image" style="background-image: url(page/big_img/<? echo $image; ?>);">
        <div class="container">
          <div class="page-title">
            <h2><? echo $page_name ?></h2>
          </div>
        </div>
      </section>

      <section class="section-40 section-md-100 novi-background bg-cover">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
              <h4><? echo $page_name ?></h4>
              <form class="rd-mailform form-modern offset-top-22" method="post" id="pwdform">
                <div class="form-wrap">
                  <input class="form-input" id="curpass" type="password" name="curpass" data-constraints="@Required" placeholder="Current Password">
                  
                </div>
                <div class="form-wrap">
                  <input class="form-input" id="npass" type="password" name="npass" data-constraints="@Required" placeholder="New Password">
                  
                </div>
                <div class="form-wrap">
                  <input class="form-input" id="ncpass" type="password" name="ncpass" data-constraints="@Required" placeholder="Confirm Password">
                  
                  <label id="lblpwd" style="color:red"></label>
                </div>
                <label id="lbllogin" style="color:red"></label>
                <button class="btn btn-primary btn-block" type="button" name="login" id="login" style="margin-top:0px !important;">Change Password</button>
              </form>
            </div>
          </div>
        </div>
      </section>
<script>
$(document).on('click', '#login', function(event){
    checkvalue(); 		
    checklogin();  
});
function checkvalue()
 {
     var curpass = $("#curpass").val();
	 var npass = $("#npass").val();
			var ncpass = $("#ncpass").val();
		
		    if(curpass == "")  
           {  
                 $('#curpass').focus();
			
                die();
           } 
		   
		   else if(npass == '')  
           {  
                 $('#npass').focus();
				
				$('#lblpwd').html("Password is required");
                die();
           }
		   else if(ncpass == '')  
           {  
                 $('#ncpass').focus();
				
				$('#lblpwd').html("Confirm Password is required");
                die();
           }
           else if(npass != ncpass)  
           {  
                 $('#ncpass').focus();
				
				$('#lblpwd').html("New Password and Confirm Password Must be Same..!");
                die();
           }
		   else
		   {
			    $('#lblcurpass').html(""); 
				$('#lblpwd').html("");
		   }
		  
 }
  function checklogin()
 {
	var curpass = $("#curpass").val();
	var password = $("#ncpass").val();
		$.ajax({  
                     url:"savechanges.php?btn=changepwd&pwd="+password+"&cpwd="+curpass,  
                     method:"GET",  
                      success:function(data){  
						if(data == 0)
						{
							 $('#pwdform').find("input[type=password]").val("");
							$('#lbllogin').html("Password Changed Successfully.");
							
						}
						else
						{
							$('#lbllogin').html(data);
						}
						
					}  
                });  
			
 }
</script>
    
   <? include_once("footer.php"); ?>
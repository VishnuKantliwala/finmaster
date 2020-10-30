<?

$page_id = 61;
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
              <h4>Connect With Us</h4>
              <form class="rd-mailform form-modern offset-top-22" method="post">
                <div class="form-wrap">
                  <input class="form-input" id="email" type="email" name="email" data-constraints="@Email @Required" placeholder="Email Id">
                  
                  <label id="lblemail" style="color:red"></label>
                </div>
                <div class="form-wrap">
                  <input class="form-input" id="pass" type="password" name="pass" data-constraints="@Required" placeholder="Password">
                  
                  <label id="lblpwd" style="color:red"></label>
                </div>
                <label id="lbllogin" style="color:red"></label>
                <button class="btn btn-primary btn-block" type="button" name="login" id="login" style="margin-top:0px !important;">Login</button>
                <label style="float:right;font-style:italic;color:red;margin-top:10px;"><a href="ForgotPassword/">Forgot Password?</a></label>
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
	 var email = $("#email").val();
			var password = $("#pass").val();
		
		    if($('#email').val() == "")  
           {  
                 $('#email').focus();
				$('#lblemail').html("Please Enter Email or Mobile No.");  
                die();
           } 
		   
		   else if($('#pass').val() == '')  
           {  
                 $('#pass').focus();
				 $('#lblemail').html(""); 
				$('#lblpwd').html("Password is required");
                die();
           }
		   
		   else
		   {
			    $('#lblemail').html(""); 
				$('#lblpwd').html("");
		   }
		  
 }
function checklogin()
{
  var email = $("#email").val();
  var password = $("#pass").val();
  $.ajax({  
    url:"check_login.php?email="+email+"&pwd="+password,  
    method:"GET",  
    success:function(data){  
      if(data == 0)
      {
        $('#lblemail').html(""); 
        $('#lblpwd').html("");
        window.open("MyDocuments/","_SELF");
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
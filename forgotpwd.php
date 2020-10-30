<?

$page_id = 66;
include_once("header.php");

$sql = $cn->selectdb("select page_name from tbl_page p where p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);

?>

      <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image" >
        <div class="container">
          <div class="page-title">
            <h2><? echo $page_name ?></h2>
          </div>
        </div>
      </section>
 
      <section class="section-40 section-md-100 novi-background bg-cover" style="padding-bottom:130px;">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
              <h4><? echo $page_name ?></h4>
              <form class="rd-mailform form-modern offset-top-22" method="post">
                <div class="form-wrap">
                  <input class="form-input" id="email" type="email" name="email" data-constraints="@Email @Required" placeholder="Email Id">
                  
                </div>
                
                <label id="lbllogin" style="color:red"></label>
                <button class="btn btn-primary btn-block" type="button" name="login" id="login" style="margin-top:0px !important;">Submit</button>
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
			
		    if($('#email').val() == "")  
           {  
                 $('#email').focus();
			
                die();
           } 
		  
		  
 }
  function checklogin()
 {
	 var email = $("#email").val();

		$.ajax({  
                     url:"savechanges.php?btn=forgotpwd&email="+email,  
                     method:"GET",  
                      success:function(data){  
						if(data == 0)
						{
							 $("#email").val("");
						    $('#lbllogin').html("Your Request is Submitted, Check Your Mail.");
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
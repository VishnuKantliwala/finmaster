<?
$page_id = 31;
include_once("header.php");
$sql = $cn->selectdb("select * from tbl_page p where  p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);

?>

      <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image" style="background-image: url(page/big_img/<? echo $image; ?>);">
        <div class="container">
          <div class="page-title">
            <h2><? echo $page_name; ?></h2>
          </div>
        </div>
      </section>

        <section class="section-66 section-md-90 novi-background bg-cover">
        <div class="container">
          
          
          <ul class="row row-30 row-flex block-service-wrap">
		  <?
		  $sql = $cn->selectdb("SELECT * FROM  `tbl_service`order by recordListingID ASC" );
		  if(mysqli_num_rows($sql) > 0)
		  {
			  while($row = mysqli_fetch_Assoc($sql))
			  {
				  extract($row);
		  ?>
            <li class="col-md-6">
              <div class="block-service bg-black bg-image custom-bg-image" style="background-image: url(product/big_img/<? echo $service_image; ?>);">
                <div class="block-inner">
                  <div class="block-header">
                    <a href="Service_Detail/<? echo $slug; ?>/"><h4><? echo $service_name; ?></h4></a>
                  </div>
                  
                </div>
              </div>
            </li>
			<?
			  }
		  }
			?>
            
          </ul>
        </div>
      </section>

 <? include_once("footer.php"); ?>
<?
$page_id = 29;
include_once("header.php");
?>


      <section>
        <div class="swiper-container swiper-slider swiper-variant-1 bg-black" data-loop="true" data-autoplay="5000" data-simulate-touch="true">
          <div class="swiper-wrapper text-center">
		  <?
					$i = 0;
					$sql = $cn->selectdb("select * from tbl_slider order by recordListingID");
					if(mysqli_num_rows($sql) > 0)
					{
						while($row = mysqli_fetch_assoc($sql))
						{
							$i++;
							extract($row);
					?>
            <div class="swiper-slide" data-slide-bg="slider/big_img/<? echo $image_name; ?>">
              <div class="swiper-slide-caption">
                <div class="container">
                  <div class="row row-fix justify-content-sm-center">
                    <div class="col-md-11 col-lg-10">
                      <div class="text-white text-uppercase jumbotron-custom border-modern" data-caption-animate="fadeInUp" data-caption-delay="0s"><? echo $image_title; ?><span class="border-modern-item-1"></span><span class="border-modern-item-2"></span><span class="border-modern-item-3"></span><span class="border-modern-item-4"></span></div>
                      <div data-caption-animate="fadeInUp" data-caption-delay="450s">
                        <p class="text-big-19 text-white d-none d-md-inline-block"><? echo $desc_slider; ?></p>
                      </div>
                      <div class="button-block" data-caption-animate="fadeInUp" data-caption-delay="550s"><a class="btn btn-primary" href="<? echo $link_url; ?>">Contact us</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<?
						}
					}?>
           
          </div>
          <div class="swiper-scrollbar d-xl-none"></div>
          <div class="swiper-nav-wrap d-none d-xl-block">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </section>
	
	<?
	$sql = $cn->selectdb("select * from tbl_page p,tbl_addmore m where p.page_id = m.page_id and p.page_id = 52");
	$row = mysqli_fetch_assoc($sql);
	extract($row);
	?>
	  <section class="section-60 section-md-90 section-md-bottom-100 bg-white bg-image bg-image-1" style="background-color:white;">
        <div class="container">
          <div class="row row-fix justify-content-md-center justify-content-lg-end">
		  <!--<div class="col-md-4 col-lg-4 col-xl-4">-->
    <!--                <img src="page/big_img/<?// echo $image; ?>" alt="<?// echo $image; ?>">-->
    <!--            </div>-->
            <div class="col-md-12 col-lg-12 col-xl-12">
              <h3><? echo $page_name ?> </h3>
              <p class="text-black-05"> <? echo $page_desc; ?></p>
			  <!-- <a class="btn btn-primary" href="Aboutus/">About Partners</a> -->
            </div>
            
          </div>
        </div>
      </section>
	  <?
	$sql = $cn->selectdb("select * from tbl_page p where p.page_id = 31");
	$row = mysqli_fetch_assoc($sql);
	extract($row);
	?>
	  <section class="section-66 section-md-90 bg-accent text-center novi-background bg-cover">
        <div class="container">
          <h3><? echo $page_name; ?></h3>
          
          <ul class="row row-30 row-flex block-service-wrap">
		  <?
		  $sql = $cn->selectdb("SELECT `service_name`,service_image,slug FROM  `tbl_service` order by recordListingID ASC" );
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
      <!--Icon box-->
      

  
<? include_once("footer.php"); ?>
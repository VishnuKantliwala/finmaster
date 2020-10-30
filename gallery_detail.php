<?
$page_id = 30;
include_once("header.php");
$sql = $cn->selectdb("select * from tbl_page p where  p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);
?>
    <!-- End Header -->

    <!-- Start Breadcrumb 
    ============================================= -->
   
     <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image" style="background-image: url(page/big_img/<? echo $image; ?>);">
        <div class="container">
          <div class="page-title">
            <h2><? echo $_GET['id']; ?></h2>
          </div>
        </div>
      </section>
    <!-- End Breadcrumb -->

    <!-- Start Portfolio
    ============================================= -->
   <section class="section-60 section-md-90 section-md-bottom-100 bg-white bg-image bg-image-1" style="background-color:white;">
        <div class="container isotope-wrap">
            <div class="col-sm-12 ">
              <div class="row">
				
                    <div class="isotope isotope-gutter-default" data-isotope-layout="fitRows" data-isotope-group="gallery1" data-lightgallery="group">
					<?
					$sql = $cn->selectdb("select * from tbl_gallery where slug ='".$_GET['id']."'");
					{
						while($row = mysqli_fetch_assoc($sql))
						{
							extract($row);
							$images = explode(",",$multi_images);
							for($i = 0;$i < count($images) -1;$i++)
							{
								
					?>
					<div class="col-12 col-md-6 col-lg-4 isotope-item" >
                        <div class="thumbnail thumbnail-variant-3"><a class="link link-external" href="Gallery_Detail/<? echo $slug; ?>/"><span class="novi-icon icon icon-sm fa fa-link"></span></a><a class="img-link" href="galleryF/big_img/<? echo $images[$i]; ?>" data-lightgallery="item"><img class="img-item" src="galleryF/big_img/<? echo $images[$i]; ?>" alt="<? echo $gallery_image; ?>" width="370" height="278"/></a>
                          <div class="caption">
                            <div class="link link-original"></div>
                          </div>
                        </div>
                      </div>
							
                       
					<?
							}
						}
					}
					?>
                       
                   </div>
            </div>
                </div>
            </div>
        </section>
    

    <!-- End Portfolio -->

 <? include_once("footer.php"); ?>
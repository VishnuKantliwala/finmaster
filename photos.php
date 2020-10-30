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
            <h2><? echo $page_name ?></h2>
          </div>
        </div>
      </section>
    <!-- End Breadcrumb -->

    <!-- Start Portfolio
    ============================================= -->
      
    <!-- End Portfolio -->
    <section class="section-66 novi-background bg-cover bg-whisper-lighten">
        <div class="container text-center">
          <h3>ARTICLES</h3>
          <div class="divider"></div>
        </div>
      </section>
      <section class="section-50 section-md-75 section-xl-100 bg-cover novi-background">
        <div class="container">
          <div class="row justify-content-md-center justify-content-lg-start row-30">
              <?
         $sql = $cn->selectdb("select blog_name,slug,description from tbl_blog where cat_id = '' order by recordListingID");
		  if(mysqli_num_rows($sql) > 0)
		  {
		      $i = 0;
			  while($row = mysqli_fetch_assoc($sql))
			  {
			      $i++;
				  extract($row);
         ?>
            <div class="col-md-9 col-lg-4 height-fill" >
              <article class="post-block" style="height:160px !important;">
                <div class="post-image">
                  <div class="image-block bg-cover" style="background-image: url(bg.jpg);"></div>
                </div>
                <div class="post-body">
                  <h4 class="post-header"><a href="<? echo $slug; ?>" target="_BLANK"><? echo $i.".&nbsp;".$blog_name; ?></a></h4>
                  <ul class="post-meta">
                   
                    <li class="object-inline"><span class="novi-icon icon icon-xxs icon-white material-icons-query_builder"></span>
                      <i class="fa fa-clock" ></i><? echo $description; ?>
                    </li>
                    
                  </ul>
                </div>
              </article>
            </div>
            <? }
            }?>
          </div>
          
        </div>
      </section>

      
<section class="section-66 novi-background bg-cover bg-whisper-lighten">
        <div class="container text-center">
          <h3>GALLERY</h3>
          <div class="divider"></div>
        </div>
      </section>
  <section class="section-50 section-md-100 section-md-bottom-100 bg-white bg-image bg-image-1" style="background-color:white;">
        <div class="container isotope-wrap">
             <div class="col-sm-12">
              <div class="row isotope">
                   <? 
							$sqlgallery = $cn->selectdb("select gallery_id,multi_images from tbl_gallery");
							if(mysqli_num_rows($sqlgallery) > 0)
							{
							?>
                <div class="isotope isotope-gutter-default" data-isotope-layout="fitRows" data-isotope-group="gallery1" data-lightgallery="group" id="results">
                    <?
                    while($row = mysqli_fetch_assoc($sqlgallery))
						{
							extract($row);
							$i=0;
							
							if($multi_images != "" && $multi_images != NULL){
							    $images = explode(",",$multi_images);
							for($i = 0;$i < count($images) -1;$i++)
							{
                    ?>
                 <div class="col-12 col-md-6 col-lg-4 isotope-item" >
                    <div class="thumbnail thumbnail-variant-3" ><a class="img-link" href="galleryF/big_img/<? echo $images[$i]; ?>" data-lightgallery="item"><img class="img-item" src="galleryF/big_img/<? echo $images[$i]; ?>" alt="<? echo $images[$i]; ?>" style="width:100%;height:300px;object-fit:cover;overflow:hidden;"/></a>
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
                       
			<? } ?>	
		
						
                 
                </div>
            </div>
        </div>
    </section>
    
    <section class="section-66 novi-background bg-cover bg-whisper-lighten">
        <div class="container text-center">
          <h3>KNOWLEDGE BANK</h3>
          <div class="divider"></div>
        </div>
      </section>
      <section class="section-50 section-md-75 section-xl-100 bg-cover novi-background">
        <div class="container">
          <div class="row justify-content-md-center justify-content-lg-start row-30">
              <?
         $sql = $cn->selectdb("select slug,blog_name from tbl_blog where cat_id != '' order by recordListingID");
		  if(mysqli_num_rows($sql) > 0)
		  {
		      $i = 0;
			  while($row = mysqli_fetch_assoc($sql))
			  {
			      $i++;
				  extract($row);
         ?>
            <div class="col-md-9 col-lg-4 height-fill" >
              <article class="post-block" style="height:160px !important;">
                <div class="post-image">
                  <div class="image-block bg-cover" style="background-image: url(bg.jpg);"></div>
                </div>
                <div class="post-body">
                  <h4 class="post-header"><a href="<? echo $slug; ?>" target="_BLANK"><? echo $i.".&nbsp;".$blog_name; ?></a></h4>
                  
                </div>
              </article>
            </div>
            <? }
            }?>
          </div>
          
        </div>
      </section>
 <? include_once("footer.php"); ?>
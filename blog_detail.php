 <?
$page_id = 57;
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
	
      <section class="section-60 section-md-75 section-xl-100 novi-background bg-cover">
        <div class="container">
          <div class="row row-50 row-fix">
		  <?
		$sql = $cn->selectdb("select * from tbl_blog where slug = '".$_GET['bid']."'");
		  if(mysqli_num_rows($sql) > 0)
		  {
			$row = mysqli_fetch_assoc($sql); 
			  extract($row);
			  $date_arr=explode(" ",$bdate);
			  $date=explode('-',$date_arr[0]);
			  
			  
			  $dateObj   = DateTime::createFromFormat('!m', $date[1]);
			  $monthName = $dateObj->format('F');
		?>
            <div class="col-lg-8 col-xl-9">
              <article class="post post-single">
                <div class="post-image">
                  <figure><img src="blog/big_img/<? echo $blog_image; ?>" alt="" width="870" height="412"/>
                  </figure>
                </div>
                <div class="post-header">
                  <h4><? echo $blog_name; ?></h4>
                </div>
                <div class="post-meta">
                  <ul class="list-bordered-horizontal">
                    <li>
                      <dl class="list-terms-inline">
                        <dt>Date</dt>
                        <dd>
                          <time datetime="<? echo $date[2]."-".$monthName."-".$date[0] ?>"><? echo $date[2]."-".$monthName."-".$date[0] ?></time>
                        </dd>
                      </dl>
                    </li>
                    
                  </ul>
                </div>
                <div class="divider-fullwidth bg-gray-light"></div>
               <div class="post-body">
                  <p class="text-black"><? echo $description; ?></p>
                  
                </div>
              </article>
            </div>
			<?
			  
		  }
			?>
            <div class="col-lg-4 col-xl-3">
              <div class="inset-lg-left-15">
                <div class="row row-40">
                  <div class="col-md-6 col-lg-12">
                    <h6 class="text-small-16 font-weight-bold text-uppercase aside-title">Services</h6>
                    <ul class="list-marked-bordered">
					<?
					$sql1 = $cn->selectdb("select cat_name,slug from tbl_category where cat_parent_id = 0 order by recordListingID");
					if(mysqli_num_rows($sql1) > 0)
					{
						while($row1 = mysqli_fetch_assoc($sql1))
						{
							extract($row1);
							
					?>
                      <li><a href="Services/<? echo $slug; ?>/"><span><? echo $cat_name; ?></span></a></li>
					  <?
						}
					}
					  ?>
                      
                    </ul>
                  </div>
                  <div class="col-md-6 col-lg-12 post-preview-wrap">
                    <h6 class="text-small-16 font-weight-bold text-uppercase aside-title">POPULAR SERVICES</h6>
					<?
					$sql2 = $cn->selectdb("select * from tbl_product order by RAND() LIMIT 5");
					while($row2 = mysqli_fetch_assoc($sql2))
					{
						
						extract($row2);
					?>
                    <article class="post post-preview offset-top-15">
					<a href="Service_Detail/<? echo $slug; ?>/">
                        <div class="unit unit-horizontal unit-spacing-sm">
                          <div class="unit-left">
                            <figure class="post-image"><img src="product/big_img/<? echo $product_image; ?>" alt="<? echo $product_image; ?>" width="70" height="70"/>
                            </figure>
                          </div>
                          <div class="unit-body">
                            <div class="post-header">
                              <p><? echo $product_name; ?></p>
                            </div>
                            
                          </div>
                        </div></a>
					</article>
					<? 
					}
					?>
                    
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
<? include_once("footer.php"); ?>
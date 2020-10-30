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

      <section class="section-50 section-md-75 section-xl-100 bg-cover novi-background">
        <div class="container">
          <div class="row justify-content-md-center justify-content-lg-start row-30">
		  <?
		  $sql = $cn->selectdb("select * from tbl_blog order by recordListingID");
		  if(mysqli_num_rows($sql) > 0)
		  {
			  while($row = mysqli_fetch_assoc($sql))
			  {
				  extract($row);
				  $date_arr=explode(" ",$bdate);
				  $date=explode('-',$date_arr[0]);
				  
				  
				  $dateObj   = DateTime::createFromFormat('!m', $date[1]);
				  $monthName = $dateObj->format('F');
		  ?>
		  
            <div class="col-md-9 col-lg-6 height-fill">
              <article class="post-block">
                <div class="post-image">
                  <div class="image-block bg-cover" style="background-image: url(blog/big_img/<? echo $blog_image; ?>);"></div>
                </div>
                <div class="post-body">
                  <h4 class="post-header"><a href="Blog_Detail/<? echo $slug; ?>/"><? echo $blog_name; ?></a></h4>
                  <ul class="post-meta">
                    
                    <li class="object-inline"><span class="novi-icon icon icon-xxs icon-white material-icons-query_builder"></span>
                      <time datetime="2018-01-01"> <? echo $date[2]."-".$monthName."-".$date[0] ?></time>
                    </li>
                    
                  </ul>
                </div>
              </article>
            </div>
			  <? }
		  }			  ?>
            
          </div>
          
        </div>
      </section>
	    
<? include_once("footer.php"); ?>
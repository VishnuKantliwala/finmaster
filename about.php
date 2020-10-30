<?
$page_id = 64;
include_once("header.php");

$sql = $cn->selectdb("select * from tbl_page p where p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);
?>
<style>
.page .text-black-05{
  color:#252020 !important;
}
</style>
      <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image" style="background-image: url(page/big_img/<? echo $image; ?>);">
        <div class="container">
          <div class="page-title">
            <h2><? echo $page_name ?></h2>
          </div>
        </div>
      </section>

      <!--<section class="section-60 section-md-90 section-md-bottom-100 bg-white bg-image bg-image-1" style="background-color:white;">-->
      <!--  <div class="container">-->
      <!--    <div class="row row-fix justify-content-md-center justify-content-lg-end">-->
		  
      <!--      <div class="col-md-12 col-lg-12 col-xl-12">-->
      <!--        <h3><? echo $page_name ?>              </h3>-->
      <!--        <div class="text-black-05" > <? echo $page_desc; ?></div>-->
      <!--      </div>-->
            <!--<div class="col-md-4 col-lg-4 col-xl-4">-->
            <!--        <img src="page/big_img/<?// echo $image; ?>" alt="<?// echo $image; ?>">-->
            <!--    </div>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</section>-->
      <?
      $sql = $cn->selectdb("SELECT page_id,page_name from tbl_page where page_id = 64");
      if(mysqli_num_rows($sql) > 0)
      {
        $row = mysqli_fetch_assoc($sql);
        $part = explode(" ",$row['page_name']);
        ?>
        
      <section class="section-60 section-md-90 section-md-bottom-100 bg-white bg-image bg-image-1" style="background-color:white;">
        <div class="container">
        <!--<div class="row">-->
        <!--    <div class="col-sm-12 text-center">-->
        <!--      <h3><? echo $part[0]; ?> <span class="text-thin"><? echo $part[1]; ?></span>-->
        <!--      </h3>-->
        <!--    </div>-->
        <!--  </div>-->
          <?
          $sql2 = $cn->selectdb("SELECT * from tbl_addmore where page_id = ".$row['page_id']);
          if(mysqli_num_rows($sql2) > 0)
          {
            while($row2 = mysqli_fetch_assoc($sql2))
            {
              $part2 = explode(":",$row2['title']);
                ?>
                
          <div class="row justify-content-md-center justify-content-lg-start row-40">
            <div class="col-md-3 col-lg-3">
              <div class="thumbnail thumbnail-profile">
                <div class="thumbnail-image "><img src="icon/big_img/<? echo $row2['extra_icon']; ?>" alt="" width="570" height="570" />
                </div>
               
              </div>
            </div>
            <div class="col-md-9 col-lg-9 col-xl-9">
              <div class="thumbnail-profile-info">
                <div class="inset-md-left-50 inset-lg-left-40 inset-xl-left-100">
                  <h4><? echo $part2[0] ?></h4>
                  <p class="text-black-05"><? echo $part2[1] ?></p>
                  <div class="text-black-05" ><? echo $row2['extra_desc'] ?></div>
                </div>
               
               
              </div>
            </div>
          </div>
          <?
            }
          }
          ?>
        </div>
      </section>
      <?
      }
      ?>
   <? include_once("footer.php"); ?>
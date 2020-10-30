<?
$page_id = 31;
include_once("header.php");
$sql = $cn->selectdb("select * from tbl_page p where  p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);
extract($row);
$sid = $_GET['sid'];
$sqlc = $cn->selectdb("select * from tbl_service where slug = '".$sid."'");
$row1 = mysqli_Fetch_assoc($sqlc);
?>

<section
    class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image"
    style="background-image: url(page/big_img/<? echo $image; ?>);">
    <div class="container">
        <div class="page-title">
            <h2>
                <? echo $row1['service_name'] ?>
            </h2>
        </div>
    </div>
</section>

<section class="novi-background">
    <div class="container">
        <div class="row row-fix justify-content-lg-end">
            <div class="col-lg-4 col-xl-4 " style="padding-top:5px;margin-top:90px;">
                <div class="image-wrap-2 "><img src="product/big_img/<? echo $row1['service_image']; ?>"
                        alt="<? echo $row1['service_name'] ?>" width="461" height="514"/>
                </div>
            </div>
            <div class="col-md-11 col-lg-8 col-xl-8">
                <div class="section-60 section-md-90">
                    <h3 >
                        <? echo $row1['service_name'] ?>
                    </h3>
                    <hr/>
                    <div class="description" style="color:#252020 !important;">
                        <? echo $row1['description']; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<? include_once("footer.php"); ?>
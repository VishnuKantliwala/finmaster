<?
$page_id=40;
include("header.php")?>
<?
	$sql = $cn->selectdb("SELECT * FROM  `tbl_page` where page_id=$page_id" );
	//	echo mysqli_num_rows($sql2);
	if (mysqli_num_rows($sql) > 0) 
	{
		$row1 = mysqli_fetch_assoc($sql);
		extract($row1);
	}
?>

       
		
		<div class="breadcrumb-area shadow dark bg-fixed text-center padding-xl text-light" style="background-image: url(page/big_img/<? echo $image; ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><? echo $page_name ?></h1>
                    <ul class="breadcrumb">
                        <li><a href="Home/">Home</a></li>
                       <li class="active"><? echo $page_name ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start 404 
    ============================================= -->
    <div class="error-page-area text-center default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1><? echo $page_name ?></h1>
                    <h2><? echo $page_desc ?></h2>
                    
                    <a class="btn btn-dark btn-md" href="Home/">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 -->

        <!-- 404 Page Area End Here -->
<?include("footer.php")?>
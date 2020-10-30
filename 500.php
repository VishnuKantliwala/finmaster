<?
$page_id=41;
include("header.php")?>
<?
	$sql = $cn->selectdb("SELECT * FROM  `tbl_page` where page_id=$page_id" );
	//	echo mysqli_num_rows($sql2);
	if (mysqli_num_rows($sql) > 0) 
	{
		$row1 = mysqli_fetch_assoc($sql);
	}
?>

        <!--Header area end here-->
        <!-- Banner Section Start Here -->
        <div class="top_panel_title top_panel_style_1 title_present breadcrumbs_present scheme_original">
            <div  class="bg_cust_1 top_panel_title_inner top_panel_inner_style_1 title_present_inner breadcrumbs_present_inner" >
                <div class="content_wrap">
                    <h1 class="page_title"><? echo $page_name ?></h1>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="#">Home</a>
                        <span class="breadcrumbs_delimiter"></span>
                        <span class="breadcrumbs_item current"><? echo $page_name ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Section end Here -->

        <!-- 404 Page Area Start Here -->
        <div class="error-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 error-page-message">
                        <center><div class="error-page">
                            <h1><?echo $row1['page_name']?></h1>
                            <p> <?echo $row1['slug']?></p>
                            <div class="home-page">
                                <a href="#">Go to Home Page</a>
                            </div>
                        </div></center>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 Page Area End Here -->
<?include("footer.php")?>
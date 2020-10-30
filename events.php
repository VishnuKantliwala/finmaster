<?
$page_id = 59;
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
     <div id="portfolio" class="section-50 section-md-75 section-xl-100 bg-cover novi-background">
        <div class="container">
            
            <div class="row">
                <div class="col-md-12 portfolio-content">
                    <div class="container">
					 
					  
					  <div class="table-responsive">
						<table class="table">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Program Name</th>
							  <th>Date</th>
							  <th>Time</th>
							  <th>Location</th>
							  <th>Venue</th>
							  <th>Speaker</th>
							  <th>Description</th>
							</tr>
						  </thead>
						  <tbody>
						  <?
						  $sql = $cn->selectdb("select * from tbl_events where event_date >= '".date("Y-m-d")."' order by recordListingID");
						  if(mysqli_num_rows($sql) > 0)
						  {
							  $i=0;
							  while($row = mysqli_fetch_assoc($sql))
							  {
								  $i++;
								  extract($row);
						  ?>
							<tr>
							  <td><? echo $i; ?></td>
							  <td><? echo $program_name; ?></td>
							  <td><? echo $event_date; ?></td>
							  <td><? echo $event_time . " TO " . $end_time; ?></td>
							  <td><? echo $location; ?></td>
							  <td><? echo $venue; ?></td>
							   <td><? echo $speaker; ?></td>
							  <td><a class="btn btn-dark border btn-sm" href="Event_Description/<? echo $event_id; ?>/">View More</a></td>
							</tr>
						<?
							  }
						  }
						  else
						  {
						    
						?>
						    <tr>
							  <td colspan="8">NO EVENTS..!</td>
							  
							</tr>
							<? } ?>
						  </tbody>
						</table>
					  </div>
				</div>
            </div>
        </div>
    </div>
	</div>
    <!-- End Portfolio -->

 <? include_once("footer.php"); ?>
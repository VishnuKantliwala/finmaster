<?
$page_id = 59;
include_once("header.php");
$sql = $cn->selectdb("select * from tbl_page p where  p.page_id = $page_id");
$row = mysqli_fetch_assoc($sql);


$sql1 = $cn->selectdb("select * from tbl_events where event_id = ".$_GET['eid']);
$row1 = mysqli_fetch_assoc($sql1);
extract($row1);

?>
    <!-- End Header -->

    <!-- Start Breadcrumb 
    ============================================= -->
    <section class="section-30 section-md-40 section-lg-66 section-xl-bottom-90 bg-gray-dark page-title-wrap novi-background custom-bg-image" style="background-image: url(page/big_img/<? echo $row['image']; ?>);">
        <div class="container">
          <div class="page-title">
            <h2><? echo $program_name ?></h2>
          </div>
        </div>
      </section>
   
    <!-- End Breadcrumb -->
<section class="section-60 section-md-100 section-xl-bottom-120">
        <div class="container">
          <h3 class="text-center"><? echo $program_name; ?></h3>
          <div class="row justify-content-md-center row-30">
            <div class="col-xl-10">
              <div class="card-group card-group-custom card-group-light" id="accordionOne" role="tablist" aria-multiselectable="true">
                <div class="card card-custom card-light">
                    
                    
                  <div class="card-heading" id="accordionOneHeading1" role="tab">
                    <div class="card-title"><a role="button" data-toggle="collapse" data-parent="#accordionOne" href="#accordionOneCollapse1" aria-controls="accordionOneCollapse1" aria-expanded="true">
                        DATE & TIME
                        <div class="card-arrow"></div></a>
                    </div>
                  </div>
                  <div class="card-collapse collapse in show" id="accordionOneCollapse1" role="tabpanel">
                    <div class="card-body">
                      <p<?
						echo date("d-m-Y",strtotime($event_date)) . "<br>";
						echo $event_time . " TO " . $end_time;
						?></p>
                    </div>
                  </div>
                </div>
                <div class="card card-custom card-light">
                  <div class="card-heading" id="accordionOneHeading2" role="tab">
                    <div class="card-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionOne" href="#accordionOneCollapse2" aria-controls="accordionOneCollapse2">SPEAKER
                         <div class="card-arrow"></div></a>
                    </div>
                  </div>
                  <div class="card-collapse collapse" id="accordionOneCollapse2" role="tabpanel">
                    <div class="card-body">
                      <p> <? echo $speaker;?></p>
                    </div>
                  </div>
                </div>
                <div class="card card-custom card-light">
                  <div class="card-heading" id="accordionOneHeading3" role="tab">
                    <div class="card-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionOne" href="#accordionOneCollapse3" aria-controls="accordionOneCollapse3">LOCATION & VENUE
                        <div class="card-arrow"></div></a>
                    </div>
                  </div>
                  <div class="card-collapse collapse" id="accordionOneCollapse3" role="tabpanel">
                    <div class="card-body">
                      <p><?  echo $location . "<br>";
							echo $venue;
                     ?></p>
                    </div>
                  </div>
                </div>
               
                <div class="card card-custom card-light">
                  <div class="card-heading" id="accordionOneHeading5" role="tab">
                    <div class="card-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionOne" href="#accordionOneCollapse5" aria-controls="accordionOneCollapse5">Description
                        <div class="card-arrow"></div></a>
                    </div>
                  </div>
                  <div class="card-collapse collapse" id="accordionOneCollapse5" role="tabpanel">
                    <div class="card-body">
                      <p><?
						echo $description;
						?></p>
                    </div>
                  </div>
                </div>
               
              </div>
            </div>
            
          </div>
        </div>
      </section>


    <!-- Start Portfolio
    ============================================= -->
   
    <!-- End Work Process -->


    <!-- End Portfolio -->

 <? include_once("footer.php"); ?>
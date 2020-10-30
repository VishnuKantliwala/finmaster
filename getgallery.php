<?
include_once("connect.php");

$cn=new connect();
$cn->connectdb();

				$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 2;
				$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;
				
					$sql1 = $cn->selectdb("SELECT * FROM  `tbl_gallery` order by recordListingID ASC LIMIT $limit OFFSET $offset" );
					//	echo mysqli_num_rows($sql2);
					$i=0;
					if (mysqli_num_rows($sql1) > 0) 
					{
						while($row = mysqli_fetch_assoc($sql1))
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
						
					}
					
					
			?>
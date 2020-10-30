<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:Login.php");
}

include_once("../connect.php");
include_once("../navigationfun.php");
$cn=new connect();
$cn->connectdb();
$page_id=33;

if(isset($_GET['parentid']))
{
	$parentid=$_GET['parentid'];
}
else
{
	$parentid=0;
}

//print_r($_POST);
    $result = $cn->selectdb("SELECT * FROM tbl_page where page_parent_id=".$parentid." order by page_id desc ");
			
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>Finmasters</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!--Morris Chart-->
        <link rel="stylesheet" href="assets/libs/morris-js/morris.css" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css?v=<?echo time();?>" rel="stylesheet" type="text/css" />

        <!-- third party css -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.php" class="logo text-center">
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="16">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="assets/images/logo-sm.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Information View</h4>
                </li>

            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?include_once("menu.php");?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="mt-0 header-title">Information View</h4>
                                <?php
                                    if(isset($_POST['delete']))
                                    {
                                    $cnt=array();
                                    $cnt=count($_POST['chkbox']);
                                    for($i=0;$i<$cnt;$i++)
                                    {
                                        $del_id=$_POST['chkbox'][$i];
                                        $sql=  $cn->selectdb("select * from tbl_page where page_id=$del_id");
                                        while($row = mysqli_fetch_assoc($sql))
                                        {
                                            //image
                                            @unlink('../page/big_img/'.$row['image']);
                                            @unlink('../page/'.$row['image']);
                                            
                                            $image_list = explode(',',$row['multi_images']);

                                            foreach($image_list as $rowF)
                                            {
                                                //print_r($image_list);die;
                                                $new_image_list = '';
                                                @unlink('../pageF/big_img/'.$rowF);
                                                @unlink('../pageF/'.$rowF);
                                            }
                                            
                                        }
                                        
                                        //echo "<script>alert('".$del_id."');</script>";
                                        //$query="delete from product where product_id=".$del_id;
                                        $con->selectdb("delete from `tbl_page` where page_id=".$del_id);
                                    }
                                        echo "<script>window.open('pageView.php','_SELF')</script>";
                                    }
                                ?>
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="page.php?parentid=<?php echo $parentid; ?>" class="btn btn-success m-b-sm mt-2 mb-2">Add Information</a>
                                            <a href="sorting_page.php" class="btn btn-success m-b-sm mt-2 mb-2">Sorting</a>
                                            <input type="submit" class="btn btn-danger m-b-sm mt-2 mb-2"name="delete" value="delete"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Copy</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th><input type="checkbox" id="checkall" class="checkall" name="sample"/> Select all</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Copy</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </tfoot>


                                        <tbody>
                                        <?php
                                    if (mysqli_num_rows($result) > 0) 
                                    {
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                            extract($row);
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="chkbox[]" id="chkbox" class="chkbox"  value="<?echo $page_id?>"/></td>
                                            <td><?php echo $page_id ?></td>
                                            <td><a href="pageView.php?parentid=<?php echo $page_id; ?>"><?php echo $page_name; ?></a></td>
                                            <td>
                                            <a href='page_copy.php?id=<?php echo $page_id ?>&page=<? echo isset($_GET['page']);?>'><i class="fa fa-copy"></i></a>
                                            
                                            </td>
                                            <td><a href='page.php?page_id=<?php echo $page_id; ?>&page=<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>'><i class="fa fa-edit"></i></a></td>
                                            <td><a href='page_upload.php?Del=del&page_id=<?php echo $page_id; ?>&page=<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>' onClick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a></td>
                                            
                                        </tr>
                                        <? } } ?>
                                        <input type="hidden" name="page" id="page" value="<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>">

                                    
                                        </tbody>

                                    </table>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End page -->


    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- third party js -->
    <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
    <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables/buttons.print.min.js"></script>
    <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables/dataTables.select.min.js"></script>
    <script src="assets/libs/pdfmake/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
</body>

</html>
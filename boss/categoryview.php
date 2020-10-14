<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
if ($_SESSION['control'] != "admin") {
    header("location:login.php");
}
include_once("../connect.php");
include_once("../navigationfun.php");
$cn = new connect();
$cn->connectdb();
$page_id=32;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Finmasters</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css -->
       <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
       <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
       <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
       <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
       <!-- third party css end -->
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

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
                    <h4 class="page-title-main">Category</h4>
                </li>
            </ul>
        </div>
        <!-- end Topbar -->
        <?php
        include 'menu.php';
        ?>

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
                                <button id="addCategoryButton" class="btn btn-primary width-md">Add Category</button>
                                <br><br>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>Name</th>
                                              <th>Edit</th>
                                              <th>Delete</th>
                                          </tr>
                                      </thead>
                                      <tfoot>
                                          <tr>
                                             <th>ID</th>
                                              <th>Name</th>
                                              <th>Edit</th>
                                              <th>Delete</th>
                                          </tr>
                                      </tfoot>
                                      <tbody>
                                          <?php
                                          $sql = "SELECT * FROM tbl_cat where cat_parent_id =".$_GET['cat_id'];
                                          $result = $cn->selectdb($sql);
                                          if ($cn->numRows($result) > 0) {
                                              while ($row = $cn->fetchAssoc($result)) {
                                          ?>
                                                  <tr>
                                                      <td><?php echo $row['cat_id']; ?></td>
                                                      <td><a href="categoryview.php?cat_id=<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></a></td>
                                                      <td><a onClick="editCategory('<?php echo $row['cat_id']; ?>','<?php echo $row['cat_name']; ?>')"><i class="mdi mdi-border-color"></i></a></td>
                                                      <td><a onClick="deleteRecord(<?php echo $row['cat_id']; ?>)"><i class="mdi mdi-delete"></i></a></td>
                                                  </tr>
                                          <?php
                                              }
                                          }
                                          else
                                          {
                                              ?>
                                              <tr>
                                                      <td colspan="4">No Categories Added..!</td>
                                              </tr>
                                              <?
                                          }
                                          ?>
                                      </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div> <!-- container-fluid -->
            </div> <!-- content -->
            <div id="AddCategoryModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Category</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                        </div>
                        <div class="modal-body" id="AddCategoryModalBody">
                            <form id="AddCategoryForm" method="post">
                            <table class="table table-striped">
                                <tbody>
                                        <tr>
                                        <td><input type="hidden" name="cat_id" id="AddCategory_cat_id" value="<? echo $_GET['cat_id'] ?>"/>
                                        Category Name:
                                       </td> 
                                        <td><input type="text" name="txtCatName" id="txtCatName" class="form-control fctrl" placeholder="Category Name" required></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2"><input type="submit" name="btnAdd" id="btnAdd" class="btn btn-icon waves-effect waves-light btn-primary" value="Add Category">&nbsp;&nbsp;<label id="lblmessage" style="font-weight:bold;color:green;"></label></td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="EditCategoryModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Category</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                        </div>
                        <div class="modal-body" id="EditCategoryModalBody">
                            <form id="EditCategoryForm" method="post">
                            <table class="table table-striped">
                                <tbody>
                                        <tr>
                                        <td><input type="hidden" name="cat_id" id="EditCategory_cat_id" value="0"/>
                                        Category Name:
                                       </td> 
                                        <td><input type="text" name="txtCatName" id="txtEditCatName" class="form-control fctrl" placeholder="Category Name" required></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2"><input type="submit" name="btnEdit" id="btnAdd" class="btn btn-icon waves-effect waves-light btn-primary" value="Save Changes">&nbsp;&nbsp;<label id="lblEditmessage" style="font-weight:bold;color:green;"></label></td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include 'footer.php';
            ?>

            <!-- Vendor js -->
            <script src="assets/js/vendor.min.js"></script>
            <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
            <script src="assets/js/pages/sweet-alerts.init.js"></script>
            <!-- third party js -->
            <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
            <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
            <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
            <!-- third party js ends -->

            <!-- App js -->
            <script src="assets/js/app.min.js"></script>
            <!-- modal window-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="assets/css/modal.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<!-- end of modal window-->
            <script>
                $(document).ready(function() {
                    $('#datatable').DataTable({
                       order: ['0', 'DESC']
                    });
                });
                $("#addCategoryButton").on("click",function(){
                    $("#AddCategoryModal").modal("show");
                    $("#AddCategoryModal").css("opacity","1");
                });
                $("#AddCategoryForm").on("submit",function(event){
                    event.preventDefault();
                    var cat_id = $("#AddCategory_cat_id").val();
                    $.ajax({
                        url:"categoryOperation.php?task=addCategory",
                        method:"POST",
                        data:$("#AddCategoryForm").serialize(),
                        success:function(data){
                           if(data == "")
                           {
                            // $("#AddCategoryModal").modal("hide");
                            // $("#AddCategoryModal").css("opacity","1");
                              $("#lblmessage").html("Category Added Successfully. You are redirecting...");
                              setTimeout(() => {
                                window.location.href = "categoryview.php?cat_id="+cat_id;
                              }, 1000);
                              
                           }
                        }
                    });
                });
                function editCategory(cat_id,cat_name)
                {
                    $("#EditCategory_cat_id").val(cat_id);
                    $("#txtEditCatName").val(cat_name);
                    $("#EditCategoryModal").modal("show");
                    $("#EditCategoryModal").css("opacity","1");
                }
                $("#EditCategoryForm").on("submit",function(event){
                    event.preventDefault();
                    var cat_id = $("#EditCategory_cat_id").val();
                    var cat_parent_id = $("#AddCategory_cat_id").val();
                    $.ajax({
                        url:"categoryOperation.php?task=updateCategory",
                        method:"POST",
                        data:$("#EditCategoryForm").serialize(),
                        success:function(data){
                           if(data == "")
                           {
                            // $("#AddCategoryModal").modal("hide");
                            // $("#AddCategoryModal").css("opacity","1");
                              $("#lblEditmessage").html("Category Updated Successfully. You are redirecting...");
                              setTimeout(() => {
                                window.location.href = "categoryview.php?cat_id="+cat_parent_id;
                              }, 1000);
                              
                           }
                        }
                    });
                });
                function deleteRecord(id) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        confirmButtonClass: "btn btn-success mt-2",
                        cancelButtonClass: "btn btn-danger ml-2 mt-2",
                        buttonsStyling: !1
                    }).then(function(t) {
                        if (t.value) {
                            var cat_id = $("#AddCategory_cat_id").val();
                            $.ajax({
                                url:"categoryOperation.php?task=deleteCategory&cat_id="+id,
                                method:"GET",
                                success:function(data){
                                if(data == "")
                                {
                                    // $("#AddCategoryModal").modal("hide");
                                    // $("#AddCategoryModal").css("opacity","1");
                                    setTimeout(() => {
                                        window.location.href = "categoryview.php?cat_id="+cat_id;
                                    }, 1000);
                                    
                                }
                                }
                            });
                        } else if (t.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: "Cancelled",
                                type: "error"
                            });
                        }
                    });
                }
            </script>
</body>

</html>

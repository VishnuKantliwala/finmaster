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
$page_id=27;
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
                    <h4 class="page-title-main">Purchase View</h4>
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
                                <a href="purchase.php" class="btn btn-primary width-md">Add</a>
                                <br><br>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                      <thead>
                                          <tr>
                                              <th>Purchase ID</th>
                                              <th>Expense Name</th>
                                              <th>GST</th>
                                              <th>Amount</th>
                                              <th>Date/Time</th>
                                              <th>Edit</th>
                                              <th>Delete</th>
                                          </tr>
                                      </thead>
                                      <tfoot>
                                          <tr>
                                              <th>Purchase ID</th>
                                              <th>Expense Name</th>
                                              <th>GST</th>
                                              <th>Amount</th>
                                              <th>Date/Time</th>
                                              <th>Edit</th>
                                              <th>Delete</th>
                                          </tr>
                                      </tfoot>
                                      <tbody>
                                          <?php
                                          $sql = "SELECT p.*,e.expense_name FROM tbl_expense e,tbl_purchase p WHERE p.expense_id = e.expense_id ORDER BY p.purchase_id DESC";
                                          $result = $cn->selectdb($sql);
                                          if ($cn->numRows($result) > 0) {
                                              while ($row = $cn->fetchAssoc($result)) {
                                          ?>
                                                  <tr>
                                                      <td><?php echo $row['purchase_id']; ?></td>
                                                      <td><?php echo $row['expense_name']=="Salary" ? $row['expense_name']." - ".$row["description"] : $row['expense_name']; ?></td>
                                                      <td><?php echo $row['isGST']==1 ? "YES - ".$row['gst_rate']."%": "NO"; ?></td>
                                                      <td><?php echo $row['amount']; ?></td>
                                                      <td><?php echo date("d-m-Y H:i:s",strtotime($row['entry_date_time'])); ?></td>
                                                      <td><a href="purchaseUpdate.php?purchase_id=<?php echo $row['purchase_id']; ?>"><i class="mdi mdi-border-color"></i></a></td>
                                                      <td><a onClick="deleteRecord(<?php echo $row['purchase_id']; ?>)"><i class="mdi mdi-delete"></i></a></td>
                                                  </tr>
                                          <?php
                                              }
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
            <script>
                $(document).ready(function() {
                    $('#datatable').DataTable({
                       order: ['0', 'DESC']
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
                            $.ajax({
                                type: "POST",
                                async: false,
                                url: "expensedelete.php",
                                data: 'expense_id=' + id,
                                success: function(data) {
                                    if (data == 'true') {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Your record has been deleted.",
                                            type: "success"
                                        }).then(function(){
                                          window.open('expenseview.php', '_self');
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Something went to wrong!",
                                            type: "error"
                                        });
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

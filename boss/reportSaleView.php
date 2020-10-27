<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
if ($_SESSION['control'] != "admin") {
    header("location:login.php");
}
include_once("../connect.php");
$cn = new connect();
$cn->connectdb();

?>
<html>
<head>
    <title>Finmaster - Sales Report</title>
    <style type="text/css">
    @media print {
        tr.vendorListHeading {
            background-color: #1a4567 !important;
            -webkit-print-color-adjust: exact;
        }
    }

    @media print {
        .vendorListHeading th {
            color: white !important;
        }
    }
    </style>
    <style media="print">
    @page {
        size: auto;
        margin: 0;
    }
    </style>
    <style>
    body {
        height: 1035px;
        width: 720px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        font-family: 'arial', sans-serif;
    }

    table,
    th,
    td {
        border-collapse: collapse;

        font-size: 14px;
        font-family: 'arial', sans-serif;
    }

    .style3 {
        font-size: 16px;
        font-weight: bold;
    }

    .style4 {
        font-size: 10px
    }

    .style5 {
        font-weight: bold
    }

    .style6 {
        font-size: 12px;
        font-weight: bold;
    }
    </style>
    <style type="text/css">
    table {
        page-break-inside: auto
        
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto
    }

    thead {
        display: table-header-group
    }

    tfoot {
        display: table-footer-group
    }

    .noborder {
        border: 0px;
    }
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
<body >
<div style="display: inline-flex;width: 100%;padding-bottom: 5px;">
    <div style="text-align:left;width: 50%;">
        <img src="assets/images/logo-dark.png" alt="" style="height: 30px;">
    </div>
    <div style="text-align:right;font-weight:bold;font-size: 15px;width: 50%;margin-top: 10px;">Date : 27-10-2020</div>
</div>
    <?
    if($_GET["task"] == "ClientWise" || $_GET["task"] == "DateWise")
    {
        $shipperFiler = "";
        if(isset($_GET["client_id"]))
        {
            if($_GET["client_id"] != "AllClients")
            {
                $shipperFiler = "where shipper_id = ".$_GET["client_id"];
            }
            else
                $label = "SALES REPORT OF ALL CLIENTS";
        }
        $DateFiler = "";
        if($_GET["task"] == "DateWise")
        {
            $FromDate = date('Y-m-d',strtotime($_GET['FromDate']));
            $ToDate = date('Y-m-d',strtotime($_GET['ToDate']." +1 Day"));
            $DateFiler = " AND si.entry_date BETWEEN '".$FromDate."' AND '".$ToDate."'";
            $label = "SALES REPORT OF DATES BETWEEN ".date('d-m-Y',strtotime($_GET['FromDate']))." AND ".date('d-m-Y',strtotime($_GET['ToDate']));
        }
    ?>
    <h3 style="text-align:center;"><? echo $label; ?></h3>
    
    <table style="width:100%;" border="1">
        <tr>
            <th style="text-align:center;">Service</th>
            <th style="text-align:center;">Entry Date</th>
            <th style="text-align:center;">Entry Person</th>
            <th style="text-align:center;">Duration</th>
            <th style="text-align:center;">Quantity</th>
            <th style="text-align:center;">GST Amount</th>
            <th style="text-align:center;">Total Amount</th>
        </tr>
        <?
        $flag = false;
        $sqlClients = $cn->selectdb("SELECT shipper_name,shipper_id FROM tbl_shipper ".$shipperFiler);
        if($cn->numRows($sqlClients) > 0)
        {
            $Total_gst_charge = 0;
            $Total_total_amount = 0;
            while($rowClients = $cn->fetchAssoc($sqlClients))
            {
                $sql = $cn->selectdb("SELECT p.`name`,si.*,u.user_name,s.shipper_name FROM tbl_product p,tbl_service_inclusion si,tbl_user u,tbl_service_confirmation sc,tbl_shipper s WHERE si.product_id = p.product_id AND si.entry_person_id = u.user_id AND sc.service_confirmation_id = si.service_confirmation_id AND s.shipper_id = sc.shipper_id AND sc.shipper_id =".$rowClients["shipper_id"]." ".$DateFiler." GROUP BY si.service_inclusion_id");
                if($cn->numRows($sql) > 0)
                {
                    $flag = true;
                    $gst_charge = 0;
                    $total_amount = 0;
                    ?>
                    <tr>
                        <th colspan="7" style="text-align:left;">Client Name : <? echo $rowClients["shipper_name"]; ?></th>
                    </tr>
                    <?
                    while($row = $cn->fetchAssoc($sql))
                    {
                        $gst_charge = $gst_charge + $row["gst_charge"];
                        $total_amount = $total_amount + $row["total_amount"];
                ?>
                <tr>
                    <td><? echo $row["name"]; ?></td>
                    <td><? echo $row["entry_date"] > 0 ? date("d-m-Y h:i:s",strtotime($row["entry_date"])) : "DATE NOT SET..!"; ?></td>
                    <td><? echo $row["user_name"]; ?></td>
                    <td><? echo $row["duration"]." ".$row["yorm"]; ?></td>
                    <td><? echo $row["quantity"]; ?></td>
                    <td><? echo number_format($row["gst_charge"],2); ?></td>
                    <td><? echo number_format($row["total_amount"],2); ?></td>
                </tr>
                <?
                    }
                    ?>
                    <tr>
                        <td colspan="5" style="font-weight:bold;">Total--</td>
                        <td style="font-weight:bold;"><? echo number_format($gst_charge,2); ?></td>
                        <td style="font-weight:bold;"><? echo number_format($total_amount,2); ?></td>
                    </tr>
                    <?
                    $Total_gst_charge = $Total_gst_charge + $gst_charge;
                    $Total_total_amount = $Total_total_amount + $total_amount;
                }
            }
            if($flag)
            {
            ?>
            <tr>
                <td colspan="5" style="font-weight:bold;">Total--</td>
                <td style="font-weight:bold;"><? echo number_format($Total_gst_charge,2); ?></td>
                <td style="font-weight:bold;"><? echo number_format($Total_total_amount,2); ?></td>
            </tr>
            <?
            }
            else
            {
            ?>
            <tr>
                <td colspan="7" style="font-weight:bold;">NO RECORDS--</td>
            </tr>
            <?
            }
        }
        ?>
    </table>
    <? } ?>
    <?
    if($_GET["task"] == "ServiceWise")
    {
        $label = "SALES REPORT SERVICE WISE";
    ?>
    <h3 style="text-align:center;"><? echo $label; ?></h3>
    
    <table style="width:100%;" border="1">
        <tr>
            <th style="text-align:center;">Client Name</th>
            <th style="text-align:center;">Entry Date</th>
            <th style="text-align:center;">Entry Person</th>
            <th style="text-align:center;">Duration</th>
            <th style="text-align:center;">Quantity</th>
            <th style="text-align:center;">GST Amount</th>
            <th style="text-align:center;">Total Amount</th>
        </tr>
        <?
        $serviceFiler = $_GET["service_id"];
        $flag = false;
        $sqlService = $cn->selectdb("SELECT `name`,product_id FROM tbl_product where product_id =".$serviceFiler);
        if($cn->numRows($sqlService) > 0)
        {
            $Total_gst_charge = 0;
            $Total_total_amount = 0;
            while($rowService = $cn->fetchAssoc($sqlService))
            {
                $sql = $cn->selectdb("SELECT si.*,u.user_name,s.shipper_name FROM tbl_product p,tbl_service_inclusion si,tbl_user u,tbl_service_confirmation sc,tbl_shipper s WHERE si.product_id = p.product_id AND si.entry_person_id = u.user_id AND sc.service_confirmation_id = si.service_confirmation_id AND s.shipper_id = sc.shipper_id AND si.product_id =".$rowService["product_id"]." GROUP BY si.service_inclusion_id");
                if($cn->numRows($sql) > 0)
                {
                    $flag = true;
                    $gst_charge = 0;
                    $total_amount = 0;
                    ?>
                    <tr>
                        <th colspan="7" style="text-align:left;">Service Name : <? echo $rowService["name"]; ?></th>
                    </tr>
                    <?
                    while($row = $cn->fetchAssoc($sql))
                    {
                        $gst_charge = $gst_charge + $row["gst_charge"];
                        $total_amount = $total_amount + $row["total_amount"];
                ?>
                <tr>
                    <td><? echo $row["shipper_name"]; ?></td>
                    <td><? echo $row["entry_date"] > 0 ? date("d-m-Y h:i:s",strtotime($row["entry_date"])) : "DATE NOT SET..!"; ?></td>
                    <td><? echo $row["user_name"]; ?></td>
                    <td><? echo $row["duration"]." ".$row["yorm"]; ?></td>
                    <td><? echo $row["quantity"]; ?></td>
                    <td><? echo number_format($row["gst_charge"],2); ?></td>
                    <td><? echo number_format($row["total_amount"],2); ?></td>
                </tr>
                <?
                    }
                    ?>
                    <tr>
                        <td colspan="5" style="font-weight:bold;">Total--</td>
                        <td style="font-weight:bold;"><? echo number_format($gst_charge,2); ?></td>
                        <td style="font-weight:bold;"><? echo number_format($total_amount,2); ?></td>
                    </tr>
                    <?
                    $Total_gst_charge = $Total_gst_charge + $gst_charge;
                    $Total_total_amount = $Total_total_amount + $total_amount;
                }
            }
            if($flag == false)
            {
            ?>
            <tr>
                <td colspan="7" style="font-weight:bold;">NO RECORDS--</td>
            </tr>
            <?
            }
        }
        ?>
    </table>
    <? } ?>
    
</body>
</html>
<?
session_start();
include_once('../connect.php');
$cn=new connect();
$cn->connectdb();
function secondsToTime($seconds) {
    $t = round($seconds);
    return sprintf('%02d Hours, %02d Min, %02d Secs', ($t/3600),($t/60%60), $t%60);
}
if($_GET['type'] == "ClientWise" || $_GET['type'] == "DateWise" || $_GET['type'] == "ServiceWise")
{
    if($_GET['type'] == "ClientWise")
    {  
        $filter = "";
        if(!isset($_POST['allClients']))
        {
            $client_id = $_POST["txtShipper"];
            $filter = "AND sc.shipper_id =".$client_id;
        }
                
        $sql = $cn->selectdb("SELECT p.`name`,si.*,u.user_name,s.shipper_name FROM tbl_product p,tbl_service_inclusion si,tbl_user u,tbl_service_confirmation sc,tbl_shipper s WHERE si.product_id = p.product_id AND si.entry_person_id = u.user_id AND sc.service_confirmation_id = si.service_confirmation_id AND s.shipper_id = sc.shipper_id ".$filter." GROUP BY si.service_inclusion_id");
    }
    else if($_GET['type'] == "DateWise")
    {
        $FromDate = date('Y-m-d',strtotime($_POST['FromDate']));
        $ToDate = date('Y-m-d',strtotime($_POST['ToDate']." +1 Day"));
        $sql = $cn->selectdb("SELECT p.`name`,si.*,u.user_name,s.shipper_name FROM tbl_product p,tbl_service_inclusion si,tbl_user u,tbl_service_confirmation sc,tbl_shipper s WHERE si.product_id = p.product_id AND si.entry_person_id = u.user_id AND s.shipper_id = sc.shipper_id AND sc.service_confirmation_id = si.service_confirmation_id AND si.entry_date BETWEEN '".$FromDate."' AND '".$ToDate."' GROUP BY si.service_inclusion_id");
    }
    else if($_GET['type'] == "ServiceWise")
    {
        $service_id = $_POST["txtService"];
        $sql = $cn->selectdb("SELECT p.`name`,si.*,u.user_name,s.shipper_name FROM tbl_product p,tbl_service_inclusion si,tbl_user u,tbl_service_confirmation sc,tbl_shipper s WHERE si.product_id = p.product_id AND si.entry_person_id = u.user_id AND s.shipper_id = sc.shipper_id AND sc.service_confirmation_id = si.service_confirmation_id AND si.product_id = ".$service_id." GROUP BY si.service_inclusion_id");
   }
    if($cn->numRows($sql) > 0)
    {
        $array = array();
        $i = 0;
        while($row = $cn->fetchAssoc($sql))
        {
            $array[$i]["shipper_name"] = $row["shipper_name"];
            if($_GET['type'] != "ServiceWise")
            {
                $array[$i]["service_name"] = $row["name"];
            }
            $array[$i]["user_name"] = $row["user_name"];
            if($row["invoice_id"] != 0)
                $invoice_type = "Invoice";
            else if($row["cash_id"] != 0)
                $invoice_type = "Cash";
            else if($row["proforma_id"] != 0)
                $invoice_type = "Proforma";
            else
                $invoice_type = "Not Generated..!";
            $array[$i]["invoice_type"] = $invoice_type;
            $array[$i]["entry_person"] = $row["user_name"];
            $array[$i]["entry_date"] = $row["entry_date"] > 0 ? date("d-m-Y h:i:s",strtotime($row["entry_date"])) : "DATE NOT SET..!";
            $array[$i]["duration"] = $row["duration"]." ".$row["yorm"];
            $array[$i]["quantity"] = $row["quantity"];
            $array[$i]["total_amount"] = $row["total_amount"];
            $i++;
        }
        echo json_encode($array);
    }
    else
    {
        echo "0";
    }
}
?>
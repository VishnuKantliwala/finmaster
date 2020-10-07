<?
session_start();
include_once('../connect.php');
$cn=new connect();
$cn->connectdb();
if($_GET['type'] == "ClientWise" || $_GET['type'] == "DateWise")
{
    if($_GET['type'] == "ClientWise")
    {
        if(isset($_POST['chkCompany']))
        {
            $sql = $cn->selectdb("SELECT s.shipper_name,s.shipper_phone1,s.shipper_email,a.attendant_name,i.* FROM tbl_inquiry i,tbl_shipper s,tbl_attendant a WHERE i.shipper_id = s.shipper_id AND i.attendant_id = a.attendant_id");
        }
        else
        {
             $sql = $cn->selectdb("SELECT s.shipper_name,s.shipper_phone1,s.shipper_email,a.attendant_name,i.* FROM tbl_inquiry i,tbl_shipper s,tbl_attendant a WHERE i.shipper_id = s.shipper_id AND i.attendant_id = a.attendant_id AND i.shipper_id = ".$_POST['txtInquiryID']);
        }
    }
    else if($_GET['type'] == "DateWise")
    {
        $FromDate = date('Y-m-d',strtotime($_POST['FromDate']));//date('Y-m-d',strtotime("2020-10-07"));
        $ToDate = date('Y-m-d',strtotime($_POST['ToDate']." +1 Day"));//date('Y-m-d',strtotime("2020-10-07"));//
        $sql = $cn->selectdb("SELECT s.shipper_name,s.shipper_phone1,s.shipper_email,a.attendant_name,i.* FROM tbl_inquiry i,tbl_inquiry_detail id,tbl_shipper s,tbl_attendant a WHERE i.shipper_id = s.shipper_id AND i.attendant_id = a.attendant_id AND id.inquiry_id = i.inquiry_id AND id.inquiry_stime BETWEEN '".$FromDate."' AND '".$ToDate."' GROUP BY i.inquiry_id");
        //echo "SELECT s.shipper_name,s.shipper_phone1,s.shipper_email,a.attendant_name,i.* FROM tbl_inquiry i,tbl_inquiry_detail id,tbl_shipper s,tbl_attendant a WHERE i.shipper_id = s.shipper_id AND i.attendant_id = a.attendant_id AND id.inquiry_id = i.inquiry_id AND id.inquiry_stime BETWEEN '".$FromDate."' AND '".$ToDate."'";
    }
    if($cn->numRows($sql) > 0)
    {
        $array = array();
        $i = 0;
        while($row = $cn->fetchAssoc($sql))
        {
            $array[$i]["shipper_name"] = $row["shipper_name"];
            $array[$i]["shipper_phone1"] = $row["shipper_phone1"];
            $array[$i]["shipper_email"] = $row["shipper_email"];
            $array[$i]["attendant_name"] = $row["attendant_name"];
            $array[$i]["inquiry_id"] = $row["inquiry_id"];
            $array[$i]["attendant_id"] = $row["attendant_id"];
            $array[$i]["shipper_id"] = $row["shipper_id"];
            if($row["inquiry_status"] == "0")
                $status = "Pending";
            else if($row["inquiry_status"] == "1")
                $status = "Success";
            else if($row["inquiry_status"] == "2")
                $status = "Unsuccess";
            else
                $status = "";
            $array[$i]["inquiry_status"] = $status;
            $i++;
        }
        echo json_encode($array);
    }
    else
    {
        echo "0";
    }
}
if($_GET['type'] == "FollowUps")
{
    $inquiry_id = $_GET['inquiry_id'];
    if($_GET["Form"] == "ClientWise")
    {
        $sql = $cn->selectdb("SELECT id.*,u.user_name,s.shipper_name,s.shipper_id FROM tbl_inquiry_detail id,tbl_user u,tbl_shipper s,tbl_inquiry i WHERE id.inquiry_id = i.inquiry_id AND s.shipper_id = i.shipper_id AND id.entry_person_id = u.user_id AND id.inquiry_id =".$inquiry_id);
    }
    else if($_GET["Form"] == "DateWise")
    {
        $FromDate = date('Y-m-d',strtotime($_POST['FromDate']));//date('Y-m-d',strtotime("2020-10-07"));
        $ToDate = date('Y-m-d',strtotime($_POST['ToDate']." +1 Day"));//date('Y-m-d',strtotime("2020-10-07"));//
        $sql = $cn->selectdb("SELECT id.*,u.user_name,s.shipper_name,s.shipper_id FROM tbl_inquiry_detail id,tbl_user u,tbl_shipper s,tbl_inquiry i WHERE id.inquiry_id = i.inquiry_id AND s.shipper_id = i.shipper_id AND id.entry_person_id = u.user_id AND id.inquiry_stime BETWEEN '".$FromDate."' AND '".$ToDate."' AND id.inquiry_id =".$inquiry_id);
    }
    if($cn->numRows($sql) > 0)
    {
        $array = array();
        $i = 0;
        while($row = $cn->fetchAssoc($sql))
        {
            $array[$i]["shipper_id"] = $row["shipper_id"];
            $array[$i]["shipper_name"] = $row["shipper_name"];
            $array[$i]["inquiry_detail_id"] = $row["inquiry_detail_id"];
            $array[$i]["inquiry_id"] = $row["inquiry_id"];
            $array[$i]["description"] = $row["description"];
            $array[$i]["meeting_document"] = $row["meeting_document"];
            $array[$i]["inquiry_stime"] = date("d-m-Y h:i A",strtotime($row["inquiry_stime"]));
            $array[$i]["inquiry_etime"] = date("d-m-Y h:i A",strtotime($row["inquiry_etime"]));
            $array[$i]["entry_date"] = date("d-m-Y",strtotime($row["entry_date"]));
            $array[$i]["status"] = $row["status"];
            $array[$i]["user_name"] = $row["user_name"];
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
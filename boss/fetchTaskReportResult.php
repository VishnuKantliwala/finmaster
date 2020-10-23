<?
session_start();
include_once('../connect.php');
$cn=new connect();
$cn->connectdb();
function secondsToTime($seconds) {
    $t = round($seconds);
    return sprintf('%02d Hours, %02d Min, %02d Secs', ($t/3600),($t/60%60), $t%60);
}
if($_GET['type'] == "EmployeeWise" || $_GET['type'] == "DateWiseEmpTaskForm")
{
    if($_GET['type'] == "EmployeeWise")
    {  
        $emp_id = $_POST["txtEmp"];
        $sql = $cn->selectdb("SELECT t.task_name,s.shipper_name,te.date_assign,te.date_accept,te.date_submit,te.task_emp_status,te.task_emp_duration,te.task_emp_expected_time,te.task_emp_quantity,te.task_emp_quantity_done FROM tbl_product p,tbl_shipper s,tbl_task_emp te,tbl_task t WHERE te.task_id = t.task_id AND t.shipper_id = s.shipper_id AND te.user_id =".$emp_id." GROUP BY te.task_emp_id");
    }
    else if($_GET['type'] == "DateWiseEmpTaskForm")
    {
        $FromDate = date('Y-m-d',strtotime($_POST['FromDate']));//date('Y-m-d',strtotime("2020-10-07"));
        $ToDate = date('Y-m-d',strtotime($_POST['ToDate']." +1 Day"));//date('Y-m-d',strtotime("2020-10-07"));//
        $sql = $cn->selectdb("SELECT t.task_name,s.shipper_name,te.date_assign,te.date_accept,te.date_submit,te.task_emp_status,te.task_emp_duration,te.task_emp_expected_time,te.task_emp_quantity,te.task_emp_quantity_done,u.user_name FROM tbl_product p,tbl_shipper s,tbl_task_emp te,tbl_task t,tbl_user u WHERE te.user_id = u.user_id AND te.task_id = t.task_id AND t.shipper_id = s.shipper_id AND te.date_assign BETWEEN '".$FromDate."' AND '".$ToDate."' GROUP BY te.task_emp_id");
        //echo "SELECT s.shipper_name,s.shipper_phone1,s.shipper_email,a.attendant_name,i.* FROM tbl_inquiry i,tbl_inquiry_detail id,tbl_shipper s,tbl_attendant a WHERE i.shipper_id = s.shipper_id AND i.attendant_id = a.attendant_id AND id.inquiry_id = i.inquiry_id AND id.inquiry_stime BETWEEN '".$FromDate."' AND '".$ToDate."'";
    }
    if($cn->numRows($sql) > 0)
    {
        $array = array();
        $i = 0;
        while($row = $cn->fetchAssoc($sql))
        {
            if($_GET['type'] == "DateWiseEmpTaskForm")
            {
                $array[$i]["emp_name"] = $row["user_name"];
            }
            $array[$i]["task_name"] = $row["task_name"];
            $array[$i]["shipper_name"] = $row["shipper_name"];
            $array[$i]["date_assign"] = $row["date_assign"] > 0 ? date("d-m-Y h:i:s",strtotime($row["date_assign"])) : "DATE NOT SET..!";
            $array[$i]["date_accept"] = $row["date_accept"] > 0 ? date("d-m-Y h:i:s",strtotime($row["date_accept"])) : "NOT ACCEPTED YET..!";
            $array[$i]["date_submit"] = $row["date_submit"] > 0 ? date("d-m-Y h:i:s",strtotime($row["date_submit"])) : "NOT SUBMITTED YET..!";
            $status = "";
            if($row["task_emp_status"] == 0)
            {
                $status = "Assigned";
            }
            if($row["task_emp_status"] == 1)
            {
                $status = "Working";
            }
            if($row["task_emp_status"] == 2)
            {
                $status = "Submitted";
            }
            if($row["task_emp_status"] == 3)
            {
                $status = "Reappointed";
            }
            $array[$i]["task_emp_status"] = $status;
            $array[$i]["task_emp_duration"] = secondsToTime($row['task_emp_duration']);
            $array[$i]["task_emp_expected_time"] = secondsToTime($row['task_emp_expected_time']);
            $array[$i]["task_emp_quantity"] = $row["task_emp_quantity"];
            $array[$i]["task_emp_quantity_done"] = $row["task_emp_quantity_done"];
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
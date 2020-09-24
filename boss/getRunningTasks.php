<?
include_once('../connect.php'); 
session_start();
$cn=new connect();
$cn->connectdb();

$filter = "";

function secondsToTime($seconds) {
    $t = round($seconds);
    return sprintf('%02d Hours, %02d Min, %02d Secs', ($t/3600),($t/60%60), $t%60);
    //return date("i",strtotime($seconds));
    //return $dtT->diff($dtT)->format('%a days, %h hours, %i minutes');
}


$qry = "SELECT t.*,te.*, u.user_id, u.user_name, s.shipper_name FROM tbl_task AS t, tbl_task_emp AS te, tbl_user u, tbl_shipper AS s WHERE t.task_id = te.task_id AND te.user_id = u.user_id AND s.shipper_id = t.shipper_id AND u.user_id = '".$_SESSION['user_id']."' AND task_emp_status = 1";

$sql = $cn->selectdb($qry);
//echo $qry;
if(mysqli_num_rows($sql) > 0)
{
    $i=0;
    $returnObj = array();
    while($row = mysqli_fetch_assoc($sql))
    {
        $returnObj[$i]["task_id"]=$row['task_id'];
        $returnObj[$i]["shipper_name"]=$row['shipper_name'];
        $returnObj[$i]["task_name"]=$row['task_name'];
        $returnObj[$i]["task_emp_quantity"]=$row['task_emp_quantity'];
        $returnObj[$i]["task_emp_quantity_done"]=$row['task_emp_quantity_done'];
        $returnObj[$i]["task_emp_repetition_duration"]=$row['task_emp_repetition_duration'];
        $returnObj[$i]["date_assign"]=$date = date("j F Y - h : m A",strtotime($row['date_assign']));
        $returnObj[$i]["task_emp_id"]=$row['task_emp_id'];       
        $returnObj[$i]["task_emp_running_status"]=$row['task_emp_running_status'];       
        $returnObj[$i]["time"]=secondsToTime($row['task_emp_duration']);       
        $i++;
    }
    echo json_encode($returnObj);
}
else
{
    echo "false";
}
?>
<?
include_once('../connect.php'); 
session_start();
$cn=new connect();
$cn->connectdb();

$filter = "";
$returnObj = array();
$task_id = $_POST['task_id'];



$qry = "SELECT user_name, user_id from tbl_user ORDER BY user_name";

$sql = $cn->selectdb($qry);
//echo $qry;
if(mysqli_num_rows($sql) > 0)
{
    $i=0;
    
    while($row = mysqli_fetch_assoc($sql))
    {
        // $sqlAlreadyTask = $cn->selectdb("SELECT task_emp_quantity, task_emp_repetation_duration FROM tbl_task_emp WHERE emp_id = '".$row['user_id']."' AND task_id = ".$task_id);

        $returnObj[$i]["user_id"]=$row['user_id'];
        $returnObj[$i]["user_name"]=$row['user_name'];
        // $returnObj[$i]["task_emp_quantity"]=$row['task_emp_quantity'];
        // $returnObj[$i]["task_emp_repetation_duration"]=$row['task_emp_repetation_duration'];
        
        $i++;
    }
    $qrySI = "SELECT si.duration, si.yorm,t.isFromServiceConfirmation from tbl_service_inclusion si,tbl_task t WHERE t.service_inclusion_id = si.service_inclusion_id AND t.task_id = ".$task_id." AND t.isFromServiceConfirmation = 1";
    $qrySI = $cn->selectdb($qrySI);
    //echo $qry;
    if(mysqli_num_rows($qrySI) > 0)
    {
        $rowSI = mysqli_fetch_assoc($qrySI);
        $returnObj[$i]["duration"]=$rowSI['duration'];
        $returnObj[$i]["yorm"]=$rowSI['yorm'];
        $returnObj[$i]["isFromServiceConfirmation"]=$rowSI['isFromServiceConfirmation'];
    }
    else
    {
        $returnObj[$i]["isFromServiceConfirmation"]=0;
    }
    echo json_encode($returnObj);
}
else
{
    echo "false";
}
?>
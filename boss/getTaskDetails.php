<?
include_once('../connect.php'); 
session_start();
$cn=new connect();
$cn->connectdb();

$filter = "";

$task_emp_id = $_POST['task_emp_id'];

$qry = "SELECT t.*,te.*, s.shipper_name FROM tbl_task AS t, tbl_task_emp AS te, tbl_shipper AS s WHERE t.task_id = te.task_id AND s.shipper_id = t.shipper_id AND te.task_emp_id=".$task_emp_id;

$sql = $cn->selectdb($qry);
//echo $qry;
if(mysqli_num_rows($sql) > 0)
{
    $i=0;
    
    $returnObj = array();
    while($row = mysqli_fetch_assoc($sql))
    {
        
        $returnObj[$i]["shipper_name"]=$row['shipper_name'];
        $returnObj[$i]["task_name"]=$row['task_name'];
        $returnObj[$i]["task_id"]=$row['task_id'];
        $returnObj[$i]["task_emp_id"]=$row['task_emp_id'];
        $returnObj[$i]["task_emp_description"]=$row['task_emp_description'];
        $returnObj[$i]["task_emp_quantity"]=$row['task_emp_quantity'];
        $returnObj[$i]["task_emp_quantity_done"]=$row['task_emp_quantity_done'];
        $returnObj[$i]["task_emp_repetition_duration"]=$row['task_emp_repetition_duration'];        
        $returnObj[$i]["date_assign"]=$date = date("j F Y - h : m",strtotime($row['date_assign']));

        $j=0;
        $sqlQty = $cn->selectdb( "SELECT `task_emp_status`, task_emp_qty FROM `tbl_task_emp_qty` WHERE task_emp_id=".$task_emp_id);
        if( $cn->numRows($sqlQty) > 0 )
        {
            while($rowQty = $cn->fetchAssoc($sqlQty))
            {
                $returnObj[$i]["task_emp_status"][$j] = $rowQty["task_emp_status"];
                $returnObj[$i]["task_emp_qty_id"][$j] = $rowQty["task_emp_qty"];
                $k=0;
                $qty_id = $rowQty['task_emp_qty'];
                $sqlSubQty = $cn->selectdb( "SELECT qs.`task_emp_qty_sub_id`,qs.`sub_product_id`, qs.`task_emp_sub_status`,sp.`sub_product_name` FROM `tbl_task_emp_qty_sub` qs,tbl_sub_product sp WHERE qs.sub_product_id = sp.sub_product_id AND qs.task_emp_qty_id=".$rowQty["task_emp_qty"]);
                
                if( $cn->numRows($sqlSubQty) > 0 )
                {
                    $returnObj[$i]["task_emp_qty_id"][$j] = array();
                    while($rowSubQty = $cn->fetchAssoc($sqlSubQty))
                    {
                        $returnObj[$i]["task_emp_qty_id"][$j][$qty_id][$k]['task_emp_qty_sub_id'] = $rowSubQty["task_emp_qty_sub_id"];
                        $returnObj[$i]["task_emp_qty_id"][$j][$qty_id][$k]['sub_product_id'] = $rowSubQty["sub_product_id"];
                        $returnObj[$i]["task_emp_qty_id"][$j][$qty_id][$k]['task_emp_sub_status'] = $rowSubQty["task_emp_sub_status"];
                        $returnObj[$i]["task_emp_qty_id"][$j][$qty_id][$k]['sub_product_name'] = $rowSubQty["sub_product_name"];
                        $k++;
                    }

                }

                $j++;
            }

        }

        $j=0;
        $returnObj[$i]["task_file"] = array();
        $sqlFiles = $cn->selectdb( "SELECT task_file_name FROM tbl_task_file WHERE task_id = ".$row['task_id'] );
        if( $cn->numRows($sqlFiles) > 0 )
        {
            while($rowFiles = $cn->fetchAssoc($sqlFiles))
            {
                $returnObj[$i]["task_file"][$j] = $rowFiles["task_file_name"];
                $j++;
            }
        }


        
        $i++;
    }
    echo json_encode($returnObj);
}
else
{
    echo "false";
}
?>

<?
session_start();
include_once("../connect.php");

$cn=new connect(); 
$cn->connectdb();

$task_id = $_POST['task_id'];
$task_quantity = $_POST['task_quantity'];
$task_emp_description = $_POST['task_emp_description'];

    $task_emp_quantity = 0;
    for($i=0;$i<count($_POST['user_id']);$i++)
    {
        $task_emp_quantity += $_POST['task_emp_quantity'][$i];
    }
    if($task_emp_quantity > $task_quantity)
    {
        display_error("Task is not assigned accourding to quantity.<br/> Quantity - ".$task_quantity.". Assigned - ".$task_emp_quantity);
        return;
    }

    for($i=0;$i<count($_POST['user_id']);$i++)
    {
        if($_POST['task_emp_quantity'][$i] != 0)
        {
            if( $_POST['total_reps'][$i] < 0 )
            {
                display_error("Total repetation should be greater than or equal to 0 for employee ". ($i+1));
                exit();
            }
            if( $_POST['expected_hours'][$i] < 1 )
            {
                display_error("Expected hours should be greater than 0 for employee ".($i+1));
                exit();
            }

            $user_id = $_POST['user_id'][$i];
            $task_emp_quantity = $_POST['task_emp_quantity'][$i];
            $task_emp_repetition_duration = $_POST['task_emp_repetition_duration'][$i];
            $date = date("Y-m-d h:i:s");
            $expected_time = $_POST['expected_hours'][$i] * 3600;
            $date_add_string = "";

            switch($task_emp_repetition_duration)
            {
                case "Year": { // for one time
                    $date_add_string = '+ 1 year';
                    break;
                }
                case "Month": {
                    $date_add_string = '+ 1 month';
                    break;
                }
            }

            if($_POST['total_reps'][$i] == "")
            {
                $_POST['total_reps'][$i] = 1;
            }

            for( $k = 0 ; $k < $_POST['total_reps'][$i] ; $k++ )
            {
                

                $cn->selectdb("INSERT INTO `tbl_task_emp`( `task_id`, `user_id`, `task_emp_quantity`, `task_emp_repetition_duration`, `task_emp_description`, `date_assign`,`task_emp_duration`,  `task_emp_status`, `task_emp_expected_time`) VALUES (".$task_id.",".$user_id.",".$task_emp_quantity.",'".$task_emp_repetition_duration."','".$task_emp_description."', '".$date."','0' ,0, '".$expected_time."')");

                $date = date("Y-m-d h:i:s", strtotime($date. $date_add_string));
                $lastID = mysqli_insert_id($cn->getConnection());

                for($j=0; $j<$task_emp_quantity ;$j++)
                {
                    $cn->selectdb("INSERT INTO `tbl_task_emp_qty`( `task_emp_id`, `task_emp_status`) VALUES ( ".$lastID.", 0 )");
                    $lastTaskEmpQtyID = mysqli_insert_id($cn->getConnection());
                    //GET ALL SUB SERVICES OF SELECTED SERVICE OF THIS TASK
                    $sqlSubTask = $cn->selectdb("SELECT sp.sub_product_id FROM tbl_sub_product sp,tbl_task t,tbl_service_inclusion si WHERE t.service_inclusion_id = si.service_inclusion_id AND si.product_id = sp.product_id AND t.task_id =".$task_id);
                    if($cn->numRows($sqlSubTask) > 0)
                    {
                        while($rowSubTask = $cn->fetchAssoc($sqlSubTask))
                        {
                            $cn->insertdb("INSERT INTO `tbl_task_emp_qty_sub`( `task_emp_qty_id`, `sub_product_id`, `task_emp_sub_status`) VALUES (".$lastTaskEmpQtyID.",".$rowSubTask['sub_product_id'].",'0')");
                        }
                    }
                }
                // $date = date_create($date); 
                // Use date_add() function to add date object 
                // date_add($date, date_interval_create_from_date_string($date_add_string)); 

                // $date = date_format( $date, "Y-m-d h:i:s" );
            }

            

            

        }
    }
     $cn->selectdb("UPDATE tbl_task SET task_status = 1, task_quantity_assigned=task_quantity_assigned+".$task_emp_quantity." WHERE task_id=".$task_id);
    // echo "INSERT INTO `tbl_task_emp_qty`( `task_emp_id`, `task_emp_status`) VALUES ( ".$lastID.", 0 )";
    // echo "UPDATE tbl_task SET task_status = 1, task_quantity_assigned=task_quantity_assigned+".$task_emp_quantity." WHERE task_id=".$task_id;
     display_success("Task Assigned Successfully!");


 
function display_error($error)
{
    echo '<div class="alert alert-warning"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$error.' </div>';
}
function display_success($message)
{
    echo '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$message.' </div>';
}
// echo "Account successfully updated";		
?>
<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebbok https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */

include_once("../connect.php");
include_once("../navigationfun.php");
$cn=new connect();
$cn->connectdb();
session_start();
$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 1;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;
$val = $_GET['val'];

if(isset($_GET['sdate']) && $_GET['sdate'] != "" && $_GET['edate'] != "")
{
	$parts = explode('-', $_GET['sdate']);
	$sdate  = "$parts[2]-$parts[1]-$parts[0]";
	$parts = explode('-', $_GET['edate']);
	$edate  = "$parts[2]-$parts[1]-$parts[0]";
	
	
	if($val=="")
	{
		
		$sql = $cn->selectdb("SELECT * FROM `tbl_document` d,`tbl_shipper` s,`tbl_product` p,`tbl_agent` a WHERE d.shipper_id = s.shipper_id and d.product_id = p.product_id and d.agent_id = a.agent_id  and d.current_date >= '".$sdate."' and d.current_date <= '".$edate."'    order by d.document_id  desc LIMIT $limit OFFSET $offset  ");
	}
	else
	{
		
		$sql = $cn->selectdb("SELECT * FROM `tbl_document` d,`tbl_shipper` s,`tbl_product` p,`tbl_agent` a WHERE d.shipper_id = s.shipper_id and d.product_id = p.product_id and d.agent_id = a.agent_id and (d.client_name Like '%".$val."%' or s.shipper_name  Like '%".$val."%' or a.agent_name Like '%".$val."%' or d.policy_no  Like '%".$val."%' or p.name  Like '%".$val."%' or d.entrypersonname Like '%".$val."%') and d.current_date >= '".$sdate."' and d.current_date <= '".$edate."'    order by d.document_id  desc LIMIT $limit OFFSET $offset  ");
	}
	
}
else if($val=="")
{
	
	$sql = $cn->selectdb("SELECT * FROM `tbl_document` d,`tbl_shipper` s,`tbl_product` p,`tbl_agent` a WHERE d.shipper_id = s.shipper_id and d.product_id = p.product_id and d.agent_id = a.agent_id order by d.document_id  desc LIMIT $limit OFFSET $offset  ");

}
else
{
	
	
		$sql = $cn->selectdb("SELECT * FROM `tbl_document` d,`tbl_shipper` s,`tbl_product` p,`tbl_agent` a WHERE d.shipper_id = s.shipper_id and d.product_id = p.product_id and d.agent_id = a.agent_id and (d.client_name Like '%".$val."%' or s.shipper_name  Like '%".$val."%' or a.agent_name Like '%".$val."%' or d.policy_no  Like '%".$val."%' or p.name  Like '%".$val."%' or d.entrypersonname Like '%".$val."%') order by d.document_id desc LIMIT $limit OFFSET $offset ");
	
}	

if (mysqli_num_rows($sql) > 0) 
{
$j = 0;

    while($row = mysqli_fetch_assoc($sql)) 
    {
        $j++;
        extract($row);
        $title = "Start Date  :-  ".$start_date;
        $title .= "\nEnd Date :- ".$end_date;
        $title .= "\nCustomer Name  :-  ".$shipper_name;
        $title .= "\nAgent Name  :-  ".$agent_name;
        $title .= "\nService  :-  ".$name;
        $title .= "\nPolicy No.  :-  ".$policy_no;
        
        if($_SESSION['control'] != "emp") 
        {
            $title .= "\nEntry Person  :-  ".$entrypersonname;
        }
												
?>

<tr title="<?echo $title?>">
    <? if($_SESSION['control'] != "emp") { ?>
    <td><input id="chkFile<?echo $j?>" type="checkbox" name="chkbox[]" value="<?echo $document_id ?>" /></td>
    <? } ?>
    <td><a href='documentUpdate.php?document_id=<?php echo $document_id ?>&page=<?  if (isset($_GET[' page']) &&
            !empty($_GET['page'])) echo $_GET['page'];?>&mode=o'><i class="fa fa-edit"></i></a></td>
    <!-- <td>
												<a href='product_copy.php?id=<?php echo $document_id ?>&page=<? echo isset($_GET['page']);?>'><i class="fa fa-copy"></i></a>
												
												</td>-->

    <? if($_SESSION['control'] != "emp") { ?>
    <td><a href='deletedocument.php?id=<?php echo $document_id ?>'
            onClick="return confirm('Are you sure want to delete?');"><i class="fa fa-trash"></i></a></td>
    <? } ?>
    <td>
        <? echo $current_date;?>
    </td>
    <td>
        <? echo $start_date;?>
    </td>
    <td>
        <? echo $end_date;?>
    </td>
    <td>
        <? echo $client_name;?>
    </td>
    <td>
        <? echo $shipper_name; ?>
    </td>
    <td>
        <? echo $agent_name; ?>
    </td>
    <td>
        <? echo $name; ?>
    </td>
    <td>
        <? echo $policy_no; ?>
    </td>
    <? if($_SESSION['control'] != "emp") { ?>
    <td>
        <? echo $entrypersonname; ?>
    </td>
    <? } ?>
</tr>
<? 
    } 
} 
?>

<input type="hidden" name="page" id="page"
    value="<?  if (isset($_GET['page']) && !empty($_GET['page'])) echo $_GET['page'];?>">
<script>
var a = 0;

$("tr").click(function() {
    a = a + 1;
    if (a % 2 == 0) {
        var selected = $(this).hasClass("selected");
        $("tr").removeClass("selected");
        if (!selected)
            $(this).addClass("selected");

        $("tr").removeClass("selected");
        if (!selected)
            $(this).addClass("selected");
        else {


            var selected = $(this).hasClass("selected");
            $("tr").removeClass("selected");
            if (!selected)
                $(this).addClass("selected");
        }
    }
});
</script>
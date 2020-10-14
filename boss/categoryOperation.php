<?
session_start();
include_once('../connect.php');
$cn=new connect();
$cn->connectdb();
if($_GET['task']=="addCategory")
{
    $cn->insertdb("INSERT INTO tbl_cat(cat_parent_id,cat_name,entry_person_id) VALUES(".$_POST['cat_id'].",'".$_POST['txtCatName']."',".$_SESSION["user_id"].")");
}
if($_GET['task']=="deleteCategory")
{
    $cat_id = $_GET['cat_id'];
    $cn->insertdb("DELETE FROM tbl_cat WHERE cat_id = ".$cat_id." OR cat_parent_id =".$cat_id);
}
if($_GET['task']=="updateCategory")
{
    $cn->insertdb("UPDATE tbl_cat SET cat_name = '".$_POST['txtCatName']."',entry_person_id=".$_SESSION["user_id"]." WHERE cat_id=".$_POST['cat_id']);
}
?>
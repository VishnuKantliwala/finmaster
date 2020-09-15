<?php  

include_once('../connect.php'); 
session_start();
$cn=new connect();
$cn->connectdb();
date_default_timezone_set('Asia/Kolkata');

class CategoryArray {
    public static $catArray = array();
    public $catArraySub = array();
    public $j=0;
    public $cn;
    function __construct()
    {
        $this->cn = new connect();
        $this->cn->connectdb();
    }
    
    //$this->cn->connectdb();
    public function getMenu()
    {   
        $sqlSub = $this->cn->selectdb("SELECT cat_id, cat_name FROM  `tbl_cat` where cat_parent_id=0");
        $i=0;
        if($this->cn->numRows($sqlSub)>0){	
            while($rowSub = $this->cn->fetchAssoc($sqlSub)){
                $catArray[$i] = array("cat_id" => $rowSub['cat_id'], "cat_name" =>  $rowSub['cat_name'], "sub_cat" => $this->getSubMenu($rowSub['cat_id']));
                $i++;
            }   
        }
        return $catArray;
    }

    public function getSubMenu($cat_id)
    {
        $catArraySub = array();
        $j = 0;
        $sqlCatSub = $this->cn->selectdb("SELECT cat_id, cat_name FROM  `tbl_cat` where cat_parent_id=".$cat_id);
        if($this->cn->numRows($sqlCatSub)>0){	
            $cArray = array();
            while($rowCatSub = $this->cn->fetchAssoc($sqlCatSub)){
                $cArray = $this->getSubMenu($rowCatSub['cat_id']);
                $catArraySub[$j] = array("cat_id" => $rowCatSub['cat_id'], "cat_name" =>  $rowCatSub['cat_name'], "sub_cat" => $cArray);
                $j++;
            }   
        }
        return $catArraySub;
    }
}





if($_GET['type'] == "fillTreeView")
{
    // static $catArray = array();
    $categoryArray = new CategoryArray();

    
    echo "<pre>";
     //echo json_encode( $categoryArray->getMenu( 0, 'parent id' ) );
    print_r( $categoryArray->getMenu() );
    echo "</pre>";

}

?>
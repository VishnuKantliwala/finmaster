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

    
   // echo "<pre>";
     echo json_encode( $categoryArray->getMenu() );
    //print_r( $categoryArray->getMenu() );
    //echo "</pre>";

}
if($_GET['type'] == "SaveBasicDetails")
{
    $date = date("Y-m-d");
    $shipper_id = $_POST['txtShipperID'];
    $document_year = $_POST['year'];
    $returnObj = array();
    $sqlDoc = $cn->selectdb("SELECT document_id FROM tbl_document WHERE shipper_id = ".$shipper_id);
    if($cn->numRows($sqlDoc) > 0)
    {
        $rowDoc = $cn->fetchAssoc($sqlDoc);
        $lastDocInsID = $rowDoc['document_id'];
    }
    else
    {
        $cn->insertdb("INSERT INTO tbl_document(`shipper_id`,`entry_date`,`status`) VALUES (".$shipper_id.",'".$date."',1)");
        $lastDocInsID = mysqli_insert_id($cn->getConnection());
    }
   $sqlYear = $cn->selectdb("SELECT document_year_id FROM tbl_document_year WHERE document_id =".$lastDocInsID." AND document_year = '".$document_year."'");
   if($cn->numRows($sqlYear) > 0)
   {
       $rowYear = $cn->fetchAssoc($sqlYear);
       $lastDocYearInsID = $rowYear['document_year_id'];
   }
   else
   {
       $cn->insertdb("INSERT INTO tbl_document_year(`document_id`,`document_year`,`status`) VALUES (".$lastDocInsID.",'".$document_year."',1)");
       $lastDocYearInsID = mysqli_insert_id($cn->getConnection());
   }
   $returnObj["lastDocInsID"] = $lastDocInsID;
   $returnObj["lastDocYearInsID"] = $lastDocYearInsID;
   echo json_encode($returnObj);
}
if($_GET['type'] == "UploadDocs")
{
    $date = date("Y-m-d");
    $document_id = $_POST["document_id"];
    $document_year_id = $_POST["document_year_id"];
    $n = count($_FILES['file']['name']);
    $size = array_sum($_FILES['file']['size']);
    $document_year_cat_id = 0;
    if(!empty($_POST["cat_id"])) {
        // foreach($_POST["cat_id"] as $attributeKey => $attributes)
        // {
            // echo $_POST["cat_id"][$attributeKey];
            $sqlCat = $cn->selectdb("SELECT document_year_cat_id FROM tbl_document_year_cat WHERE cat_id = ".$_POST["cat_id"]." AND document_year_id=".$document_year_id);
            if($cn->numRows($sqlCat) > 0)
            {
                $rowCat = $cn->fetchAssoc($sqlCat);
                $document_year_cat_id = $rowCat["document_year_cat_id"];
            }
            else
            {
                $cn->insertdb("INSERT INTO tbl_document_year_cat(`document_year_id`, `cat_id`, `entry_date`, `status`) VALUES(".$document_year_id.",".$_POST["cat_id"].",'".$date."',1)");
                $document_year_cat_id = mysqli_insert_id($cn->getConnection());
            }          
        // }

        //Code to insert files in table
        $sqlDetails = $cn->selectdb("SELECT s.shipper_name,dy.document_year,c.cat_name FROM tbl_shipper s,tbl_document_year dy,tbl_cat c,tbl_document_year_cat dyc,tbl_document d WHERE dyc.document_year_id = dy.document_year_id AND dyc.cat_id = c.cat_id AND dy.document_id = d.document_id AND d.shipper_id = s.shipper_id AND dyc.document_year_cat_id = ".$document_year_cat_id);
        if($cn->numRows($sqlDetails) > 0)
        {
            $row = $cn->fetchAssoc($sqlDetails);
            if($size>0)
            {
                $path = "Documents/".str_replace(" ","",$row["shipper_name"])."/".$row["document_year"]."/".str_replace(" ","",$row["cat_name"])."/";
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                for ($i=0; $i < $n; $i++) { 
                    $name = str_shuffle(md5(rand(0,10000)));
                    $ext = strtolower(substr($_FILES['file']['name'][$i], strrpos($_FILES['file']['name'][$i],".")));
                    $name .=$ext;
                    
                    move_uploaded_file($_FILES["file"]["tmp_name"][$i],$path.$name);
                    // $files.=$name.",";
                    $cn->insertdb("INSERT INTO tbl_files(`document_year_cat_id`, `file_name`, `entry_date`,`entry_person_id`, `status`) VALUES(".$document_year_cat_id.",'".$name."','".$date."',".$_SESSION['user_id'].",1)");
                }
                echo "1";
            }
            //echo "2";
        }
        //echo "3".$document_year_id;
    }
    else
    {
        echo "0";
    }
}
if($_GET['type'] == "fetchDocuments")
{
    $document_id = $_GET["document_id"];
    $sql = $cn->selectdb("SELECT d.*,s.shipper_name FROM tbl_document d,tbl_shipper s WHERE d.shipper_id = s.shipper_id AND d.document_id = ".$document_id);
    $returnObj = array();
    if($cn->numRows($sql) > 0)
    {
        $rowDoc = $cn->fetchAssoc($sql);
        $returnObj["document_id"] = $rowDoc["document_id"];
        $returnObj["shipper_id"] = $rowDoc["shipper_id"];
        $returnObj["shipper_name"] = $rowDoc["shipper_name"];
        $sqlDY = $cn->selectdb("SELECT * FROM tbl_document_year WHERE document_id = ".$rowDoc["document_id"]);
        if($cn->numRows($sqlDY) > 0)
        {
            $i = 0;
            while($rowDY = $cn->fetchAssoc($sqlDY))
            {
                $returnObj["document_year"][$i]["document_year_id"] = $rowDY["document_year_id"];
                $returnObj["document_year"][$i]["document_year_name"] = $rowDY["document_year"];
                $sqlDYC = $cn->selectdb("SELECT d.*,c.cat_name FROM tbl_document_year_cat d,tbl_cat c WHERE c.cat_id = d.cat_id  AND d.document_year_id = ".$rowDY["document_year_id"]);
                if($cn->numRows($sqlDYC) > 0)
                {
                    $j = 0;
                    while($rowDYC = $cn->fetchAssoc($sqlDYC))
                    {
                        $returnObj["document_year"][$i]["document_year_cat"][$j]["document_year_cat_id"] = $rowDYC["document_year_cat_id"];
                        $returnObj["document_year"][$i]["document_year_cat"][$j]["cat_name"] = $rowDYC["cat_name"];
                        $sqlFiles = $cn->selectdb("SELECT f.*,u.user_name FROM tbl_files f,tbl_user u WHERE u.user_id = f.entry_person_id AND f.document_year_cat_id = ".$rowDYC["document_year_cat_id"]);
                        if($cn->numRows($sqlFiles) > 0)
                        {
                            $k = 0;
                            while($rowFiles = $cn->fetchAssoc($sqlFiles))
                            {
                                $returnObj["document_year"][$i]["document_year_cat"][$j]["files"][$k]["file_id"] = $rowFiles["file_id"];
                                $returnObj["document_year"][$i]["document_year_cat"][$j]["files"][$k]["file_name"] = $rowFiles["file_name"];
                                $returnObj["document_year"][$i]["document_year_cat"][$j]["files"][$k]["entry_date"] = date("d-m-Y",strtotime($rowFiles["entry_date"]));
                                $returnObj["document_year"][$i]["document_year_cat"][$j]["files"][$k]["entry_person_name"] = $rowFiles["user_name"];
                                $k++;
                            }
                        }
                        $j++;
                    }
                }
                $i++;
            }
        }
    }
    //echo $document_id;
    echo json_encode($returnObj);
}
if($_GET['type'] == "deleteFile")
{
    $file_id = $_GET['file_id'];
    $sql = $cn->selectdb("SELECT f.`file_name`,s.shipper_name,c.cat_name,dy.document_year FROM tbl_files f,tbl_shipper s,tbl_cat c,tbl_document_year dy,tbl_document_year_cat dyc,tbl_document d WHERE f.document_year_cat_id = dyc.document_year_cat_id AND dyc.document_year_id = dy.document_year_id AND dy.document_id = d.document_id AND d.shipper_id = s.shipper_id AND f.`file_id` =".$file_id." GROUP BY f.file_name");
    if($cn->numRows($sql) > 0)
    {
        $row = $cn->fetchAssoc($sql);
        $path = "Documents/".str_replace(" ","",$row["shipper_name"])."/".str_replace(" ","",$row["document_year"])."/".str_replace(" ","",$row["cat_name"])."/".$row["file_name"];
        if(file_exists($path))
            unlink($path);
        $cn->insertdb("DELETE FROM tbl_files WHERE `file_id` = ".$file_id);
        echo "1";
    }
    else
    {
        echo "0";
    }
}
if($_GET['type'] == "deleteDocument")
{
    $document_id = $_GET['document_id'];
    $sql = $cn->selectdb("SELECT f.file_id,f.`file_name`,s.shipper_name,c.cat_name,dy.document_year FROM tbl_files f,tbl_shipper s,tbl_cat c,tbl_document_year dy,tbl_document_year_cat dyc,tbl_document d WHERE f.document_year_cat_id = dyc.document_year_cat_id AND dyc.document_year_id = dy.document_year_id AND dy.document_id = d.document_id AND d.shipper_id = s.shipper_id AND d.`document_id` =".$document_id." GROUP BY f.file_name");
    if($cn->numRows($sql) > 0)
    {
        while($row = $cn->fetchAssoc($sql))
        {
            $path = "Documents/".str_replace(" ","",$row["shipper_name"])."/".str_replace(" ","",$row["document_year"])."/".str_replace(" ","",$row["cat_name"])."/".$row["file_name"];
            if(file_exists($path))
                unlink($path);
            // $cn->insertdb("DELETE FROM tbl_files WHERE `file_id` = ".$row["file_id"]);
        }
        $cn->insertdb("DELETE FROM tbl_document WHERE `document_id` = ".$document_id);
        
        echo "true";
    }
    else
    {
        echo "false";
    }
}
if($_GET['type'] == "deleteMulFile")
{
    $file_ids = $_POST['file_ids'];
    $ids = "";
    for($i=0;$i<count($file_ids);$i++)
    {
        $ids .= "'".$file_ids[$i]."',";
    }
    // echo $ids;
    $ids = rtrim($ids,",");
    $sql = $cn->selectdb("SELECT f.file_id,f.`file_name`,s.shipper_name,c.cat_name,dy.document_year FROM tbl_files f,tbl_shipper s,tbl_cat c,tbl_document_year dy,tbl_document_year_cat dyc,tbl_document d WHERE f.document_year_cat_id = dyc.document_year_cat_id AND dyc.document_year_id = dy.document_year_id AND dyc.cat_id = c.cat_id AND dy.document_id = d.document_id AND d.shipper_id = s.shipper_id AND f.`file_id` IN (".$ids.") GROUP BY f.file_name");
    if($cn->numRows($sql) > 0)
    {
        while($row = $cn->fetchAssoc($sql))
        {
            $path = "Documents/".str_replace(" ","",$row["shipper_name"])."/".str_replace(" ","",$row["document_year"])."/".str_replace(" ","",$row["cat_name"])."/".$row["file_name"];
            if(file_exists($path))
                unlink($path);
            $cn->insertdb("DELETE FROM tbl_files WHERE `file_id` = ".$row["file_id"]);
        }
        // $cn->insertdb("DELETE FROM tbl_files WHERE `file_id` = ".$document_id);
        
        echo "true";
    }
    else
    {
        echo "false";
    }
}
?>
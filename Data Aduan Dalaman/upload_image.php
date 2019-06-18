<?php require_once('../Connections/Connection1.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}?>
<?php
$TableID=$_GET['TableID'];
$images = array();
foreach($_FILES['images']['name'] as $key=>$val){        
	
	//The name of the directory that we need to create.
$directoryName = "../upload/".$TableID;
 
//Check if the directory already exists.
if(!is_dir($directoryName)){
    //Directory does not exist, so lets create it.
    mkdir($directoryName, 0755);
}
$upload_dir="../upload/".$TableID."/";
	
	$upload_image =$upload_dir.$_FILES['images']['name'][$key];
	$file_name = $_FILES['images']['name'][$key];
	if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$upload_image)){
		$images[] = $upload_image;
	//	 insert uploaded images details into MySQL database.
		if(isset($_POST["Submit"])=="image_upload_form"){
		$insert_sql = sprintf("INSERT INTO photos(TableId,ImagePath) VALUES(%s,%s)",
		  GetSQLValueString($TableID, "text"),
                       GetSQLValueString($upload_image, "text"));
		
		$result=mysql_query( $insert_sql,$Connection1);
		 if($result){
			 	echo "<script>";
			
			echo 'alert("Gambar berjaya di muat naik")';
			echo '</script>'; 
		 }else{
			echo '<script>';
			echo 'alert("Gambar gagal di muat naik")';
			echo '</script>'; 
		 }
		 
		 }}
}
		 foreach($images as $image){
echo '<img src="'.$image.'" height="250" width="225" " />';
		
	
}
?>

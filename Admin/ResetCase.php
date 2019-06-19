<?php require_once('../Connections/Connection1.php'); ?>
<?php
session_start();
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
}


$colname_ViewCase = "-1";
if (isset($_GET['NoRujukan'])) {
  $colname_ViewCase = $_GET['NoRujukan'];
$query_Complete = sprintf("UPDATE aduan
SET StatusAduan ='Pending' where NoRujukan=%s",GetSQLValueString($colname_ViewCase, "text"));
$CompleteAduan = mysql_query($query_Complete, $Connection1) or die(mysql_error());


	
   $UpdateGoTo = "Adminpage.php";
  if ($UpdateGoTo) {
    header("Location: $UpdateGoTo");
}


//To update the status of completed



}


?>

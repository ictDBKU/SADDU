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
}
$colname_ViewCase = "-1";
if (isset($_GET['NoRujukan'])) {
  $colname_ViewCase = $_GET['NoRujukan'];
}
  
  
mysql_select_db($database_Connection1, $Connection1);
$query_Recordset1 = "DELETE FROM aduan WHERE NoRujukan='$colname_ViewCase';";
$Recordset1 = mysql_query($query_Recordset1, $Connection1) or die(mysql_error());
$query_Recordset2 = "DELETE FROM  tindakandirujuk WHERE NoRujukan='$colname_ViewCase';";
$Recordset2 = mysql_query($query_Recordset2, $Connection1) or die(mysql_error());


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
alert("Aduan has successfully deleted");
</script>
</head>

<body>
</body>
</html>


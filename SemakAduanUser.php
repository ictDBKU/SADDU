<?php require_once('Connections/Connection1.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "2";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../homepage.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Connection1, $Connection1);
$query_Recordset1 = "SELECT * FROM aduan";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Connection1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SADDU</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" >
</head>
<script>
function changeAction(val){
    document.getElementById('SearchForm').setAttribute('action', val);

}
</script>
<body>
<div align="center">
  <p>&nbsp;</p>

  <ul>
    <li class="dropdown">
    <a href="AdminPage.php" class="dropbtn">Home</a>
    
  </li>
  <li class="dropdown"><a href="#news">Aduan</a>
   <div class="dropdown-content">
      <a href="semakaduanUser.php">Semak Aduan</a>
       <a href="homepage.php">Tambah Aduan</a>
      
     
      
    </div>
  </li>
  
  
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Logout</a>
   
  </li>
</ul>

  <p>&nbsp;</p>
  <form action="" name="SearchForm" id="SearchForm" method="Post">
<select name="SearchForm" onchange="changeAction(this.value)">
<option value="">Please select category to search:</option>
  <option value="SearchByName.php">Search By Name</option>
  <option value="SearchByKawasan.php">Search By Kawasan Aduan</option>
  <option value="SearchByDepartment.php">Search By Department</option>
  
</select> <input name="find" type="text"  ><input type="submit" value="Search" >
</form>



    <select name="MonthSelection" selected="Choose Month" onchange="location = this.value;">
      <option value="" selected>Filter by Month</option>
      <option value="Searchbydate.php?monthsearch=1">January</option>
      <option value="Searchbydate.php?monthsearch=2">February</option>
      <option value="Searchbydate.php?monthsearch=3">March</option>
      <option value="Searchbydate.php?monthsearch=4">April</option>
      <option value="Searchbydate.php?monthsearch=5">May</option>
      <option value="Searchbydate.php?monthsearch=6">June</option>
      <option value="Searchbydate.php?monthsearch=7">July</option>
      <option value="Searchbydate.php?monthsearch=8">August</option>
      <option value="Searchbydate.php?monthsearch=9">September</option>
      <option value="Searchbydate.php?monthsearch=10">October</option>
      <option value="Searchbydate.php?monthsearch=11">November</option>
      <option value="Searchbydate.php?monthsearch=12">December</option>
      
    </select>
    
  <table width="599" border="1">
    <tr>
      <td width="20">No</td>
      <td width="108">Kategori Aduan</td>
      <td width="61">Kawasan Aduan</td>
      <td width="65">Maklumat Aduan</td>
      <td width="61">Jenis Aduan</td>
      <td width="72">Bahagian Aduan</td>
      <td width="41">Status Aduan</td>
      <td width="51">Masa Aduan</td>
      <td width="9">&nbsp;</td>
      <td width="47">&nbsp;</td>
    </tr>
     <?php $no=1;?>
      
    <?php do { ?>
    <tr>
      <td><?php echo $no++; ?></td>
      
        <td><?php echo $row_Recordset1['Category']; ?></td>
        <td><?php echo $row_Recordset1['KawasanAduan']; ?></td>
        <td><?php echo $row_Recordset1['MaklumatAduan']; ?></td>
        <td><?php echo $row_Recordset1['JenisAduan']; ?></td>
        <td><?php echo $row_Recordset1['BahagianAduan']; ?></td>
        <td><?php echo $row_Recordset1['StatusAduan']; ?></td>
        <td><?php echo $row_Recordset1['TimeSubmit']; ?></td>
        
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    
  </table>
 
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);


?>

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

$colname_searching = "-1";
if (isset($_POST['find'])) {
$colname_searching =$_POST['find'] ;
}
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;

if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Connection1, $Connection1);
$query_Recordset1 = sprintf("SELECT * FROM aduan WHERE NamaPengadu =%s ", GetSQLValueString( $colname_searching, "date"));
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
<link href="../css/tableView.css" rel="stylesheet" type="text/css" >
<link href="../css/styles.css" rel="stylesheet" type="text/css" 
</head>

<body>
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <ul>
    <li class="dropdown">
    <a href="AdminPage.php" class="dropbtn">Home</a>
    <div class="dropdown-content">
      
    </div>
  </li>
  <li><a href="#news">User management</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Logout</a>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </li>
</ul>
 
  
  
  </select><select name="MonthSelection" selected="Choose Month" onchange="location = this.value;">
  <option value="" selected>Search by Month</option>
    <option value="Searchbydate.php?monthsearch=1">January</option>
  <option value="Searchbydate.php?monthsearch=2">February</option>
  <option value="Searchbydate.php?monthsearch=3">March</option>
  <option value="Searchbydate.php?monthsearch=4">April</option>
  <option value="Searchbydate.php?monthsearch=5">May</option>
  <option value="Searchbydate.php?monthsearch=6">June</option>
  <option value="Searchbydate.php?monthsearch=7">July</option>
  <option value="Searchbydate.php?monthsearch=7">August</option>
  <option value="Searchbydate.php?monthsearch=9">Septemeber</option>
  <option value="Searchbydate.php?monthsearch=10">October</option>
  <option value="Searchbydate.php?monthsearch=11">November</option>
  <option value="Searchbydate.php?monthsearch=12">December</option>
  </select>
  
  <table width="599" border="1" class="paleBlueRows">
   <thead>
    <tr>
      <td width="20">No</td>
      <td width="108">Kategori Aduan</td>
      <td width="61">Kawasan Aduan</td>
      <td width="65">Maklumat Aduan</td>
      <td width="61">Jenis Aduan</td>
      <td width="72">Bahagian Aduan</td>
      <td width="41">Status Aduan</td>
      <td width="51">Masa Aduan</td>

    </tr>
    </thead>
    <?php $no=1;?>
    <?php do { ?>
    <tr>
      <td><?php echo $no++; ?></td>
      
        <td><?php echo $row_Recordset1 ['Category']; ?></td>
        <td><?php echo $row_Recordset1 ['KawasanAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['MaklumatAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['JenisAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['BahagianAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['StatusAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['TimeSubmit']; ?></td>
        
      
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

  </table>
 
</div>

</body>
</html>
<?php


mysql_free_result($Recordset1);
?>

<?php require_once('../../Connections/Connection1.php'); ?>
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
//Sql to view all the aduan
mysql_select_db($database_Connection1, $Connection1);
$query_ViewCase = sprintf("SELECT * FROM aduan WHERE NoRujukan = %s ORDER BY NoRujukan ASC", GetSQLValueString($colname_ViewCase, "text"));
$ViewCase = mysql_query($query_ViewCase, $Connection1) or die(mysql_error());
$row_ViewCase = mysql_fetch_assoc($ViewCase);
$totalRows_ViewCase = mysql_num_rows($ViewCase);
//Sql to view all the to merge with subkatagori aduan
mysql_select_db($database_Connection1, $Connection1);
$query_ViewCategory = sprintf("SELECT *,KategoriAduan.NamaAduan FROM aduan INNER JOIN kategoriAduan on kategoriAduan.IDKategoriAduan = aduan.Category WHERE NoRujukan = %s ORDER BY NoRujukan ASC", GetSQLValueString($colname_ViewCase, "text"));
$ViewCategory = mysql_query($query_ViewCategory, $Connection1) or die(mysql_error());
$row_ViewCategory = mysql_fetch_assoc($ViewCategory);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Case</title>
<link href="../../css/tableView.css" rel="stylesheet" type="text/css" >
</head>

<body>
</body>
</html>
<?php
mysql_free_result($ViewCase);
?>
<label><center><?php echo $row_ViewCase['NoRujukan'] ?></center></label><br>

<table border="1" align="center" style="width: 400px" cellspacing="3" class="paleBlueRows">
<thead>
  <th colspan="2">Aduan</th>
  </thead>
  <tr>
 
    <td>Nama Pengadu </td>
    <td style="color: #4E4E4E"><?php echo $row_ViewCase['NamaPengadu'] ?></td>
	  
  </tr>
  <tr>
	  
	<td>No telefon </td>
    <td style="color: #4E4E4E"><?php echo $row_ViewCase['NoTelefon'] ?></td>
  
  </tr>
	<thead>
  <th colspan="2">Kawasan</th>
  </thead>
  <tr>
 
    <td>Kawasan Aduan </td>
    <td style="color: #4E4E4E"><?php echo $row_ViewCase['KawasanAduan'] ?></td>
	  
	  
  </tr>
	<thead>
  <th colspan="2">Maklumat Aduan</th>
  </thead>
  <tr>
   
	  <td>Kategori Aduan </td>
    <td style="color: #4E4E4E"><?php echo $row_ViewCategory['NamaAduan'] ?></td>
	  
  </tr>
  <tr>
	  
	  <td>SubKategori Aduan </td>
    <td style="color: #4E4E4E"><?php echo $row_ViewCase['SubCategory'] ?></td>
	  
  </tr>
   <tr>
	  
	  <td>Maklumat Aduan </td>
    <td style="color: #4E4E4E"><?php echo $row_ViewCase['MaklumatAduan'] ?></td>
	  
  </tr>
  <tr>
 
    <td>Tarikh Aduan Diterima </td>
    <td style="color: #4E4E4E"><?php echo date("d-m-Y  ", strtotime($row_ViewCase['TimeSubmit']) ); ?></td>
	  
	  
  </tr>
  <tr>
  
    <td>Masa Aduan Diterima </td>
    <td style="color: #4E4E4E"><?php echo date("h:i:sa ", strtotime($row_ViewCase['TimeSubmit']) ); ?></td>
	  
	  
  </tr>
  <tr>
 
    <td>Status Aduan </td>
    <td><?php echo $row_ViewCase['StatusAduan'] ?>    <select name="CaseStatus" selected="Choose Month" onchange="location = this.value;">
     
      <option value="Searchbydate.php?monthsearch=1">Acknowledged</option>
      <option value="Searchbydate.php?monthsearch=2">In Progress</option>
  <option value="Searchbydate.php?monthsearch=2">Completed</option>
    </select></td>
  </tr>
  <tr>
     <td align="center" colspan="2"><input type="button" value="confirm"></td>
  </tr>
</table>

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

$addFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $addFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO aduan (
    NoRujukan,
  Category,
  JenisAduan,
  MaklumatAduan,
  KawasanAduan,
  BahagianAduan,
  StatusAduan,
  NamaPengadu,
  UsernamePengadu,
  TimeSubmit) VALUES 
  
  
  (%s,%s,%s, %s,%s,%s,'Pending',%s,%s,now())",
                      GetSQLValueString($_POST['NoRujukan'], "text"),
                       GetSQLValueString($_POST['kategoriAduan'], "text"),
					    GetSQLValueString($_POST['JenisAduan'], "text"),
                       GetSQLValueString($_POST['MaklumatAduan'], "text"),
                       GetSQLValueString($_POST['kawasanAduan'], "text"),
					   GetSQLValueString($_POST['BahagianDirujuk'], "text"),
					    GetSQLValueString($_POST['NamaPengadu'], "text"),
					   GetSQLValueString($_POST['UsernamePengadu'], "text")	   
					   
					   );

  mysql_select_db($database_Connection1, $Connection1);
  $Result1 = mysql_query($insertSQL, $Connection1) or die(mysql_error());

  $insertGoTo = "homepage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
$UsernameLogin=$_SESSION['Username'];
mysql_select_db($database_Connection1, $Connection1);
$query_KategoriAduan = "SELECT NamaAduan FROM kategoriaduan ORDER BY NamaAduan";
$KategoriAduan = mysql_query($query_KategoriAduan, $Connection1) or die(mysql_error());
$row_KategoriAduan = mysql_fetch_assoc($KategoriAduan);
$totalRows_KategoriAduan = mysql_num_rows($KategoriAduan);

mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName = "SELECT * FROM department";
$DepartmentName = mysql_query($query_DepartmentName, $Connection1) or die(mysql_error());
$row_DepartmentName = mysql_fetch_assoc($DepartmentName);
$totalRows_DepartmentName = mysql_num_rows($DepartmentName);
//To view for bahagianDirujuk
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName1 = "SELECT * FROM department";
$DepartmentName1 = mysql_query($query_DepartmentName1, $Connection1) or die(mysql_error());
$row_DepartmentName1 = mysql_fetch_assoc($DepartmentName1);
$totalRows_DepartmentName1 = mysql_num_rows($DepartmentName1);



mysql_select_db($database_Connection1, $Connection1);
$query_KawasanAduan = "SELECT NamaKawasan FROM kawasanaduan ORDER BY NamaKawasan";
$KawasanAduan= mysql_query($query_KawasanAduan, $Connection1) or die(mysql_error());
$row_KawasanAduan = mysql_fetch_assoc($KawasanAduan);
$totalRows_KawasanAduan = mysql_num_rows($KawasanAduan);

mysql_select_db($database_Connection1, $Connection1);
$query_Recordset1 = "SELECT * FROM useraccount where Username='$UsernameLogin' ";

$Recordset1 = mysql_query($query_Recordset1, $Connection1) or die(mysql_error());


$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_MergeJobID="SELECT DesignationTitle  from useraccount

INNER JOIN designation
ON useraccount.JobId = designation.JobId where Username='$UsernameLogin'";

$Recordset2= mysql_query($query_MergeJobID, $Connection1) or die(mysql_error());



$row_Recordset2 = mysql_fetch_assoc($Recordset2);

$query_MergeDepartmentID="SELECT DepartmentName,OfficeLocation,Abbreviation from department 
INNER JOIN useraccount 
ON useraccount.DepartmentID = department.DepartmentID where Username='$UsernameLogin'";
$Recordset3= mysql_query($query_MergeDepartmentID, $Connection1) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset1 = mysql_num_rows($Recordset3);

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
//To retrieve from aduan table
mysql_select_db($database_Connection1, $Connection1);
$query_RecordsetAduan = "SELECT * FROM aduan";
//To generate id in the form
$RecordsetAduan = mysql_query($query_RecordsetAduan, $Connection1) or die(mysql_error());
$row_RecordsetAduan = mysql_fetch_assoc($RecordsetAduan);
$tableid=mysql_num_rows($RecordsetAduan)+1;
?>
<?php
mysql_select_db($database_Connection1, $Connection1);
$query_jenisaduan = "SELECT * FROM jenisaduan";
$RecordsetJenisAduan = mysql_query($query_jenisaduan, $Connection1) or die(mysql_error());
$row_JenisAduan = mysql_fetch_assoc($RecordsetJenisAduan);
$totalRows_JenisAduan = mysql_num_rows($RecordsetJenisAduan);
?>
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

$MM_restrictGoTo = "index.php";
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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Aduan Dalaman</title>
<link href="styledadd2019.css" rel="stylesheet" type="text/css">
<style>
#myDIV {
	display:none;
 
}
</style>
<script>
function showBahagianDirujuk() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myFunction() {
  confirm("Submit the form?");
}
</script>

</head>

<body>
<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
?>
<form name="form1" method="POST" action="<?php echo $addFormAction; ?>" class="contact100-form validate-form" align="center">
	<table width="980" border="1" align="center" >
  <tbody>
    <tr >
      <td><center>DATA ADUAN DALAMAN DBKU 2019</center><br></td>
    </tr>
	  <table width="980" border="0" align="center">
  <tbody>
    <tr>      <td width="100">No. Bil<br></td>
      <td width="200"><input type="text" name="textfield" id="textfield" value="<?php echo $tableid;?>"></td>
      <td width="150">1. Tindakan Bahagian Dirujuk <br></td>
      <td>
        <textarea name="textarea2" id="textarea2" ></textarea></td>
        
    </tr>
 
    <tr>
      <td>Tarikh<br></td>
      <td><input type="text" name="textfield2" id="textfield2" value="<?php echo date('d/m/Y ', time());?>" readonly></td>
      
      <td><label>2. Tindakan Bahagian Dirujuk</label></td>
      <td>   <div id="myDIV"><textarea name="textarea3" ></textarea></div></td>
    

    </tr>
    
    <tr>
      <td>Masa<br></td>
      <td><input type="text" name="textfield3" id="textfield3"  value="<?php echo date('h:i:s a ', time());?>" readonly></td>
      <td><label>3. Tindakan Bahagian Dirujuk</label></td>
      <td><textarea name="textarea4" id="textarea4" style="display:none"></textarea></td>
    </tr>
    <tr>
      <td><label>Perkara</label></td>
      <td><textarea rows="8" cols="50" name="MaklumatAduan" id="MaklumatAduan" ></textarea></td>
      <td><label>Status Aduan</label></td>
      <td><table width="600" border="0">
        <tbody>
          <tr>
            <td width="150"><select name="select8" id="select8" style="width: 300px">
            </select></td>
            <td><label>Tarikh Aduan Ditutup</label></td>
            <td><input type="text" name="textfield5" id="textfield5"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><label>Kategori</label></td>
      <td> <select name="kategoriAduan" id="kategoriAduan">
                      <?php do { ?>
              <option value="<?php echo $row_KategoriAduan['NamaAduan']; ?>"><?php echo $row_KategoriAduan['NamaAduan']; ?></option>
              <?php } while ($row_KategoriAduan = mysql_fetch_assoc($KategoriAduan)); ?>

            </select></td>
      <td><label>Bilangan Hari</label></td>
      <td><table width="600" border="0">
        <tbody>
          <tr>
            <td><input type="text" name="textfield6" id="textfield6"></td>
            <td width="300"><label>Catatan</label></td>
            <td width="300"><input type="text" name="textfield7" id="textfield7"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><label>Jenis Aduan</label></td>
      <td><select name="JenisAduan" id="JenisAduan">
                      <?php do { ?>
              <option value="<?php echo $row_JenisAduan['NamaJenisAduan']; ?>"><?php echo $row_JenisAduan['NamaJenisAduan']; ?></option>
              <?php } while ($row_JenisAduan = mysql_fetch_assoc($RecordsetJenisAduan)); ?>

        </select></td>
      <td>&nbsp;</td>
      <td><table width="600" border="0">
        <tbody>
          <tr>
            <td><input type="button" name="button" id="button" value="Find Record"></td>
            <td><input type="button" name="button2" id="button2" value="Preview Record"></td>
            <td><button type="submit" name="Submit" id="Submit" value="Submit" onClick="myFunction()" >Save Record</button></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><label>Kawasan</label></td>
      <td><select name="kawasanAduan" id="kawasanAduan">
                      <?php do { ?>
    <option value="<?php echo $row_KawasanAduan['NamaKawasan']; ?>"><?php echo $row_KawasanAduan['NamaKawasan']; ?></option>
              <?php } while ($row_KawasanAduan = mysql_fetch_assoc($KawasanAduan)); ?>

            
        </select></td>
      <td>&nbsp;</td>
      <td><table width="600" border="1">
        <tbody>
          <tr>
            <td><label>Lampiran 1</label></td>
            <td><label>Lampiran 2</label></td>
            <td><label>Lampiran 3</label></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><label>Pengadu</label></td>
      <td><input type="text" name="NamaPengadu" id="NamaPengadu" style="background-color:#F4EBEB" value="<?php echo $row_Recordset1['Name']; ?>" readonly></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label>Bahagian Aduan</label></td>
      <td><select name="BahagianDirujuk" id="BahagianDirujuk">
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName['Abbreviation']; ?>><?php echo $row_DepartmentName['Abbreviation']; ?>-<?php echo $row_DepartmentName['DepartmentName']; ?></option>
              <?php } while ($row_DepartmentName = mysql_fetch_assoc($DepartmentName)); ?></select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label>Saluran</label></td>
      <td><select name="select6" id="select6" style="width: 100px">
      <option value="Ronda Bantu">Roda Bantu
      </option>
       <option value="Pegawai Zon">Pegawai Zon
      </option>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label>No. Kes Aduan</label></td>
      <td><input type="text" name="NoRujukan" id="NoRujukan" value="AD/<?php echo date("Y/m/d");?>-<?php echo $tableid;?>" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label>Bahagian Dirujuk</label></td>
      
      <td><select name="BahagianDirujuk" id="BahagianDirujuk" >
      <?php do { ?>
       
              <option value=<?php echo $row_DepartmentName1['Abbreviation']; ?>><?php echo $row_DepartmentName1['Abbreviation']; ?>-<?php echo $row_DepartmentName1['DepartmentName']; ?></option>
              <?php } while ($row_DepartmentName1 = mysql_fetch_assoc($DepartmentName1)); ?>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

  </tbody>
  <input type="hidden" name="UsernamePengadu" value="<?php echo $row_Recordset1['Username']; ?>">
</table>

 <input type="hidden" name="MM_insert" value="form1">
</form>	
<button value="Add to favorites" onClick="showBahagianDirujuk()">More</button>

</body>
</html>
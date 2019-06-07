<?php require_once('Connections/Connection1.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO aduan (ID,Category, JenisAduan,MaklumatAduan, KawasanAduan,BahagianAduan,StatusAduan,NamaPengadu,UsernamePengadu,TimeSubmit) VALUES (MD5(NOW()),%s,%s, %s, %s,%s,'Pending',%s,%s,now())",
                       GetSQLValueString($_POST['kategoriAduan'], "text"),
					    GetSQLValueString($_POST['JenisAduan'], "text"),
                       GetSQLValueString($_POST['MaklumatAduan'], "text"),
                       GetSQLValueString($_POST['kawasanAduan'], "text"),
					   GetSQLValueString($_POST['BahagianDirujuk'], "text"),
					   GetSQLValueString($_POST['NamaPengadu'], "text")
					   
					   
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

mysql_select_db($database_Connection1, $Connection1);
$query_KawasanAduan = "SELECT NamaKawasan FROM kawasanaduan ORDER BY NamaKawasan";
$KawasanAduan= mysql_query($query_KawasanAduan, $Connection1) or die(mysql_error());
$row_KawasanAduan = mysql_fetch_assoc($KawasanAduan);
$totalRows_KawasanAduan = mysql_num_rows($KawasanAduan);

mysql_select_db($database_Connection1, $Connection1);
$query_Recordset1 = "SELECT * FROM useraccount where Username='$UsernameLogin' ";

$Recordset1 = mysql_query($query_Recordset1, $Connection1) or die(mysql_error());


//Merge Job Id
$query_MergeJobID="SELECT DesignationTitle  from useraccount
INNER JOIN designation ON useraccount.JobId = designation.JobId where Username='$UsernameLogin'";
$Recordset2= mysql_query($query_MergeJobID, $Connection1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

//Merge Department
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
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistem Aduan Dalaman DBKU</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/styles.css" rel="stylesheet" type="text/css" >
</head>
<script>
function myFunction() {
  confirm("Submit the form?");
}
</script>

<body>
<p align="center">Sistem Aduan Dalaman DBKU </p>
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
    <a href="<?php echo $logoutAction ?>" class="dropbtn">Logout</a>
   
  </li>
</ul>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>" class="contact100-form validate-form" align="center">
  <div align="center">
    <table width="456" border="1">
      <tr>
        <td colspan="2"><strong>MAKLUMAT PENGADU:</strong></td>
      </tr>
      <tr>
        <td width="65">Nama:</td>
        <td width="317"><input type="text" value="<?php echo $row_Recordset1['Name']; ?>" readonly></td>
      </tr>
      <tr>
        <td>Jawatan:</td>
        <td><?php echo $row_Recordset2['DesignationTitle']; ?></td>
      </tr>
      <tr>
        <td>Bahagian:</td>
        <td><?php echo $row_Recordset3['DepartmentName']; ?></td>
      </tr>
      <tr>
        <td>Lokasi Pejabat:</td>
        <td><?php echo $row_Recordset3['OfficeLocation'];?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Jenis Aduan</td>
        <td> <select name="JenisAduan" id="JenisAduan">
                      <?php do { ?>
              <option value="<?php echo $row_JenisAduan['NamaJenisAduan']; ?>"><?php echo $row_JenisAduan['NamaJenisAduan']; ?></option>
              <?php } while ($row_JenisAduan = mysql_fetch_assoc($RecordsetJenisAduan)); ?>

        </select></td>
      </tr>
      <tr>
        <td>Kategori:</td>
        <td><label for="kategoriAduan"></label>
                      <select name="kategoriAduan" id="kategoriAduan">
                      <?php do { ?>
              <option value="<?php echo $row_KategoriAduan['NamaAduan']; ?>"><?php echo $row_KategoriAduan['NamaAduan']; ?></option>
              <?php } while ($row_KategoriAduan = mysql_fetch_assoc($KategoriAduan)); ?>

            </select></td>
                  </tr>
      <tr>
        <td>Kawasan:</td>
        <td>
        <select name="kawasanAduan" id="kawasanAduan">
                      <?php do { ?>
    <option value="<?php echo $row_KawasanAduan['NamaKawasan']; ?>"><?php echo $row_KawasanAduan['NamaKawasan']; ?></option>
              <?php } while ($row_KawasanAduan = mysql_fetch_assoc($KawasanAduan)); ?>

            
        </select></td>
      </tr>
      <tr>
        <td>Perkara:</td>
        <td><label for="MaklumatAduan"></label>
        <textarea rows="4" cols="50" name="MaklumatAduan" id="MaklumatAduan" required></textarea></td>
      </tr>
      <tr>
        <td>Bahagian Dirujuk:</td>
       <td><label for="BahagianDirujuk"></label>
                      <select name="BahagianDirujuk" id="BahagianDirujuk">
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName['Abbreviation']; ?>><?php echo $row_DepartmentName['Abbreviation']; ?>-<?php echo $row_DepartmentName['DepartmentName']; ?></option>
              <?php } while ($row_DepartmentName = mysql_fetch_assoc($DepartmentName)); ?></td>
      </tr>
     
      <tr>
        <td>&nbsp;</td>
        <td><button type="submit" name="Submit" id="Submit" value="Submit" onClick="myFunction()">Submit</button></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
  <input type="hidden" name="MM_insert" value="form1">

   
    
 

</form>

</body>
</html>
<?php
mysql_free_result($KategoriAduan);

mysql_free_result($DepartmentName);

mysql_free_result($Recordset1);
?>

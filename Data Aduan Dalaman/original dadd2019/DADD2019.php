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
    MaklumatAduan,
  KawasanAduan,
  BahagianAduan,
  SaluranAduan,
  StatusAduan,
  NamaPengadu,
  UsernamePengadu,
  NamaAkaunPengadu,
  TimeSubmit) VALUES 
  
  
  (%s,%s,%s,%s,%s,%s,'Pending',%s,%s,%s,now())",
                      GetSQLValueString($_POST['NoRujukan'], "text"),
                       GetSQLValueString($_POST['kategoriAduan'], "text"),
					   GetSQLValueString($_POST['MaklumatAduan'], "text"),
                       GetSQLValueString($_POST['kawasanAduan'], "text"),
					   GetSQLValueString($_POST['BahagianDirujuk'], "text"),
					   GetSQLValueString($_POST['SaluranAduan'], "text"),
					    GetSQLValueString($_POST['NamaPengadu'], "text"),
					   GetSQLValueString($_POST['UsernamePengadu'], "text"),	   
					   GetSQLValueString($_POST['NamaAkaunPengadu'], "text")	
					   );
					   
					   //Note!! To delete aduan the tindakan dirujuk also need to be deleted or else duplicate entry error will appear
					   $insertSQL2 = sprintf("INSERT INTO tindakandirujuk (
    NoRujukan,
  TindakanDirujuk,
  PegawaiDirujuk,
  TimeSubmit) VALUES 
  
  
  (%s,%s,%s,now())",
                      GetSQLValueString($_POST['NoRujukan'], "text"),
                       GetSQLValueString($_POST['textarea2'], "text"),
					   GetSQLValueString($_POST['TagUser'], "text")
					    
					   
					   );
					   

  mysql_select_db($database_Connection1, $Connection1);
  $Result1 = mysql_query($insertSQL, $Connection1) or die(mysql_error());
$Result2 = mysql_query($insertSQL2, $Connection1) or die(mysql_error());
  $insertGoTo = "DADD2019.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo '<script language="javascript">';
echo 'alert("Aduan has successfully submitted")';
echo '</script>';
  header(sprintf("Location: %s", $insertGoTo));
}
$UsernameLogin=$_SESSION['Username'];
mysql_select_db($database_Connection1, $Connection1);
$query_KategoriAduan = "SELECT NamaAduan FROM kategoriaduan ";
$KategoriAduan = mysql_query($query_KategoriAduan, $Connection1) or die(mysql_error());
$row_KategoriAduan = mysql_fetch_assoc($KategoriAduan);
$totalRows_KategoriAduan = mysql_num_rows($KategoriAduan);

mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName = "SELECT * FROM department";
$DepartmentName = mysql_query($query_DepartmentName, $Connection1) or die(mysql_error());
$row_DepartmentName = mysql_fetch_assoc($DepartmentName);
$totalRows_DepartmentName = mysql_num_rows($DepartmentName);



//To display the DUN Kawasan
mysql_select_db($database_Connection1, $Connection1);
$query_DunKawasan = "SELECT * FROM dunkawasan";
$DunKawasan = mysql_query($query_DunKawasan, $Connection1) or die(mysql_error());
$row_DunKawasan = mysql_fetch_assoc($DunKawasan);
$totalRows_DunKawasan = mysql_num_rows($DunKawasan);



//To merge the DunKawasan with Nama Kawasan where DUN ='N4'
mysql_select_db($database_Connection1, $Connection1);
$query_DunKawasan1 = "SELECT * FROM dunkawasan INNER JOIN kawasanaduan ON kawasanaduan.IDDUN=dunkawasan.ID where ID='1'";
$DunKawasan1 = mysql_query($query_DunKawasan1, $Connection1) or die(mysql_error());
$row_DunKawasan1 = mysql_fetch_assoc($DunKawasan1);
$totalRows_DunKawasan1 = mysql_num_rows($DunKawasan1);


//To merge the DunKawasan with Nama Kawasan where DUN ='N5'
mysql_select_db($database_Connection1, $Connection1);
$query_DunKawasan2 = "SELECT * FROM dunkawasan INNER JOIN kawasanaduan ON kawasanaduan.IDDUN=dunkawasan.ID where ID='2'";
$DunKawasan2 = mysql_query($query_DunKawasan2, $Connection1) or die(mysql_error());
$row_DunKawasan2 = mysql_fetch_assoc($DunKawasan2);
$totalRows_DunKawasan2 = mysql_num_rows($DunKawasan2);

//To merge the DunKawasan with Nama Kawasan where DUN ='N6'
mysql_select_db($database_Connection1, $Connection1);
$query_DunKawasan3 = "SELECT * FROM dunkawasan INNER JOIN kawasanaduan ON kawasanaduan.IDDUN=dunkawasan.ID where ID='3'";
$DunKawasan3 = mysql_query($query_DunKawasan3, $Connection1) or die(mysql_error());
$row_DunKawasan3 = mysql_fetch_assoc($DunKawasan3);
$totalRows_DunKawasan3 = mysql_num_rows($DunKawasan3);

//To merge the DunKawasan with Nama Kawasan where DUN ='N7'
mysql_select_db($database_Connection1, $Connection1);
$query_DunKawasan4 = "SELECT * FROM dunkawasan INNER JOIN kawasanaduan ON kawasanaduan.IDDUN=dunkawasan.ID where ID='4'";
$DunKawasan4 = mysql_query($query_DunKawasan4, $Connection1) or die(mysql_error());
$row_DunKawasan4 = mysql_fetch_assoc($DunKawasan4);
$totalRows_DunKawasan4 = mysql_num_rows($DunKawasan4);

//To merge the DunKawasan with Nama Kawasan where DUN ='N8'
mysql_select_db($database_Connection1, $Connection1);
$query_DunKawasan5 = "SELECT * FROM dunkawasan INNER JOIN kawasanaduan ON kawasanaduan.IDDUN=dunkawasan.ID where ID='5'";
$DunKawasan5 = mysql_query($query_DunKawasan5, $Connection1) or die(mysql_error());
$row_DunKawasan5 = mysql_fetch_assoc($DunKawasan5);
$totalRows_DunKawasan5 = mysql_num_rows($DunKawasan5);





//To display department again
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentNameNo2 = "SELECT * FROM department";
$DepartmentNameNo2 = mysql_query($query_DepartmentNameNo2, $Connection1) or die(mysql_error());
$row_DepartmentNameNo2 = mysql_fetch_assoc($DepartmentNameNo2);
$totalRows_DepartmentNameNo2 = mysql_num_rows($DepartmentNameNo2);

//To match jabatan with department with JABATAN ID 1
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName1 = "SELECT DepartmentName FROM department INNER JOIN Jabatan 
ON jabatan.ID= Department.IDJabatan where IDJabatan='1'";
$DepartmentName1 = mysql_query($query_DepartmentName1, $Connection1) or die(mysql_error());
$row_DepartmentName1 = mysql_fetch_assoc($DepartmentName1);
$totalRows_DepartmentName1 = mysql_num_rows($DepartmentName1);

//To match jabatan with department with JABATAN ID 2
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName2 = "SELECT DepartmentName FROM department INNER JOIN Jabatan 
ON jabatan.ID= Department.IDJabatan where IDJabatan='2'";
$DepartmentName2 = mysql_query($query_DepartmentName2, $Connection1) or die(mysql_error());
$row_DepartmentName2 = mysql_fetch_assoc($DepartmentName2);
$totalRows_DepartmentName2 = mysql_num_rows($DepartmentName2);


//To match jabatan with department with JABATAN ID 3
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName3 = "SELECT DepartmentName FROM department INNER JOIN Jabatan 
ON jabatan.ID= Department.IDJabatan where IDJabatan='3'";
$DepartmentName3 = mysql_query($query_DepartmentName3, $Connection1) or die(mysql_error());
$row_DepartmentName3 = mysql_fetch_assoc($DepartmentName3);
$totalRows_DepartmentName3 = mysql_num_rows($DepartmentName3);
//To match jabatan with department with JABATAN ID 4
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName4 = "SELECT DepartmentName FROM department INNER JOIN Jabatan 
ON jabatan.ID= Department.IDJabatan where IDJabatan='4'";
$DepartmentName4 = mysql_query($query_DepartmentName4, $Connection1) or die(mysql_error());
$row_DepartmentName4 = mysql_fetch_assoc($DepartmentName4);
$totalRows_DepartmentName4 = mysql_num_rows($DepartmentName4);
//To match jabatan with department with JABATAN ID 5
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName5 = "SELECT DepartmentName FROM department INNER JOIN Jabatan 
ON jabatan.ID= Department.IDJabatan where IDJabatan='5'";
$DepartmentName5 = mysql_query($query_DepartmentName5, $Connection1) or die(mysql_error());
$row_DepartmentName5 = mysql_fetch_assoc($DepartmentName5);
$totalRows_DepartmentName5 = mysql_num_rows($DepartmentName5);
//To match jabatan with department with JABATAN ID 6
mysql_select_db($database_Connection1, $Connection1);
$query_DepartmentName6 = "SELECT DepartmentName FROM department INNER JOIN Jabatan 
ON jabatan.ID= Department.IDJabatan where IDJabatan='6'";
$DepartmentName6 = mysql_query($query_DepartmentName6, $Connection1) or die(mysql_error());
$row_DepartmentName6 = mysql_fetch_assoc($DepartmentName6);
$totalRows_DepartmentName6 = mysql_num_rows($DepartmentName6);



$query_MergeDepartmentID="SELECT DepartmentName,OfficeLocation,Abbreviation from department 
INNER JOIN useraccount 
ON useraccount.DepartmentID = department.DepartmentID where Username='$UsernameLogin'";

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
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");    exit;

  }
}
//To retrieve from aduan table
mysql_select_db($database_Connection1, $Connection1);
$query_RecordsetAduan = "SELECT * FROM aduan";
//To generate id in the form
$RecordsetAduan = mysql_query($query_RecordsetAduan, $Connection1) or die(mysql_error());
$row_RecordsetAduan = mysql_fetch_assoc($RecordsetAduan);
$tableid=mysql_num_rows($RecordsetAduan)+1;


mysql_select_db($database_Connection1, $Connection1);
$query_jenisaduan = "SELECT * FROM jenisaduan";
$RecordsetJenisAduan = mysql_query($query_jenisaduan, $Connection1) or die(mysql_error());
$row_JenisAduan = mysql_fetch_assoc($RecordsetJenisAduan);
$totalRows_JenisAduan = mysql_num_rows($RecordsetJenisAduan);

mysql_select_db($database_Connection1, $Connection1);
$query_Jabatan = "SELECT * FROM jabatan";
$Jabatan = mysql_query($query_Jabatan, $Connection1) or die(mysql_error());
$row_Jabatan = mysql_fetch_assoc($Jabatan);
$totalRows_Jabatan = mysql_num_rows($Jabatan);


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
<?php
$colname_TagUser = "2";
if (isset($_GET['AccessLevel'])) {
  $colname_TagUser = $_GET['AccessLevel'];
}
mysql_select_db($database_Connection1, $Connection1);
$query_TagUser = sprintf("SELECT * FROM useraccount WHERE AccessLevel = %s", GetSQLValueString($colname_TagUser, "int"));
$TagUser = mysql_query($query_TagUser, $Connection1) or die(mysql_error());
$row_TagUser = mysql_fetch_assoc($TagUser);
$totalRows_TagUser = mysql_num_rows($TagUser);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Aduan Dalaman</title>
<link href="styledadd2019.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../Admin/assets/css/menubar.css">
<style>
#myDIV {
	display:none;
 
}
</style>
<script>

function showKawasan() {  
  var y = document.getElementById("DunKawasan").value;
  var y1=document.getElementById("kawasanAduan1");
   var y2=document.getElementById("kawasanAduan2");
  var y3=document.getElementById("kawasanAduan3");
   var y4=document.getElementById("kawasanAduan4");
   var y5=document.getElementById("kawasanAduan5");

  
if (y == 1) {
    y1.style.display = "block";
  document.getElementById("kawasanAduan2").style.display="none";
  document.getElementById("kawasanAduan3").style.display="none";
  document.getElementById("kawasanAduan4").style.display="none";
  document.getElementById("kawasanAduan5").style.display="none";


  
  } else if (y==2) {
  document.getElementById("kawasanAduan1").style.display="none";
  y2.style.display = "block";
    document.getElementById("kawasanAduan3").style.display="none";
  document.getElementById("kawasanAduan4").style.display="none";
  document.getElementById("kawasanAduan5").style.display="none";

 }  else if (y==3) {
    document.getElementById("kawasanAduan1").style.display="none";
      document.getElementById("kawasanAduan2").style.display="none";
  y3.style.display = "block";
  document.getElementById("kawasanAduan4").style.display="none";
  document.getElementById("kawasanAduan5").style.display="none";
  
  
 }else if (y==4) {
    document.getElementById("kawasanAduan1").style.display="none";
      document.getElementById("kawasanAduan2").style.display="none";
 document.getElementById("kawasanAduan3").style.display="none";
  y4.style.display = "block";
  document.getElementById("kawasanAduan5").style.display="none";
}else if (y==5) {
    document.getElementById("kawasanAduan1").style.display="none";
      document.getElementById("kawasanAduan2").style.display="none";
 document.getElementById("kawasanAduan3").style.display="none";
   document.getElementById("kawasanAduan4").style.display="none";
   y5.style.display = "block";
}
}



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
function showDepartment() {
  var x = document.getElementById("JabatanDirujuk").value;
  var x1=document.getElementById("BahagianDirujuk1");
   var x2=document.getElementById("BahagianDirujuk2");
    var x3=document.getElementById("BahagianDirujuk3");
	 var x4=document.getElementById("BahagianDirujuk4");
	  var x5=document.getElementById("BahagianDirujuk5");
	   var x6=document.getElementById("BahagianDirujuk6");
	
if (x == 1) {
    x1.style.display = "block";
	document.getElementById("BahagianDirujuk2").style.display="none";
	document.getElementById("BahagianDirujuk3").style.display="none";
	document.getElementById("BahagianDirujuk4").style.display="none";
	document.getElementById("BahagianDirujuk5").style.display="none";
	document.getElementById("BahagianDirujuk6").style.display="none";
	
  } else if (x==2) {
	document.getElementById("BahagianDirujuk1").style.display="none";
	x2.style.display = "block";
	document.getElementById("BahagianDirujuk3").style.display="none";
	document.getElementById("BahagianDirujuk4").style.display="none";
	document.getElementById("BahagianDirujuk5").style.display="none";
	document.getElementById("BahagianDirujuk6").style.display="none";
 } else if (x==3) {
    document.getElementById("BahagianDirujuk1").style.display="none";
	document.getElementById("BahagianDirujuk2").style.display="none";
	x3.style.display = "block";
	document.getElementById("BahagianDirujuk4").style.display="none";
	document.getElementById("BahagianDirujuk5").style.display="none";
	document.getElementById("BahagianDirujuk6").style.display="none";
	} else if (x==4) {
    document.getElementById("BahagianDirujuk1").style.display="none";
	document.getElementById("BahagianDirujuk2").style.display="none";
	document.getElementById("BahagianDirujuk3").style.display="none";
	x4.style.display = "block";
	document.getElementById("BahagianDirujuk5").style.display="none";
	document.getElementById("BahagianDirujuk6").style.display="none";
	} else if (x==5) {
    document.getElementById("BahagianDirujuk1").style.display="none";
	document.getElementById("BahagianDirujuk2").style.display="none";
	document.getElementById("BahagianDirujuk3").style.display="none";
	document.getElementById("BahagianDirujuk4").style.display="none";
	x5.style.display = "block";
	document.getElementById("BahagianDirujuk6").style.display="none";
	} else if (x==6) {
   document.getElementById("BahagianDirujuk1").style.display="none";
	document.getElementById("BahagianDirujuk2").style.display="none";
	document.getElementById("BahagianDirujuk3").style.display="none";
	document.getElementById("BahagianDirujuk4").style.display="none";
	document.getElementById("BahagianDirujuk5").style.display="none";
	x6.style.display = "block";
	}
	
}
function CalculateDate(){

var date1 = document.getElementById("TarikhAduanDitutup").value;
var date2 = document.getElementById("RealTarikh").value;

date1 = new Date(date1).getTime();
date2 = new Date(date2).getTime();
var timeDiff = Math.abs(date1-date2);
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
document.getElementById("DayCounting").value= diffDays + " Days";
}
function addDirujuk(){
	
  var table = document.getElementById("myTable");
  var row = table.insertRow(1);
  var cell1 = row.insertCell(0);
 var cell1 = row.insertCell(1);
  var cell1 = row.insertCell(2);
  cell1.innerHTML = "Tindakan bahagian Dirujuk";
  var cell1 = row.insertCell(3);
  cell1.innerHTML = "<textarea id='textarea2'>";

}

</script>

</head>

<body>
<div class="topnav" id="myTopnav">
  <a style=" background-color:#0FED56;">Sistem Aduan Dalaman DBKU</a>
  <a href="#" >Home</a>

 
  <div class="dropdown">
    <button class="dropbtn">Aduan Management
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <a href="ViewAduanUser.php" onclick="showModal()">View Aduan
</a>
  
  
    </div>
  </div> 
  <a href="#about">About</a>
    <a href="<?php echo $logoutAction ?>" class="dropbtn">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<p>
  <?php
date_default_timezone_set('Asia/Kuala_Lumpur');
?>
<form  name="form1" method="POST" action="<?php echo $addFormAction; ?>" class="contact100-form validate-form" align="center">
    <table width="980" border="1" align="center" bgcolor="#A7B3FF">
</p>
<p>Hello,<?php echo $row_Recordset1['Name']; ?></p>
  <tbody>
    <tr id="tab1">
   
      <td><center>DATA ADUAN DALAMAN DBKU</center><br></td>
   
    </tr>
  </tbody>
</table>
<table id ="myTable" border="1" bgcolor="#CCD9FF">
  <tbody id="tab2">
      <tr >
      <td><label>No. Kes Aduan</label></td>
      <td><input type="text" name="NoRujukan" id="NoRujukan" style="background-color:#F4EBEB" value="AD/<?php echo date("Y/m/d");?>-<?php echo $tableid;?>" readonly></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   <!-- <tr >      
      <td>No ID Aduan<br></td>
      <td width="200"><input type="text" name="textfield" id="textfield" value="<?php echo $tableid;?>"  style="background-color:#F4EBEB" readonly></td>
      <td width="150">Tindakan Bahagian Dirujuk <br></td>
      <td>
        <textarea name="textarea2" id="textarea2" required></textarea><select name="TagUser" id="TagUser">
                      <?php do { ?>
              <option value="<?php echo $row_TagUser['Username']; ?>"><?php echo $row_TagUser['Name']; ?></option>
              <?php } while ($row_TagUser = mysql_fetch_assoc($TagUser)); ?>

            </select></td>
		<td><input type="button" value="+" onClick="addDirujuk()" class="button" id="plus">
		
		
		</td>
        
    </tr>-->
    <tr>
    <td><label>Nama Pengadu</label></td>
    <td><input type="text" name="NamaPengadu" id="NamaPengadu"  required></td>
 </tr>
    <tr >
      <td>Tarikh<br></td>
      <td><input type="text" name="Tarikh" id="Tarikh" value="<?php echo date('d/m/Y ', time());?>" readonly>
      <input type="hidden" name="RealTarikh" id="RealTarikh" value="<?php echo date('Y/m/d ', time());?>" readonly></td>
      
      <td><label></label></td>
      <td>   </div></td>
    

    </tr>
    
    <tr >
      <td>Masa<br></td>
      <td><input type="text" name="textfield3" id="textfield3"  value="<?php echo date('h:i:s a ', time());?>" readonly></td>
      <td></td>
      <td></td>
    </tr>
    <tr >
      <td><label>Kategori</label></td>
      <td><select name="kategoriAduan" id="kategoriAduan">
                      <?php do { ?>
              <option value="<?php echo $row_KategoriAduan['NamaAduan']; ?>"><?php echo $row_KategoriAduan['NamaAduan']; ?></option>
              <?php } while ($row_KategoriAduan = mysql_fetch_assoc($KategoriAduan)); ?>

            </select></td>
      <td><!--<label>Status Aduan</label>--></td>
      <td><table width="600" border="1">
        <tbody>
          <!--<tr>
          
            <td><center><label>Tarikh Aduan Ditutup</label></center></td>
            <td><input type="date" id="TarikhAduanDitutup" id="TarikhAduanDitutup" onchange="CalculateDate()" min="<?php echo date('Y-m-d'); ?>" ?></td>
          </tr>-->
        </tbody>
      </table></td>
    </tr>
    <tr >
      <td><label>Perkara</label></td>
      <td><textarea rows="8" cols="50" name="MaklumatAduan" id="MaklumatAduan" ></textarea> </td>
      <td></td>
      <td><table width="600" border="0">
        <tbody>
          <tr>
            <td><!--<input type="text" id="DayCounting" style="background-color:#F4EBEB" readonly>--></td>
              <td width="300"><!--<label><center>Catatan</center></label>--></td>
            <td width="300"><!--<input type="text" name="textfield7" id="textfield7">-->Kawasan DUN </td>
          
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr >
      <td>Kawasan DUN
        <!--  **This code was hide for jenis Aduan because it wasn`t confirm with the user <label>Jenis Aduan</label>--></td>
      <td><select name="DunKawasan" id="DunKawasan" onchange="showKawasan()">
                      <?php do { ?>
      <option value="<?php echo $row_DunKawasan['ID']; ?>"><?php echo $row_DunKawasan['Abbreviation']; ?>-<?php echo $row_DunKawasan['NamaDun']; ?></option>
              <?php } while ($row_DunKawasan = mysql_fetch_assoc($DunKawasan)); ?>




        <!--<select name="JenisAduan" id="JenisAduan">
                      <?php do { ?>
              <option value="<?php echo $row_JenisAduan['NamaJenisAduan']; ?>"><?php echo $row_JenisAduan['NamaJenisAduan']; ?></option>
              <?php } while ($row_JenisAduan = mysql_fetch_assoc($RecordsetJenisAduan)); ?>-->
      <td>
     
      <td>
      <table width="600" border="1">
        <tbody>
        <tr>
                 <td><form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="button" id="button" value="Find Record" class="button">
   
</form>
</tr>
    <tr >
      <td><label>Kawasan Aduan:</label></td>
      <td><select name="kawasanAduan" id="kawasanAduan1" >
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan1['NamaKawasan']; ?>"><?php echo $row_DunKawasan1['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan1 = mysql_fetch_assoc($DunKawasan1)); ?>             
        </select>
        
        
        
        <select name="kawasanAduan" id="kawasanAduan2" style="display:none">
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan2['NamaKawasan']; ?>"><?php echo $row_DunKawasan2['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan2 = mysql_fetch_assoc($DunKawasan2)); ?>             
        </select>
        
          <select name="kawasanAduan" id="kawasanAduan3" style="display:none">
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan3['NamaKawasan']; ?>"><?php echo $row_DunKawasan3['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan3 = mysql_fetch_assoc($DunKawasan3)); ?>             
        </select>
          <select name="kawasanAduan" id="kawasanAduan4" style="display:none">
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan4['NamaKawasan']; ?>"><?php echo $row_DunKawasan4['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan4 = mysql_fetch_assoc($DunKawasan4)); ?>             
        </select>
          <select name="kawasanAduan" id="kawasanAduan5" style="display:none">
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan5['NamaKawasan']; ?>"><?php echo $row_DunKawasan5['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan5 = mysql_fetch_assoc($DunKawasan5)); ?>             
        </select>
        
        
        
        
        </td>
      <td>&nbsp;</td>
      <td></td>
    </tr>
  
    <tr >
      <td><label>Jabatan</label></td>
    <td>
     <select name="JabatanDirujuk" id="JabatanDirujuk" onchange="showDepartment()">
                      <?php do { ?>
              <option value=<?php echo $row_Jabatan['ID']; ?>><?php echo $row_Jabatan['Abbreviation']; ?>-<?php echo $row_Jabatan['NamaJabatan']; ?></option>
              <?php } while ($row_Jabatan = mysql_fetch_assoc($Jabatan)); ?></select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
<tr>
      <td><label>Bahagian Pengadu </label></td>
      <td>
      
      <select name="BahagianDirujuk1" id="BahagianDirujuk1" >
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName1['DepartmentName']; ?>><?php echo $row_DepartmentName1['DepartmentName']; ?>-<?php echo $row_DepartmentName1['DepartmentName']; ?></option>
              <?php } while($row_DepartmentName1 = mysql_fetch_assoc($DepartmentName1)); ?></select>
              
              
             <select name="BahagianDirujuk2" id="BahagianDirujuk2" style="display:none">
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName2['DepartmentName']; ?>><?php echo $row_DepartmentName2['DepartmentName']; ?>-<?php echo $row_DepartmentName2['DepartmentName']; ?></option>
              <?php } while($row_DepartmentName2 = mysql_fetch_assoc($DepartmentName2)); ?></select>
              
              <select name="BahagianDirujuk3" id="BahagianDirujuk3" style="display:none">
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName3['DepartmentName']; ?>><?php echo $row_DepartmentName3['DepartmentName']; ?>-<?php echo $row_DepartmentName3['DepartmentName']; ?></option>
              <?php } while($row_DepartmentName3 = mysql_fetch_assoc($DepartmentName3)); ?></select>
              
              
              <select name="BahagianDirujuk4" id="BahagianDirujuk4" style="display:none">
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName4['DepartmentName']; ?>><?php echo $row_DepartmentName4['DepartmentName']; ?>-<?php echo $row_DepartmentName4['DepartmentName']; ?></option>
              <?php } while($row_DepartmentName4 = mysql_fetch_assoc($DepartmentName4)); ?></select>
              
              
              <select name="BahagianDirujuk5" id="BahagianDirujuk5" style="display:none">
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName5['DepartmentName']; ?>><?php echo $row_DepartmentName5['DepartmentName']; ?>-<?php echo $row_DepartmentName5['DepartmentName']; ?></option>
              <?php } while($row_DepartmentName5 = mysql_fetch_assoc($DepartmentName5)); ?></select>
              
              <select name="BahagianDirujuk6" id="BahagianDirujuk6" style="display:none">
                      <?php do { ?>
              <option value=<?php echo $row_DepartmentName6['DepartmentName']; ?>><?php echo $row_DepartmentName6['DepartmentName']; ?>-<?php echo $row_DepartmentName6['DepartmentName']; ?></option>
              <?php } while($row_DepartmentName6 = mysql_fetch_assoc($DepartmentName6)); ?></select>
              
              
              
              
              
              </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr >
      <td><label>Saluran</label></td>
      <td><select name="SaluranAduan" id="SaluranAduan" style="width: 100px">
      <option value="Staff Dalaman">Staff Dalaman
      </option>
       <option value="Pegawai Kawasan">Pegawai Kawasan
      </option>
       <option value="CCTV">CCTV
      </option>
       <option value="Skuad Ronda Bantu">Skuad Ronda Bantu
      </option>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  
    <tr >
      <td><label>Bahagian Kes Dirujuk</label></td>
      
      <td><select name="BahagianDirujuk" id="BahagianDirujuk" >
      <?php do { ?>
       
              <option value=<?php echo $row_DepartmentNameNo2['Abbreviation']; ?>><?php echo $row_DepartmentNameNo2['Abbreviation']; ?>-<?php echo $row_DepartmentNameNo2['DepartmentName']; ?></option>
              <?php } while ($row_DepartmentNameNo2 = mysql_fetch_assoc($DepartmentNameNo2)); ?>
      </select></td>
      
      <td >  <button type="submit" name="Submit" id="Submit" value="Submit" onClick="myFunction()" class="button">Save Record</button></td>
    </tr>



 
 <input type="hidden" name="MM_insert" value="form1">

  <input type="hidden" name="UsernamePengadu" value="<?php echo $row_Recordset1['Username']; ?>">
  <input type="hidden" name="NamaAkaunPengadu" value="<?php echo $row_Recordset1['Name']; ?>">
</form>	

</body>
</html>
<?php
mysql_free_result($KategoriAduan);

mysql_free_result($Jabatan);

mysql_free_result($TagUser);
?>

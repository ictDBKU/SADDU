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
  SubCategory,
  MaklumatAduan,
  KawasanAduan,
  AlamatAduan,
  SaluranAduan,
  StatusAduan,
  NamaPengadu,
  UsernamePengadu,
  NoTelefon,
  PIC,
  TimeSubmit) VALUES  (%s,%s,%s,%s,%s,%s,%s,'Pending',%s,%s,%s,%s,now())",
                       GetSQLValueString($_POST['NoRujukan'], "text"),
                       GetSQLValueString($_POST['kategoriAduan'], "text"),
					   GetSQLValueString($_POST['SubKategoriDirujuk'], "text"),
					   GetSQLValueString($_POST['MaklumatAduan'], "text"),
                       GetSQLValueString($_POST['kawasanAduan'], "text"),
					   GetSQLValueString($_POST['address'], "text"),
					   GetSQLValueString($_POST['SaluranAduan'], "text"),
					   GetSQLValueString($_POST['NamaPengadu'], "text"),
					   GetSQLValueString($_POST['UsernamePengadu'], "text"),	   
					   GetSQLValueString($_POST['NoTelefon'], "text"),	
					   GetSQLValueString($_POST['Personincharge'], "text")
					   );
					   
					
					
					
					
					
					
				   $insertSQL2 = sprintf("INSERT INTO tindakandirujuk (
    NoRujukan,
  TindakanDirujuk,
  UsernamePegawaiDirujuk,
  TindakanTimeSubmit) VALUES 
  
  
  (%s,'',%s,now())",
                      GetSQLValueString($_POST['NoRujukan'], "text"),
                      
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
 // header(sprintf("Location: %s", $insertGoTo));
}
$UsernameLogin=$_SESSION['Username'];


//Query to display kategori aduan
mysql_select_db($database_Connection1, $Connection1);
$queryPIC = "SELECT Username FROM aduan INNER JOIN useraccount on useraccount.ID = aduan.PIC ";
$PIC = mysql_query($queryPIC, $Connection1) or die(mysql_error());
$row_queryPIC = mysql_fetch_assoc($PIC );
$totalRows_queryPIC = mysql_num_rows($PIC );




//Query to display kategori aduan
mysql_select_db($database_Connection1, $Connection1);
$query_KategoriAduan = "SELECT * FROM kategoriaduan ";
$KategoriAduan = mysql_query($query_KategoriAduan, $Connection1) or die(mysql_error());
$row_KategoriAduan = mysql_fetch_assoc($KategoriAduan);
$totalRows_KategoriAduan = mysql_num_rows($KategoriAduan);


//Sql merge the subkategori with kategori where kategori ID ='1'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori1 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='1'";
$subkategori1 = mysql_query($query_subkategori1, $Connection1) or die(mysql_error());
$row_subkategori1 = mysql_fetch_assoc($subkategori1);


//Sql merge the subkategori with kategori where kategori ID ='2'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori2 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='2'";
$subkategori2 = mysql_query($query_subkategori2, $Connection1) or die(mysql_error());
$row_subkategori2 = mysql_fetch_assoc($subkategori2);


//Sql merge the subkategori with kategori where kategori ID ='3'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori3 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='3'";
$subkategori3 = mysql_query($query_subkategori3, $Connection1) or die(mysql_error());
$row_subkategori3 = mysql_fetch_assoc($subkategori3);

//Sql merge the subkategori with kategori where kategori ID ='4'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori4 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='4'";
$subkategori4 = mysql_query($query_subkategori4, $Connection1) or die(mysql_error());
$row_subkategori4 = mysql_fetch_assoc($subkategori4);

//Sql merge the subkategori with kategori where kategori ID ='5'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori5 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='5'";
$subkategori5 = mysql_query($query_subkategori5, $Connection1) or die(mysql_error());
$row_subkategori5 = mysql_fetch_assoc($subkategori5);

//Sql merge the subkategori with kategori where kategori ID ='6'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori6 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='6'";
$subkategori6 = mysql_query($query_subkategori6, $Connection1) or die(mysql_error());
$row_subkategori6 = mysql_fetch_assoc($subkategori6);

//Sql merge the subkategori with kategori where kategori ID ='7'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori7 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='7'";
$subkategori7 = mysql_query($query_subkategori7, $Connection1) or die(mysql_error());
$row_subkategori7 = mysql_fetch_assoc($subkategori7);

//Sql merge the subkategori with kategori where kategori ID ='8'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori8 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='8'";
$subkategori8 = mysql_query($query_subkategori8, $Connection1) or die(mysql_error());
$row_subkategori8 = mysql_fetch_assoc($subkategori8);

//Sql merge the subkategori with kategori where kategori ID ='9'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori9 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='9'";
$subkategori9 = mysql_query($query_subkategori9, $Connection1) or die(mysql_error());
$row_subkategori9 = mysql_fetch_assoc($subkategori9);

//Sql merge the subkategori with kategori where kategori ID ='10'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori10 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='10'";
$subkategori10 = mysql_query($query_subkategori10, $Connection1) or die(mysql_error());
$row_subkategori10 = mysql_fetch_assoc($subkategori10);

//Sql merge the subkategori with kategori where kategori ID ='11'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori11 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='11'";
$subkategori11 = mysql_query($query_subkategori10, $Connection1) or die(mysql_error());
$row_subkategori11 = mysql_fetch_assoc($subkategori10);

//Sql merge the subkategori with kategori where kategori ID ='12'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori12 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='12'";
$subkategori12 = mysql_query($query_subkategori12, $Connection1) or die(mysql_error());
$row_subkategori12 = mysql_fetch_assoc($subkategori12);

//Sql merge the subkategori with kategori where kategori ID ='13'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori13 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='13'";
$subkategori13 = mysql_query($query_subkategori13, $Connection1) or die(mysql_error());
$row_subkategori13 = mysql_fetch_assoc($subkategori13);

//Sql merge the subkategori with kategori where kategori ID ='14'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori14 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='14'";
$subkategori14 = mysql_query($query_subkategori14, $Connection1) or die(mysql_error());
$row_subkategori14 = mysql_fetch_assoc($subkategori14);


//Sql merge the subkategori with kategori where kategori ID ='15'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori15 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='15'";
$subkategori15 = mysql_query($query_subkategori15, $Connection1) or die(mysql_error());
$row_subkategori15 = mysql_fetch_assoc($subkategori15);

//Sql merge the subkategori with kategori where kategori ID ='16'
mysql_select_db($database_Connection1, $Connection1);
$query_subkategori16 = "SELECT * FROM kategoriaduan INNER JOIN subkategoriaduan ON subkategoriaduan.KategoriID=kategoriaduan.IDKategoriAduan where IDKategoriAduan='16'";
$subkategori16 = mysql_query($query_subkategori16, $Connection1) or die(mysql_error());
$row_subkategori16 = mysql_fetch_assoc($subkategori16);


//Sql to merge kategori with PIC
mysql_select_db($database_Connection1, $Connection1);
$query_KategoriMatchPIC = "SELECT Abbreviation,Name FROM kategoriaduan INNER JOIN useraccount ON useraccount.ID=kategoriaduan.PIC INNER JOIN department ON department.DepartmentID=useraccount.DepartmentID 
  ";
$KategoriMatchPIC = mysql_query($query_KategoriMatchPIC, $Connection1) or die(mysql_error());
$row_KategoriMatchPIC = mysql_fetch_assoc($KategoriMatchPIC);

$KategoriMatchPersonInCharge;



//Testing third time commit
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

//To display bahagian dirujuk merge with Kategori aduan




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


/*mysql_select_db($database_Connection1, $Connection1);
$query_jenisaduan = "SELECT * FROM jenisaduan";
$RecordsetJenisAduan = mysql_query($query_jenisaduan, $Connection1) or die(mysql_error());
$row_JenisAduan = mysql_fetch_assoc($RecordsetJenisAduan);
$totalRows_JenisAduan = mysql_num_rows($RecordsetJenisAduan);*/
//Query to display all the jabatan
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
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&radius=500&key=&libraries=places&callback=initAutocomplete">
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>


<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
     #myMap {
   height: 350px;
   width: 750px;
}
    </style>
<style>
#myDIV {
	display:none;
 .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }

}
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
</style>
<script>
function showModal(){
document.getElementById('id01').style.display='block';
}


</script>
<script>
function showKawasan() {  
  var y = document.getElementById("DunKawasan").value;
  var y1=document.getElementById("kawasanAduan1");
   var y2=document.getElementById("kawasanAduan2");
  var y3=document.getElementById("kawasanAduan3");
   var y4=document.getElementById("kawasanAduan4");
   var y5=document.getElementById("kawasanAduan5");

  
if (y == 1) {
	 document.getElementById("kawasanAduan1").removeAttribute('disabled');
    y1.style.display = "block";
	document.getElementById("kawasanAduan2").disabled=true;
	y2.style.display="none";
	document.getElementById("kawasanAduan3").disabled=true;
    y3.style.display="none";
	document.getElementById("kawasanAduan4").disabled=true;
	y4.style.display="none";
    document.getElementById("kawasanAduan5").disabled=true;
	y5.style.display="none";


  
  } else if (y==2) {
  document.getElementById("kawasanAduan1").disabled=true;
  y1.style.display="none";
  document.getElementById("kawasanAduan2").removeAttribute('disabled');
  y2.style.display = "block";
  document.getElementById("kawasanAduan3").disabled=true;
  y3.style.display="none";
  document.getElementById("kawasanAduan4").disabled=true;
  y4.style.display="none";
  document.getElementById("kawasanAduan5").disabled=true;
  y5.style.display="none";
  

 }  else if (y==3) {
   document.getElementById("kawasanAduan1").disabled=true;
   y1.style.display="none";
   document.getElementById("kawasanAduan2").disabled=true;
   y2.style.display="none";
   document.getElementById("kawasanAduan3").removeAttribute('disabled');
   y3.style.display = "block";
   document.getElementById("kawasanAduan4").disabled=true;
   y4.style.display="none";
   document.getElementById("kawasanAduan5").disabled=true;
   y5.style.display="none";
  
 }else if (y==4) {
   document.getElementById("kawasanAduan1").disabled=true;
   y1.style.display="none";
   document.getElementById("kawasanAduan2").disabled=true;
    y2.style.display="none";
   document.getElementById("kawasanAduan3").disabled=true;
    y3.style.display = "none";
  document.getElementById("kawasanAduan4").removeAttribute('disabled');
  y4.style.display = "block";
   document.getElementById("kawasanAduan5").disabled=true;
   y5.style.display="none";
}else if (y==5) {
	
  document.getElementById("kawasanAduan1").disabled=true;
   y1.style.display="none";
   document.getElementById("kawasanAduan2").disabled=true;
    y2.style.display="none";
   document.getElementById("kawasanAduan3").disabled=true;
    y3.style.display = "none";
   document.getElementById("kawasanAduan4").disabled=true;
   y4.style.display="none";
 document.getElementById("kawasanAduan5").removeAttribute('disabled');
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
function showSubkategori(){
	 var k = document.getElementById("kategoriAduan").value;
  var k1=document.getElementById("SubKategoriDirujuk1");
  var k2=document.getElementById("SubKategoriDirujuk2");
    var k3=document.getElementById("SubKategoriDirujuk3");
  var k4=document.getElementById("SubKategoriDirujuk4");
    var k5=document.getElementById("SubKategoriDirujuk5");
  var k6=document.getElementById("SubKategoriDirujuk6");
    var k7=document.getElementById("SubKategoriDirujuk7");
  var k8=document.getElementById("SubKategoriDirujuk8");
    var k9=document.getElementById("SubKategoriDirujuk9");
  var k10=document.getElementById("SubKategoriDirujuk10");
    var k11=document.getElementById("SubKategoriDirujuk11");
  var k12=document.getElementById("SubKategoriDirujuk12");
    var k13=document.getElementById("SubKategoriDirujuk13");
  var k14=document.getElementById("SubKategoriDirujuk14");
    var k15=document.getElementById("SubKategoriDirujuk15");
  var k16=document.getElementById("SubKategoriDirujuk16");
   
  

if (k == 1) {
	document.getElementById("TagUser").value = 'hartini';
	document.getElementById("SubKategoriDirujuk1").removeAttribute('disabled');
	k1.style.display="block";
	document.getElementById("Personincharge").value = '5';
    k2.style.display="none";
	document.getElementById("SubKategoriDirujuk2").disabled=true;
	k3.style.display="none";
	document.getElementById("SubKategoriDirujuk3").disabled=true;
	k4.style.display="none";
	document.getElementById("SubKategoriDirujuk4").disabled=true;
	k5.style.display="none";
	document.getElementById("SubKategoriDirujuk5").disabled=true;
	k6.style.display="none";
	document.getElementById("SubKategoriDirujuk6").disabled=true;
	k7.style.display="none";
	document.getElementById("SubKategoriDirujuk7").disabled=true;
	k8.style.display="none";
	document.getElementById("SubKategoriDirujuk8").disabled=true;
	k9.style.display="none";
	document.getElementById("SubKategoriDirujuk9").disabled=true;
	k10.style.display="none";
	document.getElementById("SubKategoriDirujuk10").disabled=true;
	k11.style.display="none";
	document.getElementById("SubKategoriDirujuk11").disabled=true;
	k12.style.display="none";
	document.getElementById("SubKategoriDirujuk12").disabled=true;
	k13.style.display="none";
	document.getElementById("SubKategoriDirujuk13").disabled=true;
	k14.style.display="none";
	document.getElementById("SubKategoriDirujuk14").disabled=true;
	k15.style.display="none";
	document.getElementById("SubKategoriDirujuk15").disabled=true;
	k16.style.display="none";
   document.getElementById("SubKategoriDirujuk16").disabled=true;

	
  } else if (k==2) {
	  document.getElementById("TagUser").value = 'hartini';
	  document.getElementById("Personincharge").value = '5';
	document.getElementById("SubKategoriDirujuk1").disabled=true;
	k1.style.display="none";
	document.getElementById("SubKategoriDirujuk2").removeAttribute('disabled');
	k2.style.display = "block";
    k3.style.display="none";
	document.getElementById("SubKategoriDirujuk3").disabled=true;
	k4.style.display="none";
	document.getElementById("SubKategoriDirujuk4").disabled=true;
	k5.style.display="none";
	document.getElementById("SubKategoriDirujuk5").disabled=true;
	k6.style.display="none";
	document.getElementById("SubKategoriDirujuk6").disabled=true;
	k7.style.display="none";
	document.getElementById("SubKategoriDirujuk7").disabled=true;
	k8.style.display="none";
	document.getElementById("SubKategoriDirujuk8").disabled=true;
	k9.style.display="none";
    document.getElementById("SubKategoriDirujuk9").disabled=true;
	k10.style.display="none";
	document.getElementById("SubKategoriDirujuk10").disabled=true;
	k11.style.display="none";
	document.getElementById("SubKategoriDirujuk11").disabled=true;
	k12.style.display="none";
	document.getElementById("SubKategoriDirujuk12").disabled=true;
	k13.style.display="none";
	document.getElementById("SubKategoriDirujuk13").disabled=true;
	k14.style.display="none";
	document.getElementById("SubKategoriDirujuk14").disabled=true;
	k15.style.display="none";
	document.getElementById("SubKategoriDirujuk15").disabled=true;
	k16.style.display="none";
	document.getElementById("SubKategoriDirujuk16").disabled=true;
	
 } else if (k==3) {
	 document.getElementById("TagUser").value = 'hartini';
	  document.getElementById("Personincharge").value = '5';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display = "block";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display="none";
	k9.style.display="none";
	k10.style.display="none";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
   
   document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
		
		
		
		
}else if (k==4) {
	document.getElementById("TagUser").value = 'emily';
	document.getElementById("Personincharge").value = '7';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display = "block";
k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display="none";
	k9.style.display="none";
	k10.style.display="none";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	document.getElementById("BahagianDirujuks").value = "ENV";
	
}else if (k==5) {
	document.getElementById("TagUser").value = 'emily';
	document.getElementById("Personincharge").value = '7';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display = "block";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display="none";
	k9.style.display="none";
	k10.style.display="none";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	
   document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
   
}
else if (k==6) {
	document.getElementById("TagUser").value = 'emily';
	document.getElementById("Personincharge").value = '7';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display = "block";
    k7.style.display="none";
	k8.style.display="none";
	k9.style.display="none";
	k10.style.display="none";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	 document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
    document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	}
else if (k==7) {
	document.getElementById("TagUser").value = 'juliza';
	document.getElementById("Personincharge").value = '8';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display = "block";
	k8.style.display="none";
	k9.style.display="none";
	k10.style.display="none";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
   document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
}else if (k==8) {
	document.getElementById("TagUser").value = 'norliza';
	document.getElementById("Personincharge").value = '9';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "block";
	k9.style.display="none";
	k10.style.display="none";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	}else if (k==9) {
		document.getElementById("TagUser").value = 'mustafa';
		document.getElementById("Personincharge").value = '10';
		k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "block";
	k10.style.display="none";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	
   document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	
	}else if (k==10) {
		document.getElementById("TagUser").value = 'bibiana';
	document.getElementById("Personincharge").value = '11';
		k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "none";
	k10.style.display = "block";
	k11.style.display="none";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	}else if (k==11) {
		document.getElementById("TagUser").value = 'jamayah';
		document.getElementById("Personincharge").value = '12';
		k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "none";
	k10.style.display = "none";
	k11.style.display = "block";
	k12.style.display="none";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	
	
	}else if (k==12) {
		document.getElementById("TagUser").value = 'norliza';
		document.getElementById("Personincharge").value = '9';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "none";
	k10.style.display = "none";
	k11.style.display = "none";
	k12.style.display = "block";
	k13.style.display="none";
	k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	}else if (k==13) {
		
		
		document.getElementById("TagUser").value = 'jacquline';
		document.getElementById("Personincharge").value = '13';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "none";
	k10.style.display = "none";
	k11.style.display = "none";
	k12.style.display = "none";
	k13.style.display = "block";
		k14.style.display="none";
	k15.style.display="none";
	k16.style.display="none";
	
		document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	}else if (k==14) {
		
		document.getElementById("TagUser").value = 'linie';
		document.getElementById("Personincharge").value = '14';
		
			k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "none";
	k10.style.display = "none";
	k11.style.display = "none";
	k12.style.display = "none";
	k13.style.display = "none";
	k14.style.display = "block";
	k15.style.display="none";
	k16.style.display="none";
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
   document.getElementById("SubKategoriDirujuk13").disabled=true;
   document.getElementById("SubKategoriDirujuk14").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk15").disabled=true;
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	}else if (k==15) {
		document.getElementById("TagUser").value = 'linie';
		document.getElementById("Personincharge").value = '14';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "none";
	k10.style.display = "none";
	k11.style.display = "none";
	k12.style.display = "none";
	k13.style.display = "none";
	k14.style.display = "none";
	k15.style.display = "block";
	k16.style.display = "none";
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
      document.getElementById("SubKategoriDirujuk13").disabled=true;
      document.getElementById("SubKategoriDirujuk14").disabled=true;
   document.getElementById("SubKategoriDirujuk15").removeAttribute('disabled');
   document.getElementById("SubKategoriDirujuk16").disabled=true;
	
	}else if (k==16) {
		document.getElementById("TagUser").value = 'maureen';
		document.getElementById("Personincharge").value = '15';
	k1.style.display="none";
	k2.style.display="none";
	k3.style.display="none";
	k4.style.display="none";
	k5.style.display="none";
	k6.style.display="none";
	k7.style.display="none";
	k8.style.display = "none";
	k9.style.display = "none";
	k10.style.display = "none";
	k11.style.display = "none";
	k12.style.display = "none";
	k13.style.display = "none";
	k14.style.display = "none";
	k15.style.display = "none";
	k16.style.display = "block";
	
	document.getElementById("SubKategoriDirujuk1").disabled=true;
   document.getElementById("SubKategoriDirujuk2").disabled=true;
   document.getElementById("SubKategoriDirujuk3").disabled=true;
   document.getElementById("SubKategoriDirujuk4").disabled=true;
   document.getElementById("SubKategoriDirujuk5").disabled=true;
   document.getElementById("SubKategoriDirujuk6").disabled=true;
   document.getElementById("SubKategoriDirujuk7").disabled=true;
   document.getElementById("SubKategoriDirujuk8").disabled=true;
   document.getElementById("SubKategoriDirujuk9").disabled=true;
   document.getElementById("SubKategoriDirujuk10").disabled=true;
   document.getElementById("SubKategoriDirujuk11").disabled=true;
   document.getElementById("SubKategoriDirujuk12").disabled=true;
      document.getElementById("SubKategoriDirujuk13").disabled=true;
      document.getElementById("SubKategoriDirujuk14").disabled=true;
      document.getElementById("SubKategoriDirujuk15").disabled=true;
	document.getElementById("SubKategoriDirujuk16").removeAttribute('disabled');
	}}

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
function hideMap(){
	document.getElementById('myMap').disabled="true";
}
function showMap()
{
document.getElementById('myMap').disabled="false";
document.getElementById('GoogleMap').style.display="block";
}

</script>

</head>

<body >
<div class="w3-container">
<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        
    <div id="GoogleMap" align="center">
<input id="pac-input" class="controls" type="text" placeholder="Search Box" style="width:600px">

    <div id="myMap"></div>
   </div>
      
    </div>
  </div>
</div>
<div class="topnav" id="myTopnav">
  <a style=" background-color:#0FED56;">Sistem Aduan Dalaman DBKU</a>
  <a href="#" >Report Aduan</a>

 
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
<form name="form1" method="POST" action="<?php echo $addFormAction; ?>" class="" align="center">
    <table width="980" border="1" align="center" bgcolor="#A7B3FF" >
</p>
<p>Hello,<?php echo $row_Recordset1['Name']; ?></p>
  <tbody>
    <tr id="tab1">
   
      <td><center>ADUAN DALAMAN</center><br></td>
   
    </tr>
  </tbody>
</table>
<table id="tab2" border="1" align="center" bgcolor="#CCD9FF" >
  <tbody id>
      <tr >
      <td ><label>No. Kes Aduan</label></td>
      <td><input type="text" name="NoRujukan" id="NoRujukan" style="background-color:#F4EBEB;width:100%" value="AD/<?php echo date("Y/m/d");?>-<?php echo $tableid;?>" readonly></td>
     
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

    <tr >
      <td>Tarikh<br></td>
      <td><input type="text" name="Tarikh" id="Tarikh" value="<?php echo date('d/m/Y ', time());?>" style="background-color:#F4EBEB;width:100%" readonly>
      <input type="hidden" name="RealTarikh" id="RealTarikh" value="<?php echo date('Y/m/d ', time());?>" readonly></td>
      
     

    </tr>
    
    <tr >
      <td>Masa<br></td>
      <td><input type="text" name="textfield3" id="textfield3"  value="<?php echo date('h:i a ', time());?>"  style="background-color:#F4EBEB;width:100%" readonly></td>
    
    </tr>
    <tr>
    <td><label>Nama Pengadu</label></td>
    <td style="padding:10px;"><input type="text" name="NamaPengadu" id="NamaPengadu"  style="width:100%" required></td>
 </tr>
 <tr>
    <td><label>No telefon</label></td>
    <td style="padding:10px;"><input type="text" name="NoTelefon" id="NoTelefon"  style="width:100%" pattern="\d*.{10,}" placeholder="Eg.0111234567" required></td>
 </tr>
    <tr >
      <td><label>Kategori</label></td>
      <td style="padding:10px"><select name="kategoriAduan" id="kategoriAduan" style="width:100%" onchange="showSubkategori()" >
                      <?php do { ?>
              <option value="<?php echo $row_KategoriAduan['IDKategoriAduan']; ?>"><?php echo $row_KategoriAduan['NamaAduan']; ?></option>
              <?php } while ($row_KategoriAduan = mysql_fetch_assoc($KategoriAduan)); ?>

            </select></td>
    <!--s<label>Status Aduan</label>--></td>
      
          <!--<tr>
          
            <td><center><label>Tarikh Aduan Ditutup</label></center></td>
            <td><input type="date" id="TarikhAduanDitutup" id="TarikhAduanDitutup" onchange="CalculateDate()" min="<?php echo date('Y-m-d'); ?>" ?></td>
          </tr>-->
      
     
    </tr>
    <tr>
    <td>Jenis:
    <td align="center" style="padding:10px"><select name="SubKategoriDirujuk" id="SubKategoriDirujuk1" style="width:100%">
                      <?php do { ?>
              <option value="<?php echo $row_subkategori1['NamaSub']; ?>"><?php echo $row_subkategori1['NamaSub']; ?> </option>
              <?php } while($row_subkategori1 = mysql_fetch_assoc($subkategori1)); ?></select>
              
             
             <select name="SubKategoriDirujuk" id="SubKategoriDirujuk2" style="display:none;width:100%">
              <?php do { ?>
              <option value="<?php echo $row_subkategori2['NamaSub']; ?>"><?php echo $row_subkategori2['NamaSub']; ?> </option>
              <?php } while($row_subkategori2 = mysql_fetch_assoc($subkategori2)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk3" style="display:none;width:100%">
                <?php do { ?>
              <option value="<?php echo $row_subkategori3['NamaSub']; ?>"><?php echo $row_subkategori3['NamaSub']; ?> </option>
              <?php } while($row_subkategori3 = mysql_fetch_assoc($subkategori3)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk4" style="display:none;width:100%">
                <?php do { ?>
              <option value="<?php echo $row_subkategori4['NamaSub']; ?>"><?php echo $row_subkategori4['NamaSub']; ?> </option>
              <?php } while($row_subkategori4 = mysql_fetch_assoc($subkategori4)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk5" style="display:none;width:100%">
                <?php do { ?>
              <option value="<?php echo $row_subkategori5['NamaSub']; ?>"><?php echo $row_subkategori5['NamaSub']; ?> </option>
              <?php } while($row_subkategori5 = mysql_fetch_assoc($subkategori5)); ?></select>
              
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk6" style="display:none;width:100%">
                <?php do { ?>
              <option value="<?php echo $row_subkategori6['NamaSub']; ?>"><?php echo $row_subkategori6['NamaSub']; ?> </option>
              <?php } while($row_subkategori6 = mysql_fetch_assoc($subkategori6)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk7" style="display:none;width:100%">
               <?php do { ?>
              <option value="<?php echo $row_subkategori7['NamaSub']; ?>"><?php echo $row_subkategori7['NamaSub']; ?> </option>
              <?php } while($row_subkategori7 = mysql_fetch_assoc($subkategori7)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk8" style="display:none;width:100%">
                <?php do { ?>
              <option value="<?php echo $row_subkategori8['NamaSub']; ?>"><?php echo $row_subkategori8['NamaSub']; ?> </option>
              <?php } while($row_subkategori8 = mysql_fetch_assoc($subkategori8)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk9" style="display:none;width:100%">
                <?php do { ?>
              <option value="<?php echo $row_subkategori9['NamaSub']; ?>"><?php echo $row_subkategori9['NamaSub']; ?> </option>
              <?php } while($row_subkategori9 = mysql_fetch_assoc($subkategori9)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk10" style="display:none;width:100%">
                  <?php do { ?>
              <option value="<?php echo $row_subkategori10['NamaSub']; ?>"><?php echo $row_subkategori10['NamaSub']; ?> </option>
              <?php } while($row_subkategori10 = mysql_fetch_assoc($subkategori10)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk11" style="display:none;width:100%">
                  <?php do { ?>
              <option value="<?php echo $row_subkategori11['NamaSub']; ?>"><?php echo $row_subkategori11['NamaSub']; ?> </option>
              <?php } while($row_subkategori11 = mysql_fetch_assoc($subkategori11)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk12" style="display:none;width:100%">
                 <?php do { ?>
              <option value="<?php echo $row_subkategori12['NamaSub']; ?>"><?php echo $row_subkategori12['NamaSub']; ?> </option>
              <?php } while($row_subkategori12 = mysql_fetch_assoc($subkategori12)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk13" style="display:none;width:100%">
               <?php do { ?>
              <option value="<?php echo $row_subkategori13['NamaSub']; ?>"><?php echo $row_subkategori13['NamaSub']; ?> </option>
              <?php } while($row_subkategori13 = mysql_fetch_assoc($subkategori13)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk14" style="display:none;width:100%">
                 <?php do { ?>
              <option value="<?php echo $row_subkategori14['NamaSub']; ?>"><?php echo $row_subkategori14['NamaSub']; ?> </option>
              <?php } while($row_subkategori14 = mysql_fetch_assoc($subkategori14)); ?></select>
             
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk15" style="display:none;width:100%">
               <?php do { ?>
              <option value="<?php echo $row_subkategori15['NamaSub']; ?>"><?php echo $row_subkategori15['NamaSub']; ?> </option>
              <?php } while($row_subkategori15 = mysql_fetch_assoc($subkategori15)); ?></select>
              
               <select name="SubKategoriDirujuk" id="SubKategoriDirujuk16" style="display:none;width:100%">
               <?php do { ?>
              <option value="<?php echo $row_subkategori16['NamaSub']; ?>"><?php echo $row_subkategori16['NamaSub']; ?> </option>
              <?php } while($row_subkategori16 = mysql_fetch_assoc($subkategori16)); ?></select>
               
              </td>
   
    <tr >
      <td>Kawasan DUN
        <!--  **This code was hide for jenis Aduan because it wasn`t confirm with the user <label>Jenis Aduan</label>--></td>
      <td style="padding:10px"><select name="DunKawasan" id="DunKawasan" onchange="showKawasan()" style="width:100%">
                      <?php do { ?>
      <option value="<?php echo $row_DunKawasan['ID']; ?>"><?php echo $row_DunKawasan['Abbreviation']; ?>-<?php echo $row_DunKawasan['NamaDun']; ?></option>
              <?php } while ($row_DunKawasan = mysql_fetch_assoc($DunKawasan)); ?>




        <!--<select name="JenisAduan" id="JenisAduan">
                      <?php do { ?>
              <option value="<?php echo $row_JenisAduan['NamaJenisAduan']; ?>"><?php echo $row_JenisAduan['NamaJenisAduan']; ?></option>
              <?php } while ($row_JenisAduan = mysql_fetch_assoc($RecordsetJenisAduan)); ?>-->
     
      
       
        <tr>
            <!--     <td><form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="button" id="button" value="Find Record" class="button">-->
   
</tr>
    <tr >
      <td><label>Kawasan Aduan:</label></td>
      <td align="center" style="padding:10px"><select name="kawasanAduan" id="kawasanAduan1" style="width:100%"  >
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan1['NamaKawasan']; ?>"><?php echo $row_DunKawasan1['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan1 = mysql_fetch_assoc($DunKawasan1)); ?>             
        </select>
        
         <select name="kawasanAduan" id="kawasanAduan2" style="display:none;width:100%" >
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan2['NamaKawasan']; ?>"><?php echo $row_DunKawasan2['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan2 = mysql_fetch_assoc($DunKawasan2)); ?>             
        </select>
        
          <select name="kawasanAduan" id="kawasanAduan3" style="display:none;width:100%" >
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan3['NamaKawasan']; ?>"><?php echo $row_DunKawasan3['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan3 = mysql_fetch_assoc($DunKawasan3)); ?>             
        </select>
          <select name="kawasanAduan" id="kawasanAduan4" style="display:none;width:100%"">
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan4['NamaKawasan']; ?>"><?php echo $row_DunKawasan4['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan4 = mysql_fetch_assoc($DunKawasan4)); ?>             
        </select>
          <select name="kawasanAduan" id="kawasanAduan5" style="display:none;width:100%" >
                      <?php do { ?>
    <option value="<?php echo $row_DunKawasan5['NamaKawasan']; ?>"><?php echo $row_DunKawasan5['NamaKawasan']; ?></option>
              <?php } while ($row_DunKawasan5 = mysql_fetch_assoc($DunKawasan5)); ?>             
        </select>
       
       
        
        
        
        
        </td>
        <tr>
        <td>Alamat Lokasi:</td>
        <td> <textarea rows="8" cols="50" name="address" id="address"/></textarea><input type="button" value="Choose from map" onClick="showModal()"></td>
</tr>
    <tr>
    
  
      <td><label>Maklumat:</label></td>
      <td ><textarea rows="8" cols="50" name="MaklumatAduan" id="MaklumatAduan" ></textarea> </td>
     </tr>
    
       
      <!--    <tr>
            <td><input type="text" id="DayCounting" style="background-color:#F4EBEB" readonly>
              <td width="300"><!--<label><center>Catatan</center></label>--></td>
           <!--<input type="text" name="textfield7" id="textfield7">
          
          </tr>-->
      
      
   
  
  
    <tr >
      <td><label>Saluran</label></td>
      <td style="padding:10px">
    <input type="radio" id="contactChoice1"
     name="SaluranAduan" value="Staff Dalaman">
    <label for="contactChoice1">Staff Dalaman</label>

    <input type="radio" id="contactChoice2"
     name="SaluranAduan" value="Pegawai Kawasan">
    <label for="contactChoice2">Pegawai Kawasan</label>

    <input type="radio" id="contactChoice3"
     name="SaluranAduan" value="CCTV">
    <label for="contactChoice3">CCTV</label>
    
     <input type="radio" id="contactChoice1"
     name="SaluranAduan" value="Skuad Ronda Bantu">
    <label for="contactChoice1">Skuad Ronda Bantu</label>


      
      </td>
      
    </tr>
  
    
<tr>

<td><button type="submit" name="Submit" id="Submit" value="Submit" onClick="myFunction()" class="button">SUBMIT ADUAN</button></td>
</tr>
<input type="hidden" name="MM_insert" value="form1" >
<input type="hidden" name="UsernamePengadu" value="<?php echo $row_Recordset1['Username']; ?>">
<input type="hidden" name="NamaAkaunPengadu" value="<?php echo $row_Recordset1['Name']; ?>">
<input type="hidden" name="Personincharge" id="Personincharge" value="5">
<input type="hidden" name="TagUser" id="TagUser" value="5">

</table>


</form>	
<h3 id="Map" style="display:none" align="center">Pilih tempat lokasi:</h3>

  <script>
    var map;
var marker = [];
var myLatlng = new google.maps.LatLng(1.5854935,110.3345548);
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
function initialize(){
var mapOptions = {
zoom: 14,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
};

map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
   

marker = new google.maps.Marker({
map: map,
position: myLatlng,
draggable: true 
}); 

geocoder.geocode({'latLng': myLatlng }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
$('#latitude,#longitude').show();
$('#address').val(results[0].formatted_address);
$('#latitude').val(marker.getPosition().lat());
$('#longitude').val(marker.getPosition().lng());
infowindow.setContent(results[0].formatted_address);
infowindow.open(map, marker);
}
}
});

google.maps.event.addListener(marker, 'dragend', function() {

geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
$('#address').val(results[0].formatted_address);
$('#latitude').val(marker.getPosition().lat());
$('#longitude').val(marker.getPosition().lng());
infowindow.setContent(results[0].formatted_address);
infowindow.open(map, marker);
}
}
});
});


// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
        
          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
				map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location,
			 
            }));
 $('#address').val(place.formatted_address);
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

// This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
          placeMarker(event.latLng);
        });

}
function addMarker(location) {
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);


      }
	  function placeMarker(location) {



            if (marker == undefined){
                marker = new google.maps.Marker({
                    position: location,
                    map: map, 
                    animation: google.maps.Animation.DROP,
                });
            }
            else{
                marker.setPosition(location);
				
geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
$('#address').val(results[0].formatted_address);
$('#latitude').val(marker.getPosition().lat());
$('#longitude').val(marker.getPosition().lng());
infowindow.setContent(results[0].formatted_address);
infowindow.open(map, marker);
}
}
});
				
				
				
				
				
				
           $('#address').val(results[0].formatted_address);
			}
            map.setCenter(location);

        }


    

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</body>
</html>
<?php
mysql_free_result($KategoriAduan);
mysql_free_result($Jabatan);
mysql_free_result($TagUser);
?>

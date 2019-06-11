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


$addTindakanDirujuk = $_SERVER['PHP_SELF'];

$colname_ViewCase = "-1";
if (isset($_GET['NoRujukan'])) {
  $colname_ViewCase = $_GET['NoRujukan'];
  $_SESSION['NoRujukan']=$colname_ViewCase;
  $ReadStatus=1;
}
mysql_select_db($database_Connection1, $Connection1);
$query_ViewCase = sprintf("SELECT * FROM aduan WHERE NoRujukan = %s ORDER BY NoRujukan ASC", GetSQLValueString($colname_ViewCase, "text"));
$ViewCase = mysql_query($query_ViewCase, $Connection1) or die(mysql_error());
$row_ViewCase = mysql_fetch_assoc($ViewCase);
$totalRows_ViewCase = mysql_num_rows($ViewCase);

//To read the table if the are existing NoRujukan the tindakanRujukan will be updated
mysql_select_db($database_Connection1, $Connection1);
$query_ReadTindakan = sprintf("SELECT * FROM tindakandirujuk WHERE NoRujukan = %s", GetSQLValueString($_SESSION['NoRujukan'], "text"));
$ReadTindakan = mysql_query($query_ReadTindakan, $Connection1) or die(mysql_error());
$row_ReadTindakan = mysql_fetch_assoc($ReadTindakan);
$totalRows_ReadTindakan = mysql_num_rows($ReadTindakan);



//SQL TO see the tindakan dirujuk
$query_AduanToPIC=sprintf("SELECT * from tindakandirujuk 
 where NoRujukan=%s and UsernamePegawaiDirujuk=%s", GetSQLValueString($colname_ViewCase, "text"),GetSQLValueString($_SESSION['Username'], "text"));
$AduantToPIC= mysql_query($query_AduanToPIC, $Connection1) or die(mysql_error());
$row_AduantToPIC = mysql_fetch_assoc($AduantToPIC);
$totalRows_MyAduantToPIC = mysql_num_rows($AduantToPIC);



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "TindakanDirujuk")) {

//To insert the tindakan dirujuk


if($totalRows_ReadTindakan=='0'){
$query_AddAduan = sprintf("Insert INTO tindakandirujuk (NoRujukan,TindakanDirujuk,UsernamePegawaiDirujuk,TindakanTimeSubmit) VALUES(%s,%s,%s,now())",

                       GetSQLValueString($_POST['NoRujukan'], "text"),
					   GetSQLValueString($_POST['tindakan'], "text"),
					   GetSQLValueString($_SESSION['Username'], "text"));
	
$AddTindakan = mysql_query($query_AddAduan, $Connection1) or die(mysql_error());

  echo '<script language="javascript">';
echo 'alert("Aduan has successfully submitted")';
echo '</script>';
 // header(sprintf("Location: %s", $insertGoTo));
}else if($totalRows_ReadTindakan>='1'){
	

$query_UpdateTindakanDirujuk = sprintf("UPDATE tindakandirujuk
SET TindakanDirujuk =%s WHERE NoRujukan =%s",  GetSQLValueString($_POST['tindakan'], "text"),
					   GetSQLValueString($_POST['NoRuj'], "text"));
$updateAduan = mysql_query($query_UpdateTindakanDirujuk, $Connection1) or die(mysql_error());

	header("Location:ViewAduanUser.php");
	
 echo '<script language="javascript">';
echo 'alert("Aduan has successfully updated")';

echo '</script>';
}
}



//When the link is click it will update the readStatus to 1
mysql_select_db($database_Connection1, $Connection1);
$query_UpdateRead = "Update aduan SET ReadStatus ='1' WHERE NoRujukan='$colname_ViewCase'";

$UpdateRead = mysql_query($query_UpdateRead, $Connection1) or die(mysql_error());

if (isset($_SESSION['Username'])) {
  $colname_ViewAduan = $_SESSION['Username'];
}
//To match the Aduan With the Username
mysql_select_db($database_Connection1, $Connection1);
$query_ViewUsername = sprintf("SELECT * FROM aduan WHERE UsernamePengadu = %s", GetSQLValueString($colname_ViewAduan, "text"));
$ViewUsername = mysql_query($query_ViewUsername, $Connection1) or die(mysql_error());
$row_ViewUsername = mysql_fetch_assoc($ViewUsername);

//To match the useraccount with aduan based on ID and PIC given the No Rujukan
mysql_select_db($database_Connection1, $Connection1);
$query_ViewPIC = sprintf("SELECT *,useraccount.Name FROM aduan INNER JOIN useraccount on useraccount.ID = aduan.PIC WHERE NoRujukan=%s", GetSQLValueString($colname_ViewCase, "text"));
$ViewPIC= mysql_query($query_ViewPIC, $Connection1) or die(mysql_error());
$row_ViewPIC = mysql_fetch_assoc($ViewPIC);

$colname_ViewAduan = "-1";
if (isset($_SESSION['Username'])) {
  $colname_ViewAduan = $_SESSION['Username'];
}
//To match the aduan with Tindakan Dirujuk 
mysql_select_db($database_Connection1, $Connection1);
$query_ViewAduan = sprintf("SELECT *,tindakandirujuk.UsernamePegawaiDirujuk FROM aduan INNER JOIN tindakandirujuk on tindakandirujuk.NoRujukan =aduan.NoRujukan WHERE UsernamePegawaiDirujuk = %s", GetSQLValueString($colname_ViewAduan, "text"));
$ViewAduan = mysql_query($query_ViewAduan, $Connection1) or die(mysql_error());
$row_ViewAduan = mysql_fetch_assoc($ViewAduan);
$totalRows_ViewAduan = mysql_num_rows($ViewAduan);

$colname_UserAccount = "-1";
//To display the useraccount info based on the session
mysql_select_db($database_Connection1, $Connection1);
$query_UserAccount = sprintf("SELECT * FROM useraccount WHERE Username = %s", GetSQLValueString($colname_ViewAduan, "text"));
$UserAccount = mysql_query($query_UserAccount, $Connection1) or die(mysql_error());
$row_UserAccount = mysql_fetch_assoc($UserAccount);
$totalRows_UserAccount = mysql_num_rows($UserAccount);



//Variable to route it to the pegawai bertanggugjawab
$_SESSION['Name']=$row_UserAccount['Name'];

 
 


mysql_select_db($database_Connection1, $Connection1);
$query_ViewAduan = sprintf("SELECT * from aduan WHERE PIC = %s", GetSQLValueString($row_UserAccount['ID'], "text"));
$ViewAduan = mysql_query($query_ViewAduan, $Connection1) or die(mysql_error());
$row_ViewAduan = mysql_fetch_assoc($ViewAduan);
//Variable to show if they are any records for the person in charge
$totalRows = mysql_num_rows($ViewAduan);

//SQL to merge kategori aduan
$query_MergekategoriAduan=sprintf("SELECT * from aduan INNER JOIN kategoriaduan ON kategoriaduan.IDKategoriAduan = aduan.Category where NoRujukan=%s",GetSQLValueString($colname_ViewCase,"text"));
$KategoriAduan= mysql_query($query_MergekategoriAduan, $Connection1) or die(mysql_error());
$row_kategoriAduan = mysql_fetch_assoc($KategoriAduan);


//SQL to merge sub-kategori aduan
$query_MergeSubkategoriAduan=sprintf("SELECT * from aduan
INNER JOIN subkategoriaduan
ON subkategoriaduan.ID=aduan.SubCategory where NoRujukan=%s",GetSQLValueString($colname_ViewCase,"text"));
$SubKategoriAduan= mysql_query($query_MergeSubkategoriAduan, $Connection1) or die(mysql_error());
$row_SubkategoriAduan = mysql_fetch_assoc($SubKategoriAduan);

//SQL to merge aduan with pegawai dirujuk
mysql_select_db($database_Connection1, $Connection1);
$query_PegawaiDirujuk = sprintf("SELECT * from aduan INNER JOIN useraccount ON useraccount.ID = aduan.PIC where PIC =%s", GetSQLValueString($row_UserAccount['ID'], "text"));
$PegawaiDirujuk = mysql_query($query_PegawaiDirujuk, $Connection1) or die(mysql_error());
$row_PegawaiDirujuk = mysql_fetch_assoc($PegawaiDirujuk);


//SQL to display the person who submitted the report
mysql_select_db($database_Connection1, $Connection1);
$query_ReportedBy= sprintf("SELECT *,useraccount.Name from aduan INNER JOIN useraccount ON aduan.UsernamePengadu = useraccount.Username where NoRujukan =%s", GetSQLValueString($colname_ViewCase, "text"));
$ReportedBy= mysql_query($query_ReportedBy, $Connection1) or die(mysql_error());
$row_ReportedBy = mysql_fetch_assoc($ReportedBy);

//To update the status of the case

$UpdateAction = $_SERVER['PHP_SELF']."?doUpdate=true";
$query_UpdateAduan = "UPDATE aduan
SET StatusAduan = 'In Progress' ";
$updateAduan = mysql_query($query_UpdateAduan, $Connection1) or die(mysql_error());
$row_PegawaiDirujuk = mysql_fetch_assoc($PegawaiDirujuk);
if ((isset($_GET['doUpdate'])) &&($_GET['doUpdate']=="true")){
	
   $UpdateGoTo = "ViewAduanUser.php";
  if ($UpdateGoTo) {
    header("Location: $UpdateGoTo");
}
}
//Add to tindakan dirujuk


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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Case</title>
<link href="../css/tableView.css" rel="stylesheet" type="text/css" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
<script type="text/javascript" src="../Admin/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../Admin/assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../Admin/assets/js/bootstrap-table.js"></script>
<link href="../Admin/assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
<link  rel="stylesheet" href="../css/styles.css" rel="stylesheet" type="text/css" >
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../Admin/assets/css/menubar.css">

<script>
function ShowReadOnlyTindakanDirujuk(){
	 var counts=<?php echo $totalRows_MyAduantToPIC?>;
	
if(counts=='0'){
	
	document.getElementById('tindakan').style.display="none";
	document.getElementById('submit').style.display="none";
}else{
	document.getElementById('MyAduan').style.display="none";
}}
</script>



<script>
function CalculateDate(){
	var iWeeks, iDateDiff,iAdjust,totaldays = 0;

var DateSubmit = new Date("<?php echo $row_ViewCase['TimeSubmit'] ?>");
var db1=DateSubmit;

var n =  new Date();
var  db2=new Date();
	DateSubmit=DateSubmit.getDay();
dateNow = n.getDay();

 var iWeekday1=DateSubmit;
 var iWeekday2=dateNow;
 
iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;

if ((iWeekday1 > 5) && (iWeekday2 > 5)) 
iAdjust = 1; // adjustment if both days on weekend

iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

// calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
iWeeks = Math.floor((n.getTime() - db1.getTime()) / 604800000);
if(iWeeks<1){
iWeeks=0;	
}

if (iWeekday1 <= iWeekday2) {
iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1);
} else {
  iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2);
			}
 // take into account both days on weekend
		
	totaldays= iDateDiff;




document.getElementById("DayCounting").innerHTML =  totaldays+" days" ;

}

</script>


<script>
function start(){

CalculateDate();
ShowReadOnlyTindakanDirujuk();
}
</script>
<html>
</head>

<body onload="start()">


<?php
mysql_free_result($ViewCase);
?>
<div class="topnav" id="myTopnav">
  <a style=" background-color:#0FED56;">Sistem Aduan Dalaman DBKU</a>
  <a href="DADD2019.php" >Report Aduan</a>

  
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



<label><center><?php echo $row_ViewCase['NoRujukan'] ?></center></label>
<div align="center">
  <form name="TindakanDirujuk" method="POST" action="<?php echo $addTindakanDirujuk; ?>" >
  <table id="myTable" border="1" align="center" style="width: auto" cellspacing="3" class="paleBlueRows">
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
          <td>Kawasan Aduan</td>
           <td style="color: #4E4E4E"><?php echo $row_ViewCase['KawasanAduan'] ?></td>
          
        </tr>
        <tr>
          
          <td>Alamat Aduan: </td>
         <td style="color: #4E4E4E"><?php echo $row_ViewCase['AlamatAduan'] ?></td>
          
          
          </tr>
    <thead>
      <th colspan="2">Maklumat Aduan</th>
        </thead>
        <tr>
          
          <td>Kategori Aduan </td>
          <td style="color: #4E4E4E"><?php echo $row_kategoriAduan['NamaAduan'] ?></td>
          
          </tr>
    <tr>
      
      <td>Sub Kategori Aduan </td>
      <td style="color: #4E4E4E"><?php echo $row_ViewCase['SubCategory']?></td>
      
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
      <td><?php echo $row_ViewCase['StatusAduan'] ?>    
 
         
        </td>
      </tr>
    <td>Jumlah hari tarikh aduan </td>
      <td>  <p id="DayCounting">No days to show</p>
        </td>
      </tr>
    
   
    <tr>
      <td>Person In Charge
        <td><?php echo $row_ViewPIC['Name'];  ?>
        
        </tr>
          
            </tr>
            <tr>
            <td>Reported By:
            <td><?php echo $row_ReportedBy['Name']?>
    
    </tr>
        <tr>
                       <td><p id="TindakanLabel">Tindakan dirujuk</p> </td>
            <td>
              <textarea id="tindakan" name="tindakan"  rows="8" cols="50" ><?php echo $row_AduantToPIC['TindakanDirujuk']?>      </textarea> 
  <p id="MyAduan"> <?php echo $row_ReadTindakan['TindakanDirujuk']?></p> 
              </td>
            
            <tr>
        
      <td align="center" colspan="2"><button type="submit" id="submit" name="Submit"  value="Submit" >SUBMIT ADUAN</button></td>
      </tr>
  </table>
  <input type="hidden" name="MM_insert" value="TindakanDirujuk" >
  <input type="hidden" name="NoRuj" value="<?php echo $row_ViewCase['NoRujukan']?>" >
          <input type="hidden"  name="NoRujukan" value="<?php echo $row_ViewCase['NoRujukan'] ?>">
    <input type="hidden"  name="PegawaiDirujuk" value="<?php echo $row_ViewPIC['Name'];  ?>">
  </form>
</div>
</body>
</html>
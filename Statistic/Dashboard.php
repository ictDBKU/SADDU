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
//Query to count the saluran for aduan dalaman
mysql_select_db($database_Connection1, $Connection1);
$query_Aduan = "SELECT * FROM aduan";
$Aduan = mysql_query($query_Aduan, $Connection1) or die(mysql_error());
$row_Aduan = mysql_fetch_assoc($Aduan);
$totalRows_Aduan = mysql_num_rows($Aduan);
//Query to count the amount of staff dalaman
mysql_select_db($database_Connection1, $Connection1);
$countStaffDalaman;
$query_Recordset1 = "SELECT *,COUNT(*) 
FROM aduan where saluranAduan='Staff Dalaman' GROUP BY saluranAduan ";
$Recordset1 = mysql_query($query_Recordset1, $Connection1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
if($row_Recordset1['COUNT(*)']==0){
	$countStaffdalaman=0;
}else{
	$countStaffdalaman=$row_Recordset1['COUNT(*)'];
}

//Query to count the amount of pegawai kawasan
mysql_select_db($database_Connection1, $Connection1);
$countPegawaiKawasan;
$query_Recordset2 = "SELECT *,COUNT(*) 
FROM aduan where saluranAduan='Pegawai Kawasan' GROUP BY saluranAduan ";
$Recordset2 = mysql_query($query_Recordset2, $Connection1) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
if($row_Recordset2['COUNT(*)']==0){
	$countPegawaiKawasan=0;
}else{
	$countPegawaiKawasan=$row_Recordset2['COUNT(*)'];
}
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

//Query to count the amount of CCTV
mysql_select_db($database_Connection1, $Connection1);
$countCCTV;
$query_Recordset3 = "SELECT *,COUNT(*) 
FROM aduan where saluranAduan='CCTV' GROUP BY saluranAduan ";
$Recordset3 = mysql_query($query_Recordset3, $Connection1) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
if($row_Recordset3['COUNT(*)']==0){
	$countCCTV=0;
}else{
	$countCCTV=$row_Recordset3['COUNT(*)'];
}

//Query to count the amount of Ronda/Bantu
mysql_select_db($database_Connection1, $Connection1);
$countRondaBantu;
$query_Recordset4 = "SELECT *,COUNT(*) 
FROM aduan where saluranAduan='Skuad Ronda Bantu' GROUP BY saluranAduan";
$Recordset4 = mysql_query($query_Recordset4, $Connection1) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);
if($row_Recordset4['COUNT(*)']==0){
	$countRondaBantu=0;
}else{
	$countRondaBantu=$row_Recordset4['COUNT(*)'];
}




//Query to count the category Aduan
mysql_select_db($database_Connection1, $Connection1);
$query_kategori = "SELECT * FROM aduan";
$kategori = mysql_query($query_kategori, $Connection1) or die(mysql_error());
$row_kategori = mysql_fetch_assoc($kategori);
$totalRows_kategori = mysql_num_rows($kategori);




//Query to count the amount of each category for aduan
mysql_select_db($database_Connection1, $Connection1);
$countfishtail=0;
$countparit=0;
$countjalan=0;
$countpapantanda=0;
$countsampah=0;
$countpokok=0;
$countbinatangliar=0;
$countlampujalan=0;
$countrumput=0;
$countbangunan=0;
$countvandalisma=0;
$counthalanganawam=0;
$countpenguatkuasaan=0;
$countlainlain=0;
$countserangga=0;
$countrumahterbiar=0;
$countkenderaan=0;

$countcategory;
$query_category = "SELECT *,COUNT(*) FROM aduan GROUP BY Category ";
$category = mysql_query($query_category, $Connection1) or die(mysql_error());
$row_category = mysql_fetch_assoc($category);
do{
 if($row_category['COUNT(*)']>0 and $row_category['Category']=="Fishtail/Kain Rentang/Banner") {
	$countfishtail=$row_category['COUNT(*)'];
	
}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Parit"){
	$countparit=$row_category['COUNT(*)'];

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Jalan"){
	$countjalan=$row_category['COUNT(*)'];

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Papan Tanda"){
	$countpapantanda=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Sampah"){
	$countsampah=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Pokok/Bunga/Taman"){
	$countpokok=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Binatang Liar"){
	$countbinatangliar=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Lampu Isyarat"){
	$countlampujalan=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Rumput"){
	$countrumput=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penyelenggaraan Bangunan"){
	$countbangunan=$row_category['COUNT(*)'];	
	
}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Vandalisma"){
	$countvandalisma=$row_category['COUNT(*)'];
	
}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Halangan Awam"){
	$counthalanganawam=$row_category['COUNT(*)'];	
	
}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penguatkuasaan Alam Sekitar"){
	$countpenguatkuasaan=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Serangga"){
	$countserangga=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Lain-Lain"){
	$countlainlain=$row_category['COUNT(*)'];	
	
}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Rumah terbiar"){
	$countrumahterbiar=$row_category['COUNT(*)'];		
	
}else if($row_category['COUNT(*)']>0 and $row_category['Category']=="Penguatkuasaan Kenderaan"){
	$countkenderaan=$row_category['COUNT(*)'];		

}
}while($row_category = mysql_fetch_assoc($category));


//Query to count the value of each report from each zone
mysql_select_db($database_Connection1, $Connection1);
$query_kawasan = "SELECT *,COUNT(*) FROM aduan GROUP BY KawasanAduan";
$kawasan = mysql_query($query_kawasan, $Connection1) or die(mysql_error());
$row_kawasan = mysql_fetch_assoc($kawasan);
$Damai=0;
$AstanaA=0;
$DemakHeight=0;
$DemakLaut=0;
$Bako=0;
$PinangJawa=0;
$LaruhScheme=0;
$Tupong=0;
$SriWangi=0;
$KubahRia=0;
$Semariang=0;
$AstanaB=0;
$MedanRaya=0;
$Sukma=0;
$Stadium=0;
$SemariangBatu=0;
$DemakJaya=0;
$BukitSiol=0;
$Kesuma=0;
$KpgDemak=0;
$SiolKandis=0;
$Satok=0;
$SgMaong=0;
$MainBazar=0;
$BatuLintang=0;
$GoldenTriangle=0;
$Patinggan=0;
$IndiaStreet=0;
$TamanBudaya=0;


do{
 if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Damai") {
	$Damai=$row_kawasan['COUNT(*)'];
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Astana(a)"){
	$Astana=$row_kawasan['COUNT(*)'];

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Demak Height"){
	$DemakHeight=$row_kawasan['COUNT(*)'];

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Demak Laut"){
	$DemakLaut=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Bako"){
	$Bako=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Pinang Jawa"){
	$PinangJawa=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Laruh Scheme"){
	$LaruhScheme=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Tupong"){
	$Tupong=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Sri Wangi"){
	$SriWangi=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Kubah Ria"){
	$KubahRia=$row_kawasan['COUNT(*)'];	
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Semariang"){
	$Semariang=$row_kawasan['COUNT(*)'];
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Astana(b)"){
	$AstanaB=$row_kawasan['COUNT(*)'];	
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Medan Raya"){
	$MedanRaya=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Sukma"){
	$Sukma=$row_kawasan['COUNT(*)'];	

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Stadium"){
	$Stadium=$row_kawasan['COUNT(*)'];	
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Semariang Batu"){
	$SemariangBatu=$row_kawasan['COUNT(*)'];		
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Demak Jaya"){
	$DemakJaya=$row_kawasan['COUNT(*)'];		
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Bukit Siol"){
	$BukitSiol=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Kesuma"){
	$Kesuma=$row_kawasan['COUNT(*)'];		
	
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Kpg Demak"){
	$KpgDemak=$row_kawasan['COUNT(*)'];
			
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Siol kandis"){
	$SiolKandis=$row_kawasan['COUNT(*)'];	
		
}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Satok"){
	$Satok=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Sg Maong"){
	$SgMaong=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Main Bazaar"){
	$MainBazar=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Batu Lintang"){
	$BatuLintang=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Golden Triangle"){
	$GoldenTriangle=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Patinggan"){
	$Patinggan=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="India Street"){
	$IndiaStreet=$row_kawasan['COUNT(*)'];		

}else if($row_kawasan['COUNT(*)']>0 and $row_kawasan['KawasanAduan']=="Taman Budaya"){
	$TamanBudaya=$row_kawasan['COUNT(*)'];		
}
}while($row_kawasan = mysql_fetch_assoc($kawasan));

//Query to count jumlah by kawasan dun N4
mysql_select_db($database_Connection1, $Connection1);
$jumlahDunN4=0;
$query_jumlahDunN4= "SELECT *,COUNT(*) 
FROM aduan INNER JOIN kawasanAduan ON kawasanAduan.NamaKawasan = aduan.KawasanAduan WHERE IDDUN='1' GROUP BY IDDUN";
$jumlahDunN4 = mysql_query($query_jumlahDunN4, $Connection1) or die(mysql_error());
$row_jumlahDunN4= mysql_fetch_assoc($jumlahDunN4);

if($row_jumlahDunN4['COUNT(*)']==0){
	$row_jumlahDunN4['COUNT(*)']=0;
}

//Query to count jumlah by kawasan dun N5
mysql_select_db($database_Connection1, $Connection1);
$jumlahDunN5=0;
$query_jumlahDunN5= "SELECT *,COUNT(*) 
FROM aduan INNER JOIN kawasanAduan ON kawasanAduan.NamaKawasan = aduan.KawasanAduan WHERE IDDUN='2' GROUP BY IDDUN";
$jumlahDunN5 = mysql_query($query_jumlahDunN5, $Connection1) or die(mysql_error());
$row_jumlahDunN5= mysql_fetch_assoc($jumlahDunN5);

if($row_jumlahDunN5['COUNT(*)']==0){
	$row_jumlahDunN5['COUNT(*)']=0;
}

//Query to count jumlah by kawasan dun N6
mysql_select_db($database_Connection1, $Connection1);
$jumlahDunN6=0;
$query_jumlahDunN6= "SELECT *,COUNT(*) 
FROM aduan INNER JOIN kawasanAduan ON kawasanAduan.NamaKawasan = aduan.KawasanAduan WHERE IDDUN='3' GROUP BY IDDUN";
$jumlahDunN6 = mysql_query($query_jumlahDunN6, $Connection1) or die(mysql_error());
$row_jumlahDunN6= mysql_fetch_assoc($jumlahDunN6);

if($row_jumlahDunN6['COUNT(*)']==0){
	$row_jumlahDunN6['COUNT(*)']=0;
}


//Query to count jumlah by kawasan dun N7
mysql_select_db($database_Connection1, $Connection1);
$jumlahDunN7=0;
$query_jumlahDunN7= "SELECT *,COUNT(*) 
FROM aduan INNER JOIN kawasanAduan ON kawasanAduan.NamaKawasan = aduan.KawasanAduan WHERE IDDUN='4' GROUP BY IDDUN";
$jumlahDunN7 = mysql_query($query_jumlahDunN7, $Connection1) or die(mysql_error());
$row_jumlahDunN7= mysql_fetch_assoc($jumlahDunN7);

if($row_jumlahDunN7['COUNT(*)']==0){
	$row_jumlahDunN7['COUNT(*)']=0;
}

//Query to count jumlah by kawasan dun N8
mysql_select_db($database_Connection1, $Connection1);
$jumlahDunN8=0;
$query_jumlahDunN8= "SELECT *,COUNT(*) 
FROM aduan INNER JOIN kawasanAduan ON kawasanAduan.NamaKawasan = aduan.KawasanAduan WHERE IDDUN='5' GROUP BY IDDUN";
$jumlahDunN8 = mysql_query($query_jumlahDunN8, $Connection1) or die(mysql_error());
$row_jumlahDunN8= mysql_fetch_assoc($jumlahDunN8);

if($row_jumlahDunN8['COUNT(*)']==0){
	$row_jumlahDunN8['COUNT(*)']=0;
}
//Query to count for bahagian dirujuk
mysql_select_db($database_Connection1, $Connection1);
$BahagianAduan;
$query_bahagianAduan= "SELECT *,COUNT(*) FROM aduan ";
$bahagianAduan = mysql_query($query_bahagianAduan, $Connection1) or die(mysql_error());
$row_bahagianAduan= mysql_fetch_assoc($bahagianAduan);

$totalRows_bahagianAduan = mysql_num_rows($bahagianAduan);

mysql_select_db($database_Connection1, $Connection1);
$BahagianAduan2;
$query_bahagianAduan2= "SELECT *,COUNT(*) 
FROM aduan ";
$bahagianAduan2 = mysql_query($query_bahagianAduan2, $Connection1) or die(mysql_error());
$row_bahagianAduan2= mysql_fetch_assoc($bahagianAduan2);
$totalRows_bahagianAduan2 = mysql_num_rows($bahagianAduan2);//



//Query to count for kes penyelesaian bahagian dirujuk
mysql_select_db($database_Connection1, $Connection1);
$query_AduanSelesai= "SELECT *,COUNT(*) FROM aduan WHERE CaseCompletedInTime='1' ";
$AduanSelesai = mysql_query($query_AduanSelesai, $Connection1) or die(mysql_error());
$row_AduanSelesai= mysql_fetch_assoc($AduanSelesai);
$totalrows_AduanSelesai=mysql_num_rows($AduanSelesai);

//Query to count for kes tidak selesai bahagian dirujuk
mysql_select_db($database_Connection1, $Connection1);
$query_tidakSelesai= "SELECT *,COUNT(*) FROM aduan WHERE CaseCompletedInTime='0' ";
$AduanTidakSelesai = mysql_query($query_tidakSelesai, $Connection1) or die(mysql_error());
$row_AduanTidakSelesai= mysql_fetch_assoc($AduanTidakSelesai);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/tableStatistic.css" rel="stylesheet" type="text/css" >
<title>Statistik</title>
<script>

function calculateCasePeratus(){
var selesai;
var takselesai;
var x = (100 + 50) * a;
document.getElementById("demo").innerHTML = x;
document.getElementById("demo").innerHTML = x;
document.getElementById("demo").innerHTML = x;
}
</script>

</head>

<body>
<div align="center">
  <p>1.SALURAN CPA
</p>
  <p>&nbsp;</p>
  <div align="center">
    <table class="blueTable" border="1" >
      <thead>
        <tr>
          <th>STAF
          <th>Pegawai Kawasan
          <th>CCTV
          <th>RONDA BANTU
          <th>JUMLAH
        </tr>
      </thead>
      <tr>
        <td><div align="center"><?php echo $countStaffdalaman;?>
          </div>
        <td><div align="center"><?php echo $countPegawaiKawasan;?>
            </div>
        <td><div align="center"><?php echo $countCCTV;?>
            </div>
        <td><div align="center"><?php echo $countRondaBantu;?>
            </div>
        <td><div align="center"><?php echo $totalRows_Aduan;?>
            </div>
    </table>
  </div>
</div>


<p align="center"> 2.KATEGORI ADUAN</p>
<div align="center">
  <table class="blueTable" border="1" style="display: inline-block;">
    <thead>
      <tr>
        <th>BIL.
          <th>KATEGORI ADUAN
            <th><div align="center">JUMLAH KATEGORI
              
              </div>
              </tr>
      </thead>
    <tr>
      <td>1
        <td>Fishtail/Kain Rentang/Banner
          <td><div align="center"><?php echo $countfishtail; ?>
            </div>
            </tr>
    <tr>
      <td>2
        <td>Penyelenggaraan Parit
          <td><div align="center"><?php echo $countparit; ?>
            </div>
            </tr>
    <tr>
      <td>3
        <td>Penyelenggaraan Jalan
          <td><div align="center"><?php echo $countjalan; ?>
            </div>
            </tr>
    <tr>
      <td>4
        <td>Penyelenggaraan Papan Tanda
          <td><div align="center"><?php echo $countpapantanda; ?>
            </div>
            </tr>
    <tr>
      <td>5
        <td>Penyelenggaraan Sampah
          <td><div align="center"><?php echo $countsampah; ?>
            </div>
            </tr>
    <tr>
      <td>6
        <td>Penyelenggaraan Pokok/Bunga/Taman
          <td><div align="center"><?php echo $countpokok; ?>
            </div>
            </tr>
    <tr>
      <td>7
        <td>Binatang Liar
          <td><div align="center"><?php echo $countbinatangliar; ?>
            </div>
            </tr>
    <tr>
      <td>8
        <td>Penyelenggaraan Lampu Jalan/Lampu Isyarat
          <td><div align="center"><?php echo $countlampujalan; ?>
            </div>
            </tr>
    <tr>
      <td>9
        <td>Penyelenggaraan Rumput
          <td><div align="center"><?php echo $countrumput; ?>
            </div>
            </tr>
    <tr>
      <td>10
        <td>Penyelenggaraan Bangunan
          <td><div align="center"><?php echo $countbangunan; ?>
            </div>
            </tr>
    <tr>
      <td>11
        <td>Vandalisma
          <td><div align="center"><?php echo $countvandalisma; ?>
            </div>
            </tr>
    <tr>
      <td>12
        <td>Halangan awam
          <td><div align="center"><?php echo $counthalanganawam; ?>
            </div>
            </tr>
    <tr>
      <td>13
        <td>Penguatkuasaan Alam Sekitar
          <td><div align="center"><?php echo $countpenguatkuasaan; ?>
            </div>
            </tr>
    <tr>
      <td>14
        <td>Lain-Lain
          <td><div align="center"><?php echo $countlainlain; ?>
            </div>
            </tr>
    <tr>
      <td>15
        <td>Serangga
          <td><div align="center"><?php echo $countserangga; ?>
            </div>
            </tr>
    <tr>
      <td>16
        <td>Rumah Terbiar
          <td><div align="center"><?php echo $countrumahterbiar; ?>
            </div>
            </tr>
    <tr>
      <td>17
        <td>Penguatkuasaan Kenderaan
          <td><div align="center"><?php echo $countkenderaan;?>
            </div>
            </tr>
    <tr>
      <td colspan="2"><div align="right">Jumlah
        </div>
        <td><div align="center"><?php echo $totalRows_Aduan;?>
          </div>
          </tr>
  </table>
  
</div>
<p align="center"> 3.ZON/DUN  </p>
<div align="center">
  <table class="blueTable" border="1"  >
    <thead>
      <tr>
        <th width="60">BIL </td>
          <th width="90">DUN </td>
            <th width="38">BIL </td>
              <th width="102">KAWASAN </td>
                <th width="89">BILANGAN</td>
                  </tr>
      </thead>
    <tr rowspan="3">
      <td rowspan="3">1 </td>
      <td rowspan="3">N4-Pantai Damai </td>
      <td>1 </td>
      <td>Damai </td>
      <td><div align="center"><?php echo $Damai;?></div></td>
      </tr>
    <tr >
      <td>2 </td>
      <td>Astana </td>
      <td><div align="center"><?php echo $AstanaA;?></div></td>
      </tr>
    <tr>
      <td>3 </td>
      <td>Demak Height </td>
      <td><div align="center"><?php echo $DemakHeight;?></div></td>
      </tr>
    <tr style="background-color:#D3D3D3">
      <td colspan="3"></td>
      <td><div align="right">JUMLAH </div></td>
      <td><div align="center"><?php echo $row_jumlahDunN4['COUNT(*)'];?></div></td>
      </tr>
    <tr >
      <td rowspan="2">2 </td>
      <td rowspan="2">N5-Demak Laut </td>
      <td>1 </td>
      <td>Demak Laut </td>
      <td><div align="center"><?php echo $DemakLaut ?></div></td>
      </tr>
    <tr>
      <td>2 </td>
      <td>Bako </td>
      <td><div align="center"><?php echo $Bako ?></div></td>
      </tr>
    <tr style="background-color:#D3D3D3">
      <td colspan="3"></td>
      <td><div align="right">JUMLAH </div></td>
      <td><div align="center"><?php echo $row_jumlahDunN5['COUNT(*)'];?></div></td>
      </tr>
    <tr>
      <td rowspan="5">3 </td>
      <td rowspan="5">N6-Tupong </td>
      <td>1 </td>
      <td>Pinang Jawa </td>
      <td><div align="center"><?php echo $PinangJawa ?></div></td>
      </tr>
    <tr>
      <td>2 </td>
      <td>Laruh Scheme </td>
      <td><div align="center"><?php echo $LaruhScheme ?></div></td>
      </tr>
    <tr>
      <td>3 </td>
      <td>Tupong </td>
      <td><div align="center"><?php echo $Tupong ?></div></td>
      </tr>
    <tr>
      <td>4 </td>
      <td>Sri Wangi </td>
      <td><div align="center"><?php echo $SriWangi ?></div></td>
      </tr>
    <tr>
      <td>5 </td>
      <td>Kubah Ria </td>
      <td><div align="center"><?php echo $KubahRia ?></div></td>
      </tr>
    <tr style="background-color:#D3D3D3">
      <td></td>
      <td></td>
      <td></td>
      <td><div align="right">JUMLAH </div></td>
      <td><div align="center"><?php echo $row_jumlahDunN6['COUNT(*)'];?></div></td>
      </tr>
    <tr>
      
      <td rowspan="11">4 </td>
      <td rowspan="11">N7-Semariang </td>
      <td>1 </td>
      <td>Semariang </td>
      <td><div align="center"><?php echo $Semariang ?></div></td>
      </tr>
    <tr>
      <td>2 </td>
      <td>Astana </td>
      <td><div align="center"><?php echo $AstanaB ?></div></td>
      </tr>
    <tr>
      <td>3 </td>
      <td>Medan Raya </td>
      <td><div align="center"><?php echo $MedanRaya ?></div></td>
      </tr>
    <tr>
      <td>4 </td>
      <td>Sukma </td>
      <td><div align="center"><?php echo $Sukma ?></div></td>
      </tr>
    <tr>
      <td>5 </td>
      <td>Stadium </td>
      <td><div align="center"><?php echo $Stadium ?></div></td>
      </tr>
    <tr>
      <td>6 </td>
      <td>Semariang Batu </td>
      <td><div align="center"><?php echo $SemariangBatu ?></div></td>
      </tr>
    <tr>
      <td>7 </td>
      <td>Demak Jaya </td>
      <td><div align="center"><?php echo $DemakJaya ?></div></td>
      </tr>
    <tr>
      <td>8 </td>
      <td>Bukit Siol </td>
      <td><div align="center"><?php echo $BukitSiol ?></div></td>
      </tr>
    <tr>
      <td>9 </td>
      <td>Kesuma </td>
      <td><div align="center"><?php echo $Kesuma ?></div></td>
      </tr>
    <tr>
      <td>10 </td>
      <td>Kpg Demak </td>
      <td><div align="center"><?php echo $KpgDemak ?></div></td>
      </tr>
    <tr>
      <td>11 </td>
      <td>Siol Kandis </td>
      <td><div align="center"><?php echo $SiolKandis ?></div></td>
      </tr>
    <tr style="background-color:#D3D3D3">
      <td></td>
      <td></td>
      <td></td>
      <td><div align="right">JUMLAH </div></td>
      <td><div align="center"><?php echo $row_jumlahDunN7['COUNT(*)']; ?></div></td>
      </tr>
    <tr>
      <td rowspan="8">5 </td>
      <td rowspan="8">N8-Satok </td>
      <td>1 </td>
      <td>Satok </td>
      <td><div align="center"><?php echo $Satok ?></div></td>
      </tr>
    <tr>
      <td>2 </td>
      <td>Sg Maong </td>
      <td><div align="center"><?php echo $SgMaong ?></div></td>
      </tr>
    <tr>
      <td>3 </td>
      <td>Main Bazaar </td>
      <td><div align="center"><?php echo $MainBazar ?></div></td>
      </tr>
    <tr>
      <td>4 </td>
      <td>Batu Lintang </td>
      <td><div align="center"><?php echo $BatuLintang ?></div></td>
      </tr>
    <tr>
      <td>5 </td>
      <td>Golden Triangle </td>
      <td><div align="center"><?php echo $GoldenTriangle ?></div></td>
      </tr>
    <tr>
      <td>6 </td>
      <td>Patinggan </td>
      <td><div align="center"><?php echo $Patinggan ?></div></td>
      </tr>
    <tr>
      <td>7 </td>
      <td>India Street </td>
      <td><div align="center"><?php echo $IndiaStreet ?></div></td>
      </tr>
    <tr>
      <td>8 </td>
      <td>Taman Budaya </td>
      <td><div align="center"><?php echo $TamanBudaya ?></div></td>
      </tr>
    <tr style="background-color:#D3D3D3">
      <td colspan="4"><div align="right">JUMLAH </div></td>
      <td><div align="center"><?php echo $row_jumlahDunN8['COUNT(*)']; ?></div></td>
      </tr>
    <tr >
      <td style="background-color:#D3D3D3" colspan="4"></td>
      <td><div align="center"><?php echo $totalRows_Aduan;?></div></td>
      </tr>
  </table>
  
  
</div>
<p align="center">4.BAHAGIAN YANG DIRUJUK</p>
<div align="center">
  <table class="blueTable" width="200" border="1">
    <thead>
      <tr>
        <th>BIL</th>
        <th>BAHAGIAN YANG DIRUJUK</th>
        <th>JUMLAH BAHAGIAN</th>
        </tr>
      </thead>
    <?php $no=1;?>
    
    <?php do {  ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $row_bahagianAduan['BahagianAduan']; ?></td>
        <td><div align="center"><?php echo $row_bahagianAduan['COUNT(*)'];
		$bahagianDirujuk = array();
		$bahagianDirujuk[] = $row_bahagianAduan['COUNT(*)'];
		
		
		
		?></div></td>
        </tr>
      <?php } while ($row_bahagianAduan= mysql_fetch_assoc($bahagianAduan)); ?>
    </table>
</div>
<p align="center">5.PRESTASI PENYELESAIAN ADUAN</p>
<div align="center">
  <table class="blueTable" width="200" border="1">
    <thead>
      <tr>
        <th scope="col">BAHAGIAN</th>
        <th scope="col">SELESAI DALAM TEMPOH 5 HARI</th>
        <th scope="col">PERATUSAN PENYELESAIAN</th>
        
      </tr>
      
    </thead>
    
    
    <?php do 
	
		{  ?>
      <tr>
        <td><div align="center"><?php echo $row_AduanSelesai['BahagianAduan'];?></div></td>
        <td><div align="center"><?php echo $row_AduanSelesai['COUNT(*)'] ?></div></td>
        <td> <div align="center"><?php echo $bahagianDirujuk[1] ?></td>
      </tr>
      <?php } while ($row_AduanSelesai= mysql_fetch_assoc($AduanSelesai));?>
  </table>
</div>
<p align="center">6.PRESTASI ADUAN TIDAK SELESAI</p>
<div align="center">
  <table class="blueTable" width="200" border="1">
    <thead>
      <tr>
        <th scope="col">BAHAGIAN</th>
        <th scope="col">TIDAK SELESAI DALAM TEMPOH 5 HARI</th>
        <th scope="col">PERATUSAN % TIDAK SELESAI</th>
        
      </tr>
      
    </thead>
    
    
    <?php do 
		{  ?>
      <tr>
        <td><div align="center"><?php echo $row_AduanTidakSelesai['BahagianAduan'];?></div></td>
        <td><div align="center"><?php echo $row_AduanTidakSelesai['COUNT(*)'] ?></div></td>
        <td></td>
      </tr>
      <?php } while ($row_AduanTidakSelesai= mysql_fetch_assoc($AduanTidakSelesai));?>
  </table>
</div>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>




</body>
</html>
<?php
mysql_free_result($Aduan);

mysql_free_result($Recordset1);
?>

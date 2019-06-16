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
//Penyelenggaraan parit
$countParitRosak=0;
$countRumputDalamParit=0;
$countPenutupparitHilang=0;
$countTersumbat=0;
$countCulvertruntuh=0;


//Penyelenggaraan Papan tanda/penanda jalan
$countVandalisme=0;
$countPapanTandaHilang=0;
$countPapanTandaBaru=0;


//Pemotongan Rumput
$countTepiJalan=0;
$countBacklane=0;
$countTidakdiservis=0;


//Binatang 
$countliar=0;
$countBangkai=0;
$countSerangga=0;
$countSarangTebuan=0;
$countTernakanayam=0;

//Pengendalian sampah sarap

$countSampahTidakDikutip=0;
$countAirSampahTertumpahDiJalan=0;
$countLoriSampahmelanggarpagar=0;
$countSemakSamunTanahKerajaan=0;
$countTernakanayam=0;

//Kacau ganggu
$countBunyiBising=0;
$countBauBusuk=0;
$countTanahKosongbersemaksamun=0;


//Penyelenggaraan teknikal
$countlampujalan=0;
$countlampuisyarat=0;
$countlamputaman=0;


//Penyelenggaraan kawasan //bangunan
$countIbuPejabatDBKU=0;
$countBangunanMilikDBKU=0;


//Penyelenggaraan pokok
$countPokokTumbang=0;
$countcantasDahanPokok=0;
$countPokokmenghalangpandangan=0;

//LaluLintas
$countPengendalianlalulintas=0;
$countkenderaanburukditepijalan=0;
$countJalanKotor=0;

//Halangan awam/penjaja haram
$countpenjajameletakbarangandikakilima=0;
$countbacklanediletakbarang=0;
$countsisabinaanditinggal=0;
$countPenjajaHaram=0;
$countIklanTepiJalan=0;
//Bangunan
$countAhLong=0;
$countpermitOP=0;
$countKerosakanpadaBangunan=0;
$countVandalismepadaBangunan=0;
$countRumahKosong=0;
$countRumput=0;


//Pembinaan Projek
$countpembinaanprojek=0;
$countpermohonanpermitbaru=0;
$countkacauganggu=0;
$countrumahrosak=0;
$countNaikTaraf=0;

//Penjaja
$countberjualdiluarwaktuditetapkan=0;
$countpeniagalesen=0;

//Iklan
$counttiadapermit=0;
$countpermitberkaintandenganbillboard=0;
$countPerkhidmatan=0;


//TempatLetakKereta
$countTempatLetakKereta=0;
$countKompaunLetakKereta=0;


$query_category = "SELECT *,COUNT(*) FROM aduan GROUP BY SubCategory";
$category = mysql_query($query_category, $Connection1) or die(mysql_error());
$row_category = mysql_fetch_assoc($category);
do{
 if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Parit rosak") {
	$countParitRosakn=$row_category['COUNT(*)'];
	
}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Rumput dalam parit"){
	$countRumputDalamParit=$row_category['COUNT(*)'];

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Penutup parit hilang"){
	$countPenutupparitHilang=$row_category['COUNT(*)'];

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Tersumbat"){
	$countTersumbat=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Culvert runtuh"){
	$countCulvertruntuh=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Vandalisme"){
	$countVandalisme=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Papan tanda hilang"){
	$countPapanTandaHilang=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Papan tanda baru"){
	$countPapanTandaBaru=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Backlane"){
	$countBacklane=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Tidak diservis"){
	$countTidakdiservis=$row_category['COUNT(*)'];	
	
}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Liar"){
	$countliar=$row_category['COUNT(*)'];
	
}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Bangkai"){
	$countBangkai=$row_category['COUNT(*)'];	
	
}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Serangga"){
	$countSerangga=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Sarang Tabuan"){
	$countSarangTebuan=$row_category['COUNT(*)'];	

}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Ternakan ayam/ikan"){
	$countTernakanayam=$row_category['COUNT(*)'];	
	
}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Sampah tidak dikutip"){
	$countSampahTidakDikutip=$row_category['COUNT(*)'];		
	
}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Air sampah tertumpah di jalan"){
	$countAirSampahTertumpahDiJalan=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Lori sampah melanggar pagar"){
	$countLoriSampahmelanggarpagar=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Semak samun tanah kerajaan"){
	$countSemakSamunTanahKerajaan=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Bunyi bising"){
	$countBunyiBising=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Bau busuk"){
	$countBauBusuk=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Tanah kosong bersemak-samun"){
	$countTanahKosongbersemaksamun=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Lampu jalan"){
	$countlampujalan=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Lampu isyarat"){
	$countlampuisyarat=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Lampu taman"){
	$countlamputaman=$row_category['COUNT(*)'];		
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Ibupejabat DBKU"){
	$countIbuPejabatDBKU=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Bangunan Milik DBKU"){
	$countBangunanMilikDBKU=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Pokok tumbang"){
	$countPokokTumbang=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Cantas dahan pokok"){
	$countcantasDahanPokok=$row_category['COUNT(*)'];	}
	else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Pokok menghalang pandangan"){
	$countPokokmenghalangpandangan=$row_category['COUNT(*)'];}
	else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Pengendalian lalu lintas"){
	$countPengendalianlalulintas=$row_category['COUNT(*)'];}
	else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Kenderaan buruk di tepi jalan"){
	$countkenderaanburukditepijalan=$row_category['COUNT(*)'];}
	else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Jalan kotor oleh     lori kontraktor"){
	$countJalanKotor=$row_category['COUNT(*)'];	}
	else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Penjaja meletak barangan di kaki lima"){
	$countpenjajameletakbarangandikakilima=$row_category['COUNT(*)'];}
	else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Backlane diletak barang"){
	$countbacklanediletakbarang=$row_category['COUNT(*)'];}
	else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Sisa binaan ditinggal"){
	$countsisabinaanditinggal=$row_category['COUNT(*)'];}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Penjaja haram/tanpa lesen"){
	$countPenjajaHaram=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Iklan tanpa permit di tepi jalan"){
	$countIklanTepiJalan=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Poster Along"){
	$countAhLong=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Permit OP"){
	$countpermitOP=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Kerosakan pada bangunan/tandas milik bangunan"){
	$countKerosakanpadaBangunan=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Vandalisme pada bangunan"){
	$countVandalismepadaBangunan=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Rumah kosong bersemak-samun"){
	$countRumahKosong=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Rumput/pokok tumbuh di bangunan"){
	$countRumput=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Pembinaan Projek"){
	$countpembinaanprojek=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Permohonan parit baru")
	{	$countpermohonanpermitbaru=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Kacau ganggu oleh projek sedang berjalan 	"){
	$countkacauganggu=$row_category['COUNT(*)'];	
}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Kacau ganggu oleh projek sedang berjalan 	"){
	$countrumahrosak=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Rumah rosak/pecah oleh projek berjalan"){
	$countNaikTaraf=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Naiktaraf parit lama ke parit baru"){
	$countberjualdiluarwaktuditetapkan=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Berjual di luar waktu ditetapkan"){
	$countpeniagalesen=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Peniaga Lesen/permit"){
	$counttiadapermit=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Iklan tiada permit"){
	$countpermitberkaintandenganbillboard=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Permit berkaitan dengan billboard,bunting dan banner"){
	$countPerkhidmatan=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']==" 	Perkhidmatan yang memerlukan lesen"){
	$countkenderaan=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Tempat letak kereta diwartakan"){
	$countTempatLetakKereta=$row_category['COUNT(*)'];	
	}else if($row_category['COUNT(*)']>0 and $row_category['SubCategory']=="Tempat letak kereta diwartakan"){
	$countKompaunLetakKereta=$row_category['COUNT(*)'];	
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
$query_bahagianAduan= "SELECT *,COUNT(*) FROM aduan INNER JOIN useraccount ON useraccount.ID=aduan.PIC INNER JOIN department on department.DepartmentID=useraccount.DepartmentID Group By DepartmentName";
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
<title>Statistika</title>
<!-- Javascript -->
<script type="text/javascript" src="../Admin/assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../Admin/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../Admin/assets/js/bootstrap-table.js"></script>
<!-- Style -->
<link href="../Admin/assets/css/bootstrap.css" rel="stylesheet" />
<link href="../Admin/assets/css/fresh-bootstrap-table.css" rel="stylesheet" />

<!-- Fonts and icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

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



<link rel="stylesheet" href="../Admin/assets/css/menubar.css">
</head>

<body>


<div class="topnav" id="myTopnav">
  <a style=" background-color:#0FED56;">Sistem Aduan Dalaman DBKU</a>
  <a href="../Admin/AdminPage.php" >Laman Utama</a>

  
  <div class="dropdown">
 

    
  </div>
  
  
  <a href="../Statistic/Dashboard.php">Statistik</a>
    
  
   
  
    <a href="<?php echo $logoutAction ?>" class="dropbtn">Log Keluar</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>


<div align="center">
  <p>1.SALURAN CPA
</p>
  
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
<table id="fresh-table" class="blueTable" align="center">
  <thead>
      
      
    <th >BIL.</th>
      <th data-field="KATEGORI ADUAN">KATEGORI ADUAN</th>       
      <th data-field="SUB-KATEGORI ADUAN">SUB-KATEGORI ADUAN</th>
      <th data-field="JUMLAH KATEGORI">JUMLAH KATEGORI</th>
        
        
        
      </thead>
    <tbody>
      <tr>
        <td>1
          <td >Penyelenggaraan parit                                        
          <td>Parit rosak
          <td>
            <?php echo $countParitRosak; ?>
                    
                    
      </tr>
      <tr>
        <td>
        <td>
        <td>Rumput dalam parit<td>
          <?php echo $countRumputDalamParit; ?>
                  
                  
      </tr>
      <tr>
            
          <td >                                      
          <td>
        <td>Penutup parit hilang<td>
          <?php echo $countPenutupparitHilang; ?>
                  
      </tr>
      <tr>
            
          <td >                                      
          <td>
        <td>Tersumbat<td><?php echo $countTersumbat; ?>
                  
        </tr>
      <tr>
            
          <td >                                       
          <td>
        <td>Culvert runtuh<td><?php echo $countCulvertruntuh; ?>
                  
        </tr>
      <tr>
        <td >2        
        <td >Penyelenggaraan Papan tanda/penanda jalan               
          <td>Vandalisme
          <td><?php echo $countVandalisme=0; ?>
                    
      </tr>
      <tr>
            
            
        <td><td>    
        <td>Papan tanda hilang    
        <td> <?php echo $countPapanTandaHilang; ?>
                    
      </tr>
          
      <tr>
        <td>
        <td>
        <td>Papan tanda baru
        <td>   <?php echo $countPapanTandaBaru; ?>
                    
      </tr>
      <tr>
        <td>3
              
        <td>Pemotongan rumput                        
          <td>Tepi jalan<td>0
                  
          </tr>
      <tr>
        <td>      
        <td>      
        <td>Backlane
          <td><?php echo $countBacklane; ?>
                    
      </tr>
      <tr>
        <td>      
        <td>      
        <td>Tidak diservis<td><?php echo $countTidakdiservis; ?>
                  
        </tr>
      <tr>
        <td>4
              
        <td>Binatang                                
          <td>Liar<td><?php echo $countliar; ?>
                  
          </tr>
      <tr>
        <td>      
        <td>      
        <td>Bangkai<td><?php echo $countBangkai; ?>
                  
        </tr>
      <tr>
        <td>      
        <td>      
        <td>Serangga<td><?php echo $countSerangga; ?>
                  
        </tr>
      <tr>
        <td>      
        <td>      
        <td>Sarang Tebuan
          <td><?php echo $countSarangTebuan; ?>
                    
        </tr>
      <tr>
        <td>      
        <td>      
        <td>Ternakan ayam/ikan/dll<td><?php echo $countTernakanayam; ?>
                  
        </tr>
      <tr>
        <td>5    
        <td>Pengendalian sampah sarap                           
          <td>Sampah tidak dikutip<td><?php echo 
$countSampahTidakDikutip; ?>
                  
          </tr>
      <tr>
        <td>      
        <td>      
        <td>Air smapah tertumpah di jalan<td><?php echo $countAirSampahTertumpahDiJalan; ?>
                  
        </tr>
      <tr>
        <td>      
        <td>      
        <td>Lori sampah melanggar pagar
          <td><?php echo $countLoriSampahmelanggarpagar;?>
                    
          </tr>
      <tr>
        <td>      
        <td>      
        <td>Semak Samun tanah kerajaan  
        <td>   
          <?php echo $countSemakSamunTanahKerajaan;?> 
                    
      </tr>
      <tr>
        <td>6            
        <td>Kacau ganggu            
        <td>Bunyi Bising    
        <td>    
          <?php echo $countBunyiBising;?> 
                    
      </tr>
      <tr>
        <td>      
        <td>      
        <td>Bau Busuk    
        <td>  
          <?php echo $countBauBusuk;?>   
                    
      </tr>
      <tr>
        <td>      
        <td>      
        <td>Tanah Kosong bersemak-samun  
        <td>    
          <?php echo $countTanahKosongbersemaksamun;?> 
                    
      </tr>
      <tr>
        <td>7    
        <td>Penyelenggaraan teknikal    
        <td>Lampu jalan    
        <td>    
          <?php echo $countlampujalan;?>
                    
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Lampu isyarat    
        <td>     
          <?php echo $countlampuisyarat;?>
                    
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Lampu taman    
        <td>  
          <?php echo $countlamputaman;?>  
                    
      </tr>
      <tr>
        <td>8    
        <td>Penyelenggaraan kawasan/bangunan    
        <td>Ibupejabat DBKU    
        <td>    
          <?php echo $countIbuPejabatDBKU;?>  
                    
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Bangunan milik DBKU    
        <td>    
          <?php echo $countBangunanMilikDBKU;?>
                    
      </tr>
      <tr>
        <td>9    
        <td>Penyelenggaraan pokok   
        <td>Pokok tumbang    
        <td>    
          <?php echo $countPokokTumbang;?>
                    
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Cantas dahan pokok
        <td>    
          <?php echo $countcantasDahanPokok?>
                    
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Pokok menghalang pandangan   
        <td>     <?php echo $countPokokmenghalangpandangan?>
      </tr>
      <tr>
        <td>10    
        <td>Lalu Lintas    
        <td>Pengendalian lalu lintas  
        <td>    <?php echo $countPengendalianlalulintas?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Kenderaan buruk di tepi jalan    
        <td>    <?php echo $countkenderaanburukditepijalan?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Jalan kotor oleh lori kontraktor    
        <td>  <?php echo $countJalanKotor?>  
      </tr>
      <tr>
        <td>11    
        <td>Halangan Awam/penjaja haram   
        <td>Penjaja meletak barangan di kaki lima
        <td>   <?php echo $countpenjajameletakbarangandikakilima?> 
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Backlane diletak barang    
        <td>    <?php echo $countbacklanediletakbarang?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Sisa binaan ditinggal    
        <td>    <?php echo $countsisabinaanditinggal?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Penjaja Haram/tanpa lesen    
        <td>    <?php echo $countPenjajaHaram?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Iklan tanpa permit di tepi jalan 
        <td>    <?php echo $countIklanTepiJalan?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Poster Along    
        <td>    <?php echo $countAhLong?>
      </tr>
      <tr>
        <td>12    
        <td>Bangunan    
        <td>Permit OP    
        <td>    <?php echo $countpermitOP?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Kerosakan pada bangunam/tandas milik kerajaan
        <td>   <?php echo $countKerosakanpadaBangunan?> 
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Vandalisme pada bangunan    
        <td>   <?php echo $countVandalismepadaBangunan?>  
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Rumah kosong bersemak-samun    
        <td>    <?php echo $countRumahKosong?> 
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Rumput/pokok tumbuh di bangunan
        <td>    <?php echo $countRumput?> 
      </tr>
      <tr>
        <td>13
        <td>
        <td>Pembinaan projek   
        <td><?php echo $countpembinaanprojek?>   
                    
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Permohonan parit baru    
        <td>    <?php echo $countpermohonanpermitbaru?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Kacau ganggu oleh projek sedang berjalan    
        <td>    <?php echo $countkacauganggu?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Rumah rosak/pecah oleh projek berjalan 
        <td>    <?php echo $countrumahrosak?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Naiktaraf parit lama ke parit baru
        <td>    <?php echo $countNaikTaraf?>
      </tr>
      <tr>
        <td>14    
        <td>Penjaja    
        <td>Berjual di luar waktu ditetapkan    
        <td>    <?php echo $countberjualdiluarwaktuditetapkan?>
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Peniaga Lesen/permit    
        <td>    <?php echo $countpeniagalesen?>
      </tr>
      <tr>
        <td>15    
        <td>Iklan    
        <td>Iklan tiada permit   
        <td>  <?php echo $counttiadapermit?>  
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Permit berkaitan dengan billboard,bunting dan banner
        <td>    <?php echo $countpermitberkaintandenganbillboard?> 
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Perkhidamatan yang memerlukan lesen 
        <td>    <?php echo $countPerkhidmatan?>
      </tr>
      <tr>
        <td>16    
        <td>Tempat letak kereta    
        <td>Tempat Letak Kereta Diwartakan 
        <td><?php echo $countTempatLetakKereta?>    
                    
      </tr>
      <tr>
        <td>    
        <td>    
        <td>Kompaun letak kereta  
        <td>  <?php echo $countKompaunLetakKereta?>   
      </tr>
     <tr>
     <td>
     <td>
     <td>Jumlah:
      <td><?php echo $totalRows_Aduan;?>
      </tr>
</table>
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
      <td><div align="right">JUMLAH </div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="center"><?php echo $row_jumlahDunN8['COUNT(*)']; ?></div></td>
    </tr>
    <tr >
      <td style="background-color:#D3D3D3"></td>
      <td style="background-color:#D3D3D3"></td>
      <td style="background-color:#D3D3D3"></td>
      <td style="background-color:#D3D3D3"></td>
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
        <td><?php echo $row_bahagianAduan['DepartmentName']; ?></td>
        <td><div align="center"><?php echo $row_bahagianAduan['COUNT(*)'];
		$bahagianDirujuk = array();
		$bahagianDirujuk[] = $row_bahagianAduan['COUNT(*)'];
		
		
		
		?></div></td>
        </tr>
     </tbody>
      <?php } while ($row_bahagianAduan= mysql_fetch_assoc($bahagianAduan)); ?>
    </table>
</div>
<!--
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
</div>-->
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>



<script type="text/javascript">
        var $table = $('#fresh-table'),
            $alertBtn = $('#alertBtn'),
            full_screen = true;

        $().ready(function(){
            $table.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: false,
                search: false,
                showToggle: false,
                showColumns: false,
                pagination: false,
                striped: false,
                sortable: true,
                pageSize: 8,
                pageList: [8,10,25,50,100],

                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
        });

        $(function () {
            $alertBtn.click(function () {
                alert("You pressed on Alert");
            });
        });


        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-heart"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('');
        }

        window.operateEvents = {
            'click .like': function (e, value, row, index) {
                alert('You click like icon, row: ' + JSON.stringify(row));
                console.log(value, row, index);
            },
            'click .edit': function (e, value, row, index) {
                console.log(value, row, index);
            },
            'click .remove': function (e, value, row, index) {
                alert('You click remove icon, row: ' + JSON.stringify(row));
                console.log(value, row, index);
            }
        };

    </script>

</body>
</html>
<?php
mysql_free_result($Aduan);

mysql_free_result($Recordset1);
?>

<?php require_once('../Connections/Connection1.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

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
    header("Location: $logoutGoTo");
    exit;
  }
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
$query_Recordset1 = sprintf("SELECT * FROM aduan WHERE MONTH(TimeSubmit) =%s ", GetSQLValueString( $_GET['monthsearch'], "date"));
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
<title>Sistem Aduan Dalaman DBKU</title>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-table.js"></script>
<link rel="stylesheet" href="assets/css/menubar.css">
<link href="../css/tableView.css" rel="stylesheet" type="text/css" >
<link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
<link  rel="stylesheet" href="../css/styles.css" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div class="topnav" id="myTopnav">
  <a style=" background-color:#0FED56;">Sistem Aduan Dalaman DBKU</a>
  <a href="AdminPage.php" >Home</a>

  
    <a href=<?php echo $logoutAction ?>" class="dropbtn">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
  
  
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
  
  <table id="fresh-table" class="table">
<thead>
    
      <th data-field="No">No</th>
      <th data-field="NoRujukan">No Rujukan</th>
      <th data-field="Category">Category</th>
      <th data-field="Kawasan">Kawasan</th>
      <th data-field="MaklumatAduan">Maklumat Aduan</th>
      <th data-field="JenisAduan">JenisAduan</th>
      <th data-field="BahagianAduan">BahagainAduan</th>
      <th data-field="StatusAduan">StatusAduan</th>
      <th data-field="TimeSubmit">Time Status</th>

     
    
    </thead>

    <?php $no=1;?>
    <?php do { ?>
    <tr>
      <td><?php echo $no++; ?></td>
        <td> <a href="Viewcase/ViewCase.php?NoRujukan=<?php echo $row_Recordset1['NoRujukan'];?>"><?php echo $row_Recordset1['NoRujukan'];?></a></td>
        <td><?php echo $row_Recordset1 ['Category']; ?></td>
        <td><?php echo $row_Recordset1 ['KawasanAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['MaklumatAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['JenisAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['BahagianAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['StatusAduan']; ?></td>
        <td><?php echo $row_Recordset1 ['TimeSubmit']; ?></td>
        
   
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  
    </tr>
  </table>
 
</div>
 <script type="text/javascript">
        var $table = $('#fresh-table'),
            $alertBtn = $('#alertBtn'),
            full_screen = false;

        $().ready(function(){
            $table.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: false,
                search: true,
                showToggle: true,
                showColumns: false,
                pagination: true,
                striped: true,
                sortable: true,
                pageSize: 10,
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


mysql_free_result($Recordset1);
?>

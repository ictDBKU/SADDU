<?php require_once('../Connections/Connection1.php'); ?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
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

$MM_restrictGoTo = "../Data Aduan Dalaman/ViewAduanUser.php";
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
$query_Recordset1 = "SELECT * FROM aduan";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Connection1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$rows=mysql_num_rows($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

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
  }}

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

?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="AdminPage.php";
  $loginUsername = $_POST['username'];
  $LoginRS__query = sprintf("SELECT Username FROM useraccount WHERE Username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Connection1, $Connection1);
  $LoginRS=mysql_query($LoginRS__query, $Connection1) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
            echo" <script>alert('Sorry username already Exist');
			window.history.back();</script>";
   
  }
}


}
?>
<?php
//To Register the user
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Reg")) {
  $insertSQL = sprintf("INSERT INTO useraccount (Username, Name, Email, Password,AccountStatus, ICNO,JobID,DepartmentID,AccessLevel,TimeRegister) VALUES (%s, %s, %s, %s,'Active', %s,%s,%s,2,now())",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['ICNO'], "text"),
					   GetSQLValueString($_POST['JobID'], "text"),
					   GetSQLValueString($_POST['DepartmentID'], "text")
					   );

  mysql_select_db($database_Connection1, $Connection1);
  $Result1 = mysql_query($insertSQL, $Connection1) or die(mysql_error());

  $insertGoTo = "View Registered User/ViewCurrentUser.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

//SQL to retrieve department name from table department
mysql_select_db($database_Connection1, $Connection1);
$query_department = "SELECT * FROM department";
$department = mysql_query($query_department, $Connection1) or die(mysql_error());
$row_department = mysql_fetch_assoc($department);
$totalRows_department = mysql_num_rows($department);
//SQL to retrieve designation from designation table department
mysql_select_db($database_Connection1, $Connection1);
$query_Designation = "SELECT * FROM designation";
$Designation = mysql_query($query_Designation, $Connection1) or die(mysql_error());
$row_Designation = mysql_fetch_assoc($Designation);
$totalRows_Designation = mysql_num_rows($Designation);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Aduan Dalaman DBKU</title>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-table.js"></script>
<!-- unsolved<link href="assets/css/bootstrap.css" rel="stylesheet" />-->
<link href="assets/css/fresh-bootstrap-table2.css" rel="stylesheet" />
<link  rel="stylesheet" href="../css/styles.css" rel="stylesheet" type="text/css" >

 <link rel="stylesheet" href="../style2.css">
<link href="../regform/style2.css" rel="stylesheet" type="text/css">
<!-- CSS for register pop up-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- Fonts and icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>



<link rel="stylesheet" href="assets/css/menubar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Style for menu bar -->



</head>
<script>
function ConfirmDelete(NoRujukan) {
	
  return confirm("Adakah anda pasti untuk memadam aduan NoRujukan:"+NoRujukan);
}
</script>
<script>
 function showRecords()
 {
	 var records="<?php echo $rows ?>";
	 if(records=='0'){
		 document.getElementById("fresh-table").style.display="none";
		 document.getElementById("showRecords").style.display="block"
 }
 }
</script>
<script>
function changeAction(val){
    document.getElementById('SearchForm').setAttribute('action', val);

}
</script>

<script>

function showModal(){
document.getElementById('id01').style.display='block';
}


function checkForm(form1)
  {
    if(form1.username.value == "") {
      alert("Error: Username cannot be blank!");
      form1.username.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form1.username.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form1.username.focus();
      return false;
    }

    if(form1.password.value != "" && form1.password.value == form1.Confirmpassword.value) {
      if(form1.password.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form1.password.focus();
        return false;
      }
      if(form1.password.value == form1.username.value) {
        alert("Error: Password must be different from Username!");
        form1.password.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form1.password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form1.password.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form1.password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form1.password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form1.password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form1.password.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form1.password.focus();
      return false;
    }

    alert("You entered a valid password: " + form1.password.value);
    return true;
  }



</script>
     <script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script>

function DeleteCase() {
  var txt;
  var r = confirm("Are you sure you want to delete the case?");
  if (r == true) {
    alert("Case deleted")
  } else {
    
  }

}
</script>

}

</script>
<script>
function start(){
showRecords();}
</script>

<body onload="start()">
<div class="w3-container">

  
<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <div class="test-form">
        <form method="POST" action="<?php echo $editFormAction; ?>" name="form1" id="Reg" onSubmit="return checkForm(this)">
          <img src="../LOGIN2.jpg" class="Logo"><br>
	        <h1>SISTEM ADUAN DALAMAN DBKU</h1>
      <table width="500" border="0" align="center">
        <tbody>
          <tr>
            <td><label class="text" for="textfield">Username</label></td>
            <td><input class="" type="text" name="username" id="username" required></td>
          </tr>
          <tr>
            <td><label class="text" for="textfield">Name</label></td>
            <td> <input class="textbox1" type="text" name="name" id="name" required></td>
          </tr>
          <tr>
            <td><label class="text" for="textfield">Email Address</label></td>
            <td><input class="textbox2" type="email" name="Email" id="Email" required></td>
          </tr>
          <tr>
            <td><label class="text" for="textfield">IC Number </label></td>
            <td><input class="textbox3" type="text" name="ICNO" id="ICNO" required></td>
          </tr>
          <tr>
            <td><label  class="text" for="select">Designation</label></td>
            <td><select name="JobID" id="JobID" style="width: 173px" required>
		 		<?php do { ?>
      				<option value=<?php echo $row_Designation['JobID']; ?>><?php echo $row_Designation['DesignationTitle']; ?>-<?php echo$row_Designation['DesignationTitle']; ?></option>
    			<?php } while($row_Designation = mysql_fetch_assoc($Designation)); ?></select></td>
			  $row_Designation
          </tr>
          <tr>
            <td><label class="text" for="select">Department</label></td>
            <td><select name="DepartmentID" id="DepartmentID" style="width: 173px" required>
         		<?php do { ?>
		 			<option value=<?php echo $row_department['DepartmentID']; ?>><?php echo $row_department['DepartmentName']; ?>-<?php echo $row_department['DepartmentName']; ?></option>
    	 		<?php } while($row_department = mysql_fetch_assoc($department)); ?></select></td>
          </tr>
          <tr>
            <td> <label class="text" for="password">Password</label></td>
            <td><input class="textbox4" type="password" name="password" id="password" required></td>
          </tr>
          <tr>
            <td><label class="text" for="password">Password Confirmation</label></td>
            <td> <input class="textbox5" type="password" name="Confirmpassword" id="password1" required></td>
          </tr>
		  <tr>
			 <td colspan="2" height="100px"><input type="submit" name="submit" id="submit" value="Register"></td>
		  </tr>
			<input type="hidden" name="MM_insert" value="Reg" />
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
</form>


<div class="topnav" id="myTopnav">
  <a style=" background-color:#0FED56;">Sistem Aduan Dalaman DBKU</a>
  <a href="AdminPage.php" >Laman Utama</a>

  
  <div class="dropdown">
    <button class="dropbtn">Pengurusan Akaun 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <a href="#" onclick="showModal()">Daftar Akaun
</a>
      <a href="View Registered User/ViewCurrentUser.php">Papar Akaun Semasa</a>
  
    </div>
    
  </div>
  
  
  <a href="../Statistic/Dashboard.php">Statistik</a>
    
  
   
  
    <a href="<?php echo $logoutAction ?>" class="dropbtn">Log Keluar</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>




 


    <!--<select name="MonthSelection" selected="Choose Month" onchange="location = this.value;">
      <option value="" selected>Filter by Month</option>
      <option value="Searchbydate.php?monthsearch=1">January</option>
      <option value="Searchbydate.php?monthsearch=2">February</option>
      <option value="Searchbydate.php?monthsearch=3">March</option>
      <option value="Searchbydate.php?monthsearch=4">April</option>
      <option value="Searchbydate.php?monthsearch=5">May</option>
      <option value="Searchbydate.php?monthsearch=6">June</option>
      <option value="Searchbydate.php?monthsearch=7">July</option>
      <option value="Searchbydate.php?monthsearch=8">August</option>
      <option value="Searchbydate.php?monthsearch=9">September</option>
      <option value="Searchbydate.php?monthsearch=10">October</option>
      <option value="Searchbydate.php?monthsearch=11">November</option>
      <option value="Searchbydate.php?monthsearch=12">December</option>
      
    </select>-->
   
   
   
   
   
  
    

        <table id="fresh-table" class="table">
    <thead style="color:green;">
 
    <th data-field="No">No.</th>
      <th data-field="NoRujukan">No Rujukan</th>
      <th  data-field="Kategori Aduan">Kategori Aduan</th>
      <th data-field="Kawasan Aduan<">Kawasan Aduan</th>
      <th data-field="Maklumat Aduan">Maklumat Aduan</th>
     
      <th data-field="Status Aduan">Status Aduan</th>
      <th data-field="Masa Aduan">Masa Aduan</th>
      <th data-field="Action">Action</th>

    
  
    </thead>
    <tbody>
         <?php $no=1;?>
      
    <?php do { ?>
    <tr>
    <td> <?php echo $no++; ?></td>
      <td> <a href="Viewcase/ViewCase.php?NoRujukan=<?php echo $row_Recordset1['NoRujukan'];?>"><?php echo $row_Recordset1['NoRujukan'];?></a></td>
      
        <td><?php echo $row_Recordset1['Category']; ?></td>
        <td><?php echo $row_Recordset1['KawasanAduan']; ?></td>
        <td><?php echo $row_Recordset1['MaklumatAduan']; ?></td>
        <td><?php echo $row_Recordset1['StatusAduan']; ?></td>
        <td><?php echo $row_Recordset1['TimeSubmit']; ?></td>
         <td><a href="DeleteCase.php?NoRujukan=<?php echo $row_Recordset1['NoRujukan'];?>" onClick="return ConfirmDelete('<?php echo $row_Recordset1['NoRujukan'];?>');" ><button id="confirmdelete" >DELETE</button></a></td>
     
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </tbody>
  </table>
 <h3 id="showRecords" style="display:none">There are no records to show</h3>

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

mysql_free_result($department);

mysql_free_result($Designation);


?>

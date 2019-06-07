<?php require_once('../../Connections/Connection1.php'); ?>
<?php
$changePassword="";
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

$MM_restrictGoTo = "../Data Aduan Dalaman/DADD2019.php";
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
$query_Recordset1 = "SELECT * FROM useraccount";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Connection1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$query_MergeJobID="SELECT DesignationTitle  from useraccount
INNER JOIN designation
ON useraccount.JobId = designation.JobId ";
$Recordset2= mysql_query($query_MergeJobID, $Connection1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


$row_Recordset2 = mysql_fetch_assoc($Recordset2);


$query_MergeDepartmentID="SELECT useraccount.Name,useraccount.Username,useraccount.Email,useraccount.ICNO,useraccount.AccountStatus,department.DepartmentName,designation.DesignationTitle,useraccount.Password
FROM useraccount
INNER JOIN department
ON useraccount.DepartmentID = department.DepartmentID
INNER JOIN designation
ON useraccount.JobId = designation.JobId
 ";
 

 
 
$Recordset3= mysql_query($query_MergeDepartmentID, $Connection1) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset1 = mysql_num_rows($Recordset3);




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
	
  $logoutGoTo = "../../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }}

?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE useraccount SET Password=%s WHERE Username=%s",
                       GetSQLValueString($_POST['Confirmpassword'], "text"),
                       GetSQLValueString($_POST['ChangePassUser'], "text"));

  mysql_select_db($database_Connection1, $Connection1);
  $Result1 = mysql_query($updateSQL, $Connection1) or die(mysql_error());

  $updateGoTo = "ViewCurrentUser.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Aduan Dalaman DBKU</title>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap-table.js"></script>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="../assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
<link  rel="stylesheet" href="../css/styles.css" rel="stylesheet" type="text/css" >
<link  rel="stylesheet" href="../css/ChangePassword.css" rel="stylesheet" type="text/css" >
<!-- Fonts and icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../assets/css/menubar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
</head>
<script>
function changeAction(val){
    document.getElementById('SearchForm').setAttribute('action', val);

}


function showModal(ChangePassword){
document.getElementById('id01').style.display='block';

document.getElementById("UserPass").innerHTML="Change password for Username:"+ChangePassword;
document.getElementById("ChangePassUser").value=ChangePassword;
}
function checkForm(form1)
  {
    
    if(form1.password.value != "" && form1.password.value == form1.Confirmpassword.value) {
      if(form1.password.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
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
      alert("Error: Both password you entered is not the same!");
      form1.password.focus();
      return false;
    }

    alert("You have successfully changed the password ");
    return true;
  }

</script>
<body>



<div class="w3-container">

  
<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
       
        <form method="POST" action="<?php echo $editFormAction ?>" name="form1" id="form1" onSubmit="return checkForm(this)">
<div class="changepass">
 <h5 id="UserPass" ><?php echo $changePassword ?></h5>
 <input type="text" value="<?php echo $changePassword ?>" name="ChangePassUser" id="ChangePassUser"  />
	  <table border="0" align="center">
      <tbody>
        <tr>
          <td><label for="password">New Password:</label></td>
          <td><input type="password" name="password" id="pass"></td>
        </tr>
        <tr>
          <td><label for="password">Confirm Password:</label></td>
          <td><input type="password" name="Confirmpassword" id="Confirmpassword"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="submit"></td>
        </tbody>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
    
        </form>

          </div>
    </div>
  </div>
</div>




<div class="topnav" id="myTopnav">
  <a style=" background-color:#0FED56;">Sistem Aduan Dalaman DBKU</a>
  <a href="../AdminPage.php" >Home</a>

  <a href="#contact">Contact</a>
  <div class="dropdown">
    <button class="dropbtn">User Management 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
 
      <a href="../View Registered User/ViewCurrentUser.php">Current User</a>
  
    </div>
  </div> 
  <a href="#about">About</a>
    <a href="<?php echo $logoutAction ?>" class="dropbtn">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
  <table id="fresh-table" class="table">
  <thead>
    <tr>
      <th data-field="No">No</th>
      <th data-field="Username">Username</th>
      <th data-field="Name">Name</th>
      <th data-field="Email">Email</th>
      <th data-field="Password">Password</th>
      <th ></th>
      <th data-field="IC NO">IC NO</th>
      <th data-field="Account Status">Account Status</th>
      <th data-field="Job Description">Job Description</th>
      <th data-field="Department">Department</th>
     
    
    </thead>
    <tbody>
     <?php $no=1;?>
      
    <?php do {  ?>
    
    <tr>
      <td><?php echo $no++; ?></td>
         <td><?php echo $row_Recordset3['Username']; ?></td>
        <td><?php echo $row_Recordset3['Name']; ?></td>
        <td><?php echo $row_Recordset3['Email']; ?></td>
        <td width="100px">
        <form name="ChangePassword"><input type="password" value="<?php echo $row_Recordset3['Password'];?>" readonly/></td><td><a href="#" name="CP" value="" onclick="showModal('<?php echo $row_Recordset3['Username']; ?>')"  <i style='font-size:24px' class='fas'>&#xf044;</i> </a></td></form>
        <td><?php echo $row_Recordset3['ICNO']; ?></td>
        <td><?php echo $row_Recordset3['AccountStatus']; ?></td>
        <td><?php echo $row_Recordset3['DesignationTitle']; ?></td>
        <td><?php echo $row_Recordset3['DepartmentName']; ?></td>
        </tr>
    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
	
	 ?>
    </tbody>
  </table>
  
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

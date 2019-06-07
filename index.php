<?php require_once('Connections/Connection1.php'); 
// Holds the Google application Client Id, Client Secret and Redirect Url
require_once('settings.php');
// Holds the various APIs functions
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		// Get the access token 
		$data = GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);

		// Access Tokem
		$access_token = $data['access_token'];
		
		// Get user information
		$user_info = GetUserProfileInfo($access_token);
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}



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
// *** Validate request to login to this site.
  
if (!isset($_SESSION)) {
  session_start();

}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $_SESSION['Username']=$_POST['Username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "AccessLevel";
  $MM_redirectLoginSuccess = "Admin/AdminPage.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_Connection1, $Connection1);
  	
  $LoginRS__query=sprintf("SELECT Username, Password, AccessLevel FROM useraccount WHERE Username=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   //most recent activity
  $LoginRS = mysql_query($LoginRS__query, $Connection1) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
 
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'AccessLevel');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
 
    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
	
  }
  else {
	  $_SESSION['errMsg'] = "Invalid username or password";
    header("Location: ". $MM_redirectLoginFailed );
	exit(0);	//TO make the invalid wont show again	
  }
}
?>

<!doctype html>
<html>


<head>


<meta charset="utf-8">
<title>SISTEM ADUAN DALAMAN DBKU</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<body>
		<div class="loginbox" align="center">
		<img src="LOGIN2.jpg" class="Logo">
			<h1>SISTEM ADUAN DALAMAN DBKU</h1>
			<form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST">
			<p>Username</p>
			
			<input type="text" name="Username" placeholder="Enter Username" style="text-align:center">
		
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password" style="text-align:center">
            	<p style="color:red"> <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg'];unset($_SESSION['errMsg']);} 
						
		
			
						
							 ?></p>
		
            <input type="submit" name="" value="Login">
           
				
			</form>
		
<a id="login-button" href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>">Login with Google</a>
        </div>
	
	</body>
    
</head>
</html>

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Connection1 = "localhost";
$database_Connection1 = "sistemaduandalamandbku";
$username_Connection1 = "root";
$password_Connection1 = "";
$Connection1 = mysql_pconnect($hostname_Connection1, $username_Connection1, $password_Connection1) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php
define('DB_SERVER','premium37.web-hosting.com');
define('DB_USER','evlonpww_newsportal');
define('DB_PASS' ,'gl4V=$hPU4oQ');
define('DB_NAME','evlonpww_newsportal');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>


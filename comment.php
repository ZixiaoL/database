<?php
	require 'authentication.inc';
	require 'db.inc';
	$login1 = $_GET['login1'];
	$login2 = $_GET['login2'];
	$nid = $_GET['nid'];
	$cdesc = $_POST['com'];
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error($link));
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');

$cdesc = mysqlclean($_POST, "com", 20, $link);
//$input_topic = mysqlclean($_GET,"topic",30,$connection);
 //Performing SQL query
$query1 ="insert into comments(login1, login2,nid, cid,cdesc) select ";
$query1 .="'$login1',";
$query1 .="'$login2',";
$query1 .="'$nid',";
$query1 .="MAX(cid)+1,";
$query1 .="'$cdesc'";
$query1 .=" from comments  where login1=";
$query1 .="'$login1'";
$query1 .=" and login2=";
$query1 .="'$login2'";
$query1 .=" and nid=";
$query1 .="'$nid';"; 
mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));

// Closing connection
mysqli_close($link);
	echo "make comment successfully!"
?> 

 <?php
echo "<form method=\"POST\" action=\"get-input-example.php?loginUsername=$login1\">";
echo "<input type=\"submit\" value=\"return to main page\">";
?>

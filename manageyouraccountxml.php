<?php
	require 'authentication.inc';
	require 'db.inc';
	$login = $_GET['login'];
	$lat = $_GET['latitude'];
	$lng = $_GET['longitude'];
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error($link));

	$passwords = mysqlclean($_GET, "passwords", 20, $link);
	$state = mysqlclean($_GET, "state", 20, $link);
	$uname = mysqlclean($_GET, "uname", 20, $link);
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');


//$input_topic = mysqlclean($_GET,"topic",30,$connection);
 //Performing SQL query
$query1 ="update users set login=";
$query1 .="'$login',";
$query1 .="passwords=";
$query1 .="'$passwords',";
$query1 .="uname=";
$query1 .="'$uname',";
$query1 .="location=";
$query1 .="POINTFROMTEXT('POINT($lat $lng)'),";
$query1 .="state=";
$query1 .="'$state'";
$query1 .=" where login=";
$query1 .="'$login';"; 
mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));

// Closing connection
mysqli_close($link);
	echo "change account successfully!"
?> 

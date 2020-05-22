<?php
	require 'authentication.inc';
	require 'db.inc';
	$login = $_GET['login'];
	$lat = $_GET['latitude'];
	$lng = $_GET['longitude'];
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error($link));
	$radius = mysqlclean($_GET, "radius", 20, $link);
	$sttime = mysqlclean($_GET, "sttime", 20, $link);
	$endtime = mysqlclean($_GET, "endtime", 20, $link);
	$dateofweek = mysqlclean($_GET, "dateofweek", 20, $link);
	$relation = mysqlclean($_GET, "relation", 20, $link);
	$state = mysqlclean($_GET, "state", 20, $link);
	$tag = mysqlclean($_GET, "tag", 20, $link);
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');


//$input_topic = mysqlclean($_GET,"topic",30,$connection);
 //Performing SQL query
$query1 ="insert into filter(login, fid, tid, sttime, endtime, dateofweek, location, radius, state, relation) select ";
$query1 .="'$login',";
$query1 .="MAX(fid)+1,";
$query1 .="'$tag',";
$query1 .="'$sttime',";
$query1 .="'$endtime',";
$query1 .="'$dateofweek',";
$query1 .="POINTFROMTEXT('POINT($lat $lng)'),";
$query1 .="'$radius',";
$query1 .="'$state',";
$query1 .="'$relation'";
$query1 .=" from filter  where login=";
$query1 .="'$login';"; 
mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));

// Closing connection
mysqli_close($link);
	echo "make filter successfully!"
?> 

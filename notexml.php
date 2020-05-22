<?php
	require 'authentication.inc';
	require 'db.inc';
	$login = $_GET['login'];
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error($link));
	$radius = mysqlclean($_GET, "radius", 20, $link);
	$sttime = mysqlclean($_GET, "sttime", 20, $link);
	$endtime = mysqlclean($_GET, "endtime", 20, $link);
	$dateofweek = mysqlclean($_GET, "dateofweek", 20, $link);
	$relation = mysqlclean($_GET, "relation", 20, $link);
	$ndesc = mysqlclean($_GET, "ndesc", 20, $link);
	$tag = mysqlclean($_GET, "tag", 20, $link);
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');


//$input_topic = mysqlclean($_GET,"topic",30,$connection);
 //Performing SQL query
$query1 ="insert into note(login, nid, location, radius, sttime, endtime, dateofweek, relation, ndesc) select ";
$query1 .="'$login',";
$query1 .="MAX(nid)+1,";
$query1 .="users.location,";
$query1 .="'$radius',";
$query1 .="'$sttime',";
$query1 .="'$endtime',";
$query1 .="'$dateofweek',";
$query1 .="'$relation',";
$query1 .="'$ndesc'";
$query1 .=" from note,users  where note.login=users.login and users.login=";
$query1 .="'$login';"; 
mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));
$query2 = "insert into notetag select ";
$query2 .="'$login',";
$query2 .="MAX(nid),";
$query2 .="'$tag'";
$query2 .=" from note  where login=";
$query2 .="'$login';"; 
mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

// Closing connection
mysqli_close($link);
	echo "make note successfully!"
?> 

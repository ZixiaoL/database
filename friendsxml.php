<?php
	require 'authentication.inc';
	require 'db.inc';
	$login = $_GET['login'];
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error($link));
	$login2 = mysqlclean($_GET, "login2", 20, $link);
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');


//$input_topic = mysqlclean($_GET,"topic",30,$connection);
 //Performing SQL query
$query1 ="insert into friends values ";
$query1 .="('$login',";
$query1 .="'$login2');";

mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));

// Closing connection
mysqli_close($link);
	echo "send request successfully!"
?> 

<?php
	$login = $_GET['login'];
	$password = $_GET['password'];
	$name =  $_GET['name'];
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error($link));
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');


//$input_topic = mysqlclean($_GET,"topic",30,$connection);
 //Performing SQL query
$query ="insert into users(login, passwords, uname)  values(";
$query .="'$login',";
$query .="'$password',";
$query .="'$name');";
mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

// Closing connection
mysqli_close($link);
	echo "Sign up successfully!"
?> 
<form method="POST" action="login.html">
<input type="submit" value="return to login page">

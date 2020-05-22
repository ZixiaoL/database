<!DOCTYPE html>
 <?php
	$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error());
	$login1 = $_GET['loginUsername'];
	$login2 = $_GET['friend'];
	$query1 ="insert into friends  values";
	$query1 .="('$login1',";
	$query1 .="'$login2');";
	mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));

// Closing connection
mysqli_close($link);
?> 



 <?php
 echo "accept successfully!";
echo "<form method=\"POST\" action=\"get-input-example.php?loginUsername=$login1\">";
echo "<input type=\"submit\" value=\"return to main page\">";
?>




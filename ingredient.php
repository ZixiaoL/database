<?php
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','homework3')
    or die('Could not connect: ' . mysqli_error());
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');


//$input_topic = mysqlclean($_GET,"topic",30,$connection);
$input_cakename = $_GET['cakename']; 
// Performing SQL query
$query = 'SELECT iname,qty FROM cake,contain,ingredient WHERE cakename =';
$query .="\"$input_cakename\" and cake.cakeid=contain.cakeid and contain.ingredid=ingredient.ingredid;";
$result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error());
//print_r($result);
// Printing results in HTML
echo "<table border = \"1\">\n";
	echo "\t<tr>\n";
echo "\t\t<th>ingredient name</th>\n";
echo "\t\t<th>quantity</th>\n";
    echo "\t</tr>\n";

while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
mysqli_free_result($result);

// Closing connection
mysqli_close($link);
?> 

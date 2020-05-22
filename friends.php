<!DOCTYPE html>
 <?php
	echo "all friends\r\n";
	$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error());
	$login = $_GET['loginUsername'];
	echo "\t\t<script>var para1=(\"$login\")</script>\n";
	$query1 ="select f1.login1 from friends as f1 where f1.login2=";
	$query1 .="'$login'";
	$query1 .="and f1.login1 in (select f2.login2 from friends as f2 where f2.login1=";
	$query1 .="'$login')";
	$result = mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));
	echo "<table border = \"1\">";
	echo "\t<tr>\n";
	echo "\t\t<th>friends</th>\n";
    echo "\t</tr>\n";
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";


echo "your friend request<br>";
	$query2 ="select f1.login1 from friends as f1 where f1.login2=";
	$query2 .="'$login'";
	$query2 .=" and f1.login1 not in (select f2.login2 from friends as f2 where f2.login1=";
	$query2 .="'$login')";
	$result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));
	echo "<table border = \"1\">";
	echo "\t<tr>\n";
	echo "\t\t<th>friends</th>\n";
	echo "\t\t<th>accept</th>\n";
    echo "\t</tr>\n";
	while ($line = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
		echo "<form method=\"POST\" action=\"acceptfriends.php?loginUsername=$login&friend=$col_value\">";
		echo "\t\t<td><input type=\"submit\" value=\"accept\"></td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";
	mysqli_free_result($result);
	mysqli_free_result($result2);
// Closing connection
mysqli_close($link);
?> 

<html>
 <head>
  <script>

   function func(){
     var xhr = null;
     var para2 = document.getElementById("login2").value;
     //alert(para1+para2);
	 try{
		xhr = new XMLHttpRequest();
	 }catch(e){
		alert("XMLHttpRequest is not supported!");
	 }
	 var url = "friendsxml.php?login=" + para1 + "&login2=" + para2;
	 //alert(url);
	 xhr.onreadystatechange = handler;
	 xhr.open("GET", url, true);
	 xhr.send(null);
	 
	 function handler(){
		if (xhr.readyState = 4){
			if (xhr.status == 200){
				var element = document.getElementById("sth");
				element.innerHTML = xhr.responseText;
			}else{
			}
		}
	 }
   }


  </script>
 </head>
 <body>


<script>

</script>
</head>

<body>

</form>
  <p>make new friends</p>
  friend id: <input type="text" id="login2"><br />
  <button onclick="func(); return false;">send request</button>
  </br>
  <p id = "sth"></p>
 </body>
</html>


 <?php
echo "<form method=\"POST\" action=\"get-input-example.php?loginUsername=$login\">";
echo "<input type=\"submit\" value=\"return to main page\">";
?>


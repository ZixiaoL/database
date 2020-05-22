<!DOCTYPE html>
 <?php
	echo "all filters\r\n";
	$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error());
	$login = $_GET['loginUsername'];
	echo "\t\t<script>var para1=(\"$login\")</script>\n";
	$query1 ="select login,fid,x(location),y(location),sttime,endtime,radius,dateofweek,relation,state,tid  from filter where login=";
	$query1 .="'$login'";
	$result = mysqli_query($link,$query1) or die('Query failed: ' . mysqli_error($link));
	echo "<table border = \"1\">";
	echo "\t<tr>\n";
	echo "\t\t<th>login</th>\n";
	echo "\t\t<th>fid</th>\n";
	echo "\t\t<th>latitude</th>\n";
	echo "\t\t<th>longitude</th>\n";
	echo "\t\t<th>start time</th>\n";
	echo "\t\t<th>end time</th>\n";
	echo "\t\t<th>radius</th>\n";
	echo "\t\t<th>date of week</th>\n";
	echo "\t\t<th>relation</th>\n";
	echo "\t\t<th>state</th>\n";
	echo "\t\t<th>tag</th>\n";
    echo "\t</tr>\n";
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";
	mysqli_free_result($result);

// Closing connection
mysqli_close($link);
?> 

<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAjht3ppsxR64L38EOzfU83qjTy6XBVfHk&sensor=false">
</script>

<html>
 <head>
  <script>

   function func(){
     var xhr = null;
     var para2 = document.getElementById("radius").value;
	 var para3 = document.getElementById("sttime").value;
	 var para4 = document.getElementById("endtime").value;
	 var para5 = document.getElementById("dateofweek").value;
	 var para6 = document.getElementById("relation").value;
	 var para7 = document.getElementById("state").value;
	 var para8 = document.getElementById("tag").value;
     //alert(para1+para2);
	 try{
		xhr = new XMLHttpRequest();
	 }catch(e){
		alert("XMLHttpRequest is not supported!");
	 }
	 var url = "changefilterxml.php?login=" + para1 + "&radius=" + para2 + "&sttime=" + para3 + "&endtime=" + para4 + "&dateofweek=" + para5 + "&relation=" + para6 + "&state=" + para7 + "&tag=" + para8 + "&latitude=" + lat + "&longitude=" + lng;
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

var map;
var myCenter=new google.maps.LatLng(40.7270599,-73.9885768);
var lat;
var lng;


function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  });
}

function placeMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map,
  });
  lat=location.lat(); lng=location.lng();
  var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });
  infowindow.open(map,marker);
}

google.maps.event.addDomListener(window, 'load', initialize);
  </script>
 </head>
 <body>

 <?php
echo "<form method=\"POST\" action=\"get-input-example.php?loginUsername=$login\">";
echo "<input type=\"submit\" value=\"return to main page\">";
?>

<script>

</script>
</head>

<body>

</body>
</html>

</form>
  <p>make filters</p>
  radius: <input type="text" id="radius"><br />
  start time: <input type="text" id="sttime"><br />
  end time: <input type="text" id="endtime"><br />
  day of week: <input type="text" id="dateofweek"><br />
  relation: <input type="text" id="relation"><br />
  state: <input type="text" id="state"><br />
  tag: <input type="text" id="tag"><br />
  location:<br />
  <div id="googleMap" style="width:500px;height:380px;"></div>
  <br>
  <button onclick="func(); return false;">make filter</button>
  </br>
  <p id = "sth"></p>
 </body>
</html>


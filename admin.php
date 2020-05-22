<script>
var myArray=new Array();
</script>
<?php
require 'authentication.inc';
require 'db.inc';
// Connecting, selecting database
$link = mysqli_connect('localhost', 'lucy','secret','project1')
    or die('Could not connect: ' . mysqli_error());
// echo 'Connected successfully';
//mysql_select_db('pfrankl') or die('Could not select database');


//$input_topic = mysqlclean($_GET,"topic",30,$connection);
$input_custid = 'zixiaoli@nyu.edu'; 
$time = mysqlclean($_POST, "time", 20, $link);
 //Performing SQL query
$query4 ="select note.login,note.nid,note.ndesc,x(note.location),y(note.location) from note, users where users.login=";
$query4 .="'$input_custid'";
$query4 .=" and (note.radius>st_distance(users.location,note.location)) and (note.endtime>";
$query4 .="'$time'";
$query4 .=" or note.endtime is NULL) and (";
$query4 .="'$time'";
$query4 .=">note.sttime or note.sttime is NULL) and (dateofweek=0 or dateofweek in (select dateofweek from calendar where date(";
$query4 .="'$time'";
$query4 .=")=datelist));";
$result = mysqli_query($link,$query4) or die('Query failed: ' . mysqli_error($link));
// Printing results in HTML
echo "<table border = \"1\">";
	echo "\t<tr>\n";
echo "\t\t<th>username</th>\n";
echo "\t\t<th>noteid</th>\n";
echo "\t\t<th>description</th>\n";
echo "\t\t<th>latitude</th>\n";
echo "\t\t<th>longitude</th>\n";
    echo "\t</tr>\n";
	$l=0;
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "\t<tr>\n";
	$i=0;
    foreach ($line as $col_value) {
		if($i==0){$j=$col_value;}
		if($i==1){$k=$col_value;}
        echo "\t\t<td>$col_value</td>\n";
		echo "\t\t<script>myArray[$l]=(\"$col_value\")</script>\n";
		if($i==4){
		echo "<form method=\"POST\" action=\"comment.php?login1=$input_custid&login2=$j&nid=$k\">";
		echo "<td><input type=\"text\" size=\"20\" name=\"com\"></td>";
		echo "<td><input type=\"submit\" value=\"comment\"></td>";
		echo "</form>";
		}
		$i=$i+1;
		$l=$l+1;
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
mysqli_free_result($result);

// Closing connection
mysqli_close($link);

echo "<form method=\"POST\" action=\"manageyouraccount.php?loginUsername=$input_custid\">";
echo "<input type=\"submit\" value=\"manage your account\">";
echo "</form>";
echo "<form method=\"POST\" action=\"friends.php?loginUsername=$input_custid\">";
echo "<input type=\"submit\" value=\"friends\">";
echo "</form>";
echo "<form method=\"POST\" action=\"changefilters.php?loginUsername=$input_custid\">";
echo "<input type=\"submit\" value=\"change filters\">";
echo "</form>";
echo "<form method=\"POST\" action=\"postnotes.php?loginUsername=$input_custid\">";
echo "<input type=\"submit\" value=\"post notes\">";
echo "</form>";
?> 

<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAjht3ppsxR64L38EOzfU83qjTy6XBVfHk&sensor=false">
</script>

<script>
function CustomMarker(latlng, map, args) {
	this.latlng = latlng;	
	this.args = args;	
	this.setMap(map);	
}

CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {
	
	var self = this;
	
	var div = this.div;
	
	if (!div) {
	
		div = this.div = document.createElement('div');
		
		div.className = 'marker';
		
		div.style.position = 'absolute';
		div.style.cursor = 'pointer';
		div.style.width = '20px';
		div.style.height = '20px';
		div.style.background = 'yellow';
		
		if (typeof(self.args.marker_id) !== 'undefined') {
			div.dataset.marker_id = self.args.marker_id;
		}
		
		google.maps.event.addDomListener(div, "click", function(event) {
			alert(myArray[div.dataset.marker_id*5-5]+'\r\n'+myArray[div.dataset.marker_id*5-3]);			
			google.maps.event.trigger(self, "click");
		});

		
		var panes = this.getPanes();
		panes.overlayImage.appendChild(div);
	}
	
	var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
	
	if (point) {
		div.style.left = (point.x - 10) + 'px';
		div.style.top = (point.y - 20) + 'px';
	}
};
function initialize() {
	var myLatlng = new google.maps.LatLng(40.7270599,-73.9885768);

	var mapOptions = {
		zoom: 14,
		center: myLatlng,
		disableDefaultUI: true
	}

	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  });

	var i = 3;
	var ii = (i+2)/5;
	while (i < 50&i<myArray.length){
	var overlay = new CustomMarker(
		myLatlng=new google.maps.LatLng(myArray[i],myArray[i+1]), 
		map,
		{		
		marker_id: ii
		}

	);
	i=i+5;
	ii = (i+2)/5;
	}
}


function placeMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map,
  });
  var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });
  infowindow.open(map,marker);
}



   function func(){
     var xhr = null;
     var para1 = map.getCenter().lat();
     var para2 = map.getCenter().lng();
     //alert(para1+para2);
	 try{
		xhr = new XMLHttpRequest();
	 }catch(e){
		alert("XMLHttpRequest is not supported!");
	 }
	 var url = "changeposition.php?para1=" + para1 + "&para2=" + para2;
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


google.maps.event.addDomListener(window, 'load', initialize);


CustomMarker.prototype.remove = function() {
	if (this.div) {
		this.div.parentNode.removeChild(this.div);
		this.div = null;
	}	
};

CustomMarker.prototype.getPosition = function() {
	return this.latlng;	
};

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="map-canvas" style="width:500px;height:380px;"></div>
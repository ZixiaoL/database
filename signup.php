<!DOCTYPE html>

<html>
 <head>
  <script>
   function func(){
     var xhr = null;
     var para1 = document.getElementById("login").value;
     var para2 = document.getElementById("password").value;
	 var para3 = document.getElementById("name").value;
     //alert(para1+para2);
	 try{
		xhr = new XMLHttpRequest();
	 }catch(e){
		alert("XMLHttpRequest is not supported!");
	 }
	 var url = "xml.php?login=" + para1 + "&password=" + para2 + "&name=" + para3;
	 //alert(url);
	 xhr.onreadystatechange = handler;
	 xhr.open("GET", url, true);
	 xhr.send(null);
	 
	 function handler(){
		if (xhr.readyState = 4){
			if (xhr.status == 200){
				var element = document.getElementById("sth");
				element.innerHTML = xhr.responseText;

				var child2=document.getElementsByTagName("button")[0];
				child2.parentNode.removeChild(child2);
				var child=document.getElementsByTagName("br")[2];
				child.parentNode.removeChild(child);
			}else{
			}
		}
	 }
   }
  </script>
 </head>
 <body>
  <p>sign up</p>
  login: <input type="text" id="login"><br />
  password: <input type="text" id="password"><br />
  name: <input type="text" id="name">
  <br>
  <button onclick="func(); return false;">sign up</button>
  </br>
  <p id = "sth"></p>
 </body>
</html>

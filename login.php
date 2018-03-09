<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<script type="text/javascript">
		function createUser() {
		  var name = document.getElementById('userName').value;
		  var password = document.getElementById('password').value;
		  // De esta forma se obtiene la instancia del objeto XMLHttpRequest
		  if(window.XMLHttpRequest) {
		    connection = new XMLHttpRequest();
		  }
		  else if(window.ActiveXObject) {
		    connection = new ActiveXObject("Microsoft.XMLHTTP");
		  }
		 
		  // Preparando la función de respuesta
		  connection.onreadystatechange = response;
		 
		  // Realizando la petición HTTP con método POST
		  connection.open('POST', 'http://localhost:8888/apiRmusicalRodrigo/public/index.php/users/login.json');
		  connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		  connection.send("userName=" + name + "&password=" + password);
		}
		 
		function response() {
		  if(connection.readyState == 4) {
		  	var response = JSON.parse(connection.responseText);
		  	console.log(response);
		  	if (response.code == '200') {
		  		localStorage.setItem("token", response.data.token);
		  		localStorage.setItem("username", response.data.username);
		  		window.location.href = "http://localhost:8888/apiMusicaCliente/songs.php";
		  	}
		  	if (response.code == '401') {
		  		alert(response.message);
		  	}
		  	
		  }
		}
	</script>
</head>
<body>
	<label>Username</label>
	<input id='userName' type="text">
	<label>Password</label>
	<input id='password' type="text">
	<button onclick='createUser()'>Crear</button>
</body>
</html>

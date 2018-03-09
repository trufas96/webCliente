<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <script type="text/javascript">
        function createSongs() {
      var titleL = document.getElementById('title').value;
      var urlL = document.getElementById('url').value;
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
      connection.open('POST', 'http://localhost:8888/apiRmusicalRodrigo/public/index.php/songs/create.json');
      connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      connection.setRequestHeader("Authorization", localStorage.getItem("token"));

      connection.send("title=" + titleL + "&url=" + urlL);
    }
     
    function response() {
      if(connection.readyState == 4) {
        var response = JSON.parse(connection.responseText);
        console.log(response);
        if (response.code == '200') {
          localStorage.setItem("title", response.data.titleL);
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
      <label>List</label>
      <input id='title' type="text">
      <label>URL</label>
      <input id='url' type="text">
      <button onclick='createSongs()'>Crear</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>  
</body>
</html>
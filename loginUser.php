<?php
   //Se incluye el archivo config para realizar la conexión con la base de datos.
   include("config.php");
   //Se inicia la sesión.
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      //Número de reporte y placas enviados de la forma.
      $myreporte = mysqli_real_escape_string($db,$_POST['reporte']);
      $myplacas = mysqli_real_escape_string($db,$_POST['placas']); 
      
      //Query para obtener las placas del registro que tenga $myreporte y $myplacas
      $sql = "SELECT placas FROM Accidents WHERE noSiniestro = '$myreporte' and placas = '$myplacas'";
      $result = mysqli_query($db,$sql);

      //Convierte el resultado del query a un arreglo.
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      //Guarda el número de filas.
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
         //Si el número de filas es igual a uno, se inicia la sesión y se guardan las placas y el número de reporte.

         session_start();
         $_SESSION['login_reporte'] = $myreporte;
         $_SESSION['login_placas'] = $myplacas;

         //Redirecciona a la página user.
         header("location: user.php");
         exit();

      }else {
         //Si no se encuentra un registro con esa combinación indica error al usuario.
         $error = "Combinación incorrecta.";
      }
   }
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title> ServiAuto</title>
   <link rel = "stylesheet" href="css/styles.css">
</head>
<body>
   <div id="login">
      <div id="contenedor">
         <form action = "" method = "POST">
            <p>Número de reporte:</p>
            <input type="text" name="reporte">
            <br>

            <p>Placas:</p>
            <input type="password" name="placas">
            <br>
            <br>
            <br>
            <input class = 'button' type = "submit" value = " Ingresar "/>
         </form>
         <br>
         <div class = 'error'><?php echo $error; ?></div>
      </div>
   </div>
</body>
</html>

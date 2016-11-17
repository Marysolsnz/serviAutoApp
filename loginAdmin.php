<?php
   //Se incluye el archivo config para realizar la conexión con la base de datos.
   include("config.php");
   //Se inicia la sesión.
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       //Usuario y contraseña enviados de la forma.
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      //Query para obtener el usuario del registro que tenga $myusername y $mypassword.
      $sql = "SELECT usuario FROM Admins WHERE usuario = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      
      //Guarda el número de filas.
      $count = mysqli_num_rows($result);

      if($count == 1) {
         //Si el número de filas es igual a uno, se inicia la sesión y se guarda el usuario.
         session_start();
         $_SESSION['login_user'] = $myusername;

         //Redirecciona a la página de administrador.
         header("location: adminList.php");
         exit();

      }else {
         //Si no se encuentra un registro con esa combinación indica error al usuario.
         $error = "Usuario y/o contraseña incorrecta. ";
      }
   }
?>
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
            <p>Usuario</p>
            <input type="text" name="username">
            <br>

            <p>Contraseña</p>
            <input type="password" name="password">
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

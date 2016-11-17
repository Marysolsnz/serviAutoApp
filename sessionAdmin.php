<?php
   //Se incluye el archivo de configuración con la conexión a la bd.
   include('config.php');
   //Se inicia la sesión.
   session_start();

   //Se obtiene el usuario.
   $user_check = $_SESSION['login_user'];

    //Se realiza un query en la base de datos para confirmar el usuario.
   $ses_sql = mysqli_query($db,"select usuario from Admins where usuario = '$user_check' ");

   //Convierte el resultado del query en un arreglo.
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['usuario'];

   //Realiza un query para obtener toda la información del accidente y el vehículo.
   $query = "SELECT * FROM Accidents  natural join Vehicles";
   $qresult = mysqli_query($db, $query);

   //Verifica que la sesión siga activa para evitar accesos no autorizados.
   if(!isset($_SESSION['login_user'])){
      header("location:loginAdmin.php");
   }
?>

<?php
   //Se incluye el archivo de configuración con la conexión a la bd.
   include('config.php');
   //Se inicia la sesión.
   session_start();
   
   //Se obtiene el número de reporte y las placas de la sesión.
   $reporte_check = $_SESSION['login_reporte'];
   $placas_check = $_SESSION['login_placas'];
   
   //Se realiza un query en la base de datos para confirmar el número de siniestro.
   $ses_sql = mysqli_query($db,"select noSiniestro from Accidents where noSiniestro = '$reporte_check' ");
   
   //Convierte el resultado del query en un arreglo. 
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['noSiniestro'];

   //Realiza un query para obtener toda la información del accidente y el vehículo.
   $query = "SELECT * FROM Accidents natural join Vehicles WHERE noSiniestro = '$reporte_check' and placas = '$placas_check'";
   $qresult = mysqli_query($db, $query);
   $qrow = mysqli_fetch_array($qresult,MYSQLI_ASSOC);

   //Verifica que la sesión siga activa para evitar accesos no autorizados. 
   if(!isset($_SESSION['login_reporte'])){
      header("location:loginUser.php");
   }
?>

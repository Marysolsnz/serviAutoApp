<?php
	//Cierra la sesión y redirige al login del administrador.
   session_start();
   
   if(session_destroy()) {
      header("Location: loginAdmin.php");
   }
?>
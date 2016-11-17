<?php
	//Cierra la sesión y redirige al login del usuario.
   session_start();
   
   if(session_destroy()) {
      header("Location: loginUser.php");
   }
?>
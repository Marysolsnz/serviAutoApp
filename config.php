<?php
	//Crear la conexión con la base de datos.
   define('DB_SERVER', '127.0.0.1:8889');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'proyectoWeb');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
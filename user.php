<?php
	//incluye el archivo sessionUser.
   include('sessionUser.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Estado del vehículo</title>
	<link rel = "stylesheet" href="css/user.css">
</head>
<body>
	<div class="contenedor">
		<div class="left">
			<h2>Bienvenido <?php echo $qrow["nombre"]; ?></h2>
			<div class="texto">
				<p>Fecha de ingreso: <span class="info"><?php echo $qrow["fechaArribo"]; ?></span><p>
				<p>Auto: <span class="info"><?php echo $qrow["modelo"]. " " . $qrow["marca"]; ?></span> <p>
				<p>Año: <span class="info"><?php echo $qrow["ano"]; ?></span> <p>
				<p>Placas: <span class="info"><?php echo $qrow["placas"]; ?></span><p>

				<img class="photo" src="<?php echo "img/" . $qrow["noSiniestro"] . ".jpg"; ?>"></img>
				<p>Área actual del vehículo: <p>
				<p class="info"><?php echo $qrow["areaActual"] . ":"; ?><p>

				<progress value="<?php echo $qrow["progreso"]; ?>" max="100"></progress><span> <?php echo $qrow["progreso"] . "%"; ?></span>

				<p>Fecha estimada de entrega: <span class="info"><?php echo $qrow["fechaSalida"]; ?></span><p>
			</div>
		</div>
		
		<div class="right">
			<br>
			<div style = "padding-right: 8em ; float: bottom"  align="right">
				<a id = "salir" href = "logoutUser.php">Cerrar sesión</a></div>
			<div class="texto">
				<p class="areas">Áreas pendientes: </p>
				<div class = "pendientes">
					<br>
					<?php 
						if($qrow["mecanica"])
							echo "Mecánica" . "<br>" . "<br>";
						if($qrow["laminado"])
							echo "Laminado" . "<br>" . "<br>";
						if($qrow["pintura"])
							echo "Pintura" . "<br>" . "<br>";
						if($qrow["detallado"])
							echo "Detallado" . "<br>" . "<br>";
					 ?>
				</div>
				<br>
				<p class="info">¿Tienes alguna pregunta?</p>
				<textarea></textarea>
				<button id="enviar">Enviar</button>
				<button id="llamar">Llamar</button>
			</div>
		</div>
	</div>

</body>
</html>
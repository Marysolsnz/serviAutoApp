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
				<br><br>
				<p class="info">¿Tienes alguna pregunta?</p>
				<form method="post">
                                <textarea name="question" rows="7" ></textarea>
                                <button id="enviar" type="submit">Enviar</button>
                                </form>
                                <?php  
                                if (isset($_REQUEST['question']))  {            
                                // El mensaje
                                $msg = "from: ".$qrow["correo"]."\n";
                                $msg = $msg."\n".$_REQUEST['question'];
                                // se utiliza wordwrap() si las líneas son más largas que 70 caracteres.
                                $msg = wordwrap($msg,70);
                                $subject = $qrow["noSiniestro"];

                                // Enviar el correo
                                mail("serviautogdlwebapp@gmail.com","$subject",$msg);
                                }
                                ?>
                                <button id="llamar" onclick="phone()">Llamar</button>
			</div>
		</div>
	</div>
<script>
function phone() {
    alert("Comunícate con nosotros: \n 38127599 ");
}
</script>
</body>
</html>
<?php
	//incluye el archivo sessionAdmin.
   include('sessionAdmin.php');

   //Se llama a la página para realizar la búsqueda.
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   		$search =$_POST['search'];

   		if(!empty($search)){
   			header("location: adminListSearch.php?search=$search" );
   		}
   }

?>

<html>
<head>
	<meta charset="utf-8">
	<title>Autos registrados</title>
	<link rel = "stylesheet" href="css/admin.css">
</head>
<body>


	<div class="contenedor">

		<div class="left1">
			<div align="left" style="margin-top:3em ; margin-left:3em ;" >
				<h1>Registro de Autos</h1>
				<form action = "" method = "POST">
					<input type="text" name="search">
					<button id="enviar" type="submit" style="width:12%">Buscar</button>
				</form>
			</div>
		</div>

		<div class="right1">
			<div align="right">
				<br>
				<a style ="padding-right:2em"  href="logoutAdmin.php">Cerrar sesión</a>
			</div>
		</div>

		<div align="center">
			<div align="right">
				<br>
				<button style="width: 13%; margin-right:3em" id="blue"  onclick="window.location.href='adminInsert.php'">+ Agregar Siniestro</button>
			</div>
			<br>

			<div class="scroll">
				<table style="width:95%">
				  <tr>
				    <th>#Siniestro</th>
				    <th>Placas</th>
						<th>Cliente</th>
						<th>Vehiculo</th>
						<th>Fecha de ingreso</th>
				    <th>Opciones</th>
				  </tr>

					<?php
               while ($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)) {
                   	echo "<tr>";
						echo "<td>".$row["noSiniestro"]."</td>";
						echo "<td>".$row["placas"]."</td>";
                   		echo "<td>".$row["nombre"]."</td>";
						echo "<td>".$row["marca"]." ".$row["modelo"]." ".$row["ano"]."</td>";
						echo "<td>".$row["fechaArribo"]."</td>";
                   		echo "<td><a href='adminView.php?no=".$row["noSiniestro"]."'>Editar</a> <a href='adminDelete.php?no=".$row["noSiniestro"]."&pl=".$row["placas"]."'>Eliminar</a></td>";

                   echo "</tr>";
								 }

            ?>

				</table>
			</div>
		</div>


	</div>

</body>
</html>

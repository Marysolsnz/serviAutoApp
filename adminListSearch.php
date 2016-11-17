<?php
	//Se incluye el archivo sessionAdmin
   include('sessionAdmin.php');
   $search = $_GET['search'];

  	//Se busca en la bases de datos los registro que contenga lo que se busca
   $cquery = "SELECT * FROM Accidents  natural join Vehicles WHERE noSiniestro = '$search' or placas = '$search' or fechaArribo = '$search'or nombre = '$search' or marca = '$search' or modelo = '$search' or ano = '$search'";
   $cqresult = mysqli_query($db, $cquery);

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
				<h1>Resultados de búsqueda</h1>
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
               while ($row = mysqli_fetch_array($cqresult, MYSQLI_ASSOC)) {
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
				<div align="right">
				<br>
				<a style ="padding-right:2em"  href="adminList.php">Limpiar búsqueda</a>
			</div>
			</div>
		</div>
	</div>

</body>
</html>

<?php
  //Se incluye el archivo sessionAdmin
  include('sessionAdmin.php'); 

   //Se obtiene el número de siniestro con el método GET.
   $noSin = $_GET['no'];

   //Query para obtener toda la información del número de siniestro.
   $mquery = "SELECT * FROM Accidents natural join Vehicles WHERE noSiniestro = '$noSin'";
   $mresult = mysqli_query($db, $mquery);
   $mrow = mysqli_fetch_array($mresult,MYSQLI_ASSOC);
   
   //Se guardan las placas actuales en caso de que se deban modificar.
   $originalPlacas= $mrow["placas"];


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      //Se actualizan los valores en la base de datos con los nuevos datos.
      $placas =$_POST['placas'];

      $siniestro = $_POST['siniestro'];
      $nombre = $_POST['nombre'];
      $correo = $_POST['correo'];
      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $ano = $_POST['ano'];
      $placas =$_POST['placas'];
      $actual2 = $_POST['actual2'];
      $fechaSalida =$_POST['edate'];
      $progreso =$_POST['progress'];
      $mecanica = 0;
      $laminado = 0;
      $pintura = 0;
      $detallado = 0;
      if(isset($_POST['m'])){
        $mecanica = 1;
      }
      if(isset($_POST['l'])){
        $laminado = 1;
      }
      if(isset($_POST['p'])){
        $pintura = 1;
      }
      if(isset($_POST['d'])){
        $detallado = 1;
      }

      $updateQuery = "UPDATE Accidents SET placas = '$placas' ,  fechaSalida = '$fechaSalida' , nombre='$nombre' , progreso = '$progreso' ,mecanica='$mecanica',laminado='$laminado', pintura='$pintura',detallado='$detallado', areaActual ='$actual2', correo = '$correo' WHERE noSiniestro = '$noSin'";

      $updateQuery2 = "UPDATE Vehicles SET placas = '$placas' , marca='$marca', modelo='$modelo', ano = '$ano' WHERE placas = '$originalPlacas' ";

      $result = mysqli_query($db,$updateQuery);

      $result2 = mysqli_query($db,$updateQuery2);

      //Se actualiza la imagen
      if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
        
        $expensions= array("jpeg","jpg","png");
      
        if(in_array($file_ext,$expensions)=== false){
           $errors[]= "Archivo no válido, por favor seleccione una imagen JPEG, JPG o PNG.";
        }
      
        if($file_size > 2097152){
           $errors[]='La imagen es demasiado grande.';
        }
      
        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"img/".$noSin.".jpg");
        }
      }

      //Se recarga la página.
      header("location: adminView.php?no=$noSin" );

    }

?>

<html>
<head>
	<meta charset="utf-8">
	<title>Modificar estado</title>
	<link rel = "stylesheet" href="css/admin.css">
</head>
<script>
//Permite que el slider actualice el valor del progreso.
function changeValue(sliderID, textbox) {
        var y = document.getElementById(sliderID);
        document.getElementById(textbox).innerHTML = y.value+"%";

    }
</script>
<body>
	<div class="contenedor">

		<div class="left">
      <h2>Edición de estado: <?php echo $noSin; ?></h2>

			<div class="texto">
        <form action = "" method = "POST" enctype="multipart/form-data">

        <p>Nombre: <input type="text" name="nombre" value="<?php echo $mrow["nombre"]; ?>"> <p>
        <p>Correo: <input type="text" name="correo" value="<?php echo $mrow["correo"]; ?>"> <p>
				<p>Marca: <input type="text" name="marca" value="<?php echo $mrow["marca"]; ?>"><p>
        <p>Modelo: <input type="text" name="modelo" value="<?php echo $mrow["modelo"]; ?>"><p>
				<p>Año: <input type="text" name="ano" value="<?php echo $mrow["ano"]; ?>"> <p>
				<p>Placas: <input type="text" name="placas" value="<?php echo $mrow["placas"]; ?>"><p>

        <div class="wrapper_foto">
          <img class="photo" src="<?php echo "img/" . $mrow["noSiniestro"] . ".jpg"; ?>"></img>
          <br>
          <br>
          <input type="file" name="image"/>
        </div>
      

			</div>
		</div>
    <div class="right" style="margin-top:5vh">
      <div align="right">
      <a  style ="padding-right:2em"  href="adminList.php">Regresar</a>
      </div>
      <div class="texto">
        <p style="margin-top:2em;">Área actual del vehículo: <p>
        <select name = "actual2">
          <option value="Mecanica" <?php if(strcmp($mrow["areaActual"],"Mecanica")==0) {echo selected;}?> >Mecánica</option>
          <option value="Laminado" <?php if(strcmp($mrow["areaActual"],"Laminado")==0) {echo selected;}?>>Laminado</option>
          <option value="Pintura"  <?php if(strcmp($mrow["areaActual"],"Pintura")==0) {echo selected;}?>>Pintura</option>
          <option value="Detallado"<?php if(strcmp($mrow["areaActual"],"Detallado")==0) {echo selected;}?>>Detallado</option>
        </select>



				<p>Fecha estimada de entrega: <input type="date" name="edate" value="<?php echo $mrow["fechaSalida"]; ?>"><p>

				<p class="areas">Áreas pendientes: </p>
				<div class = "pendientes">
          <p style="margin-top: 2em;"></p>
          <input type="checkbox" name="m" <?php if($mrow["mecanica"]==1) {echo checked;}?> >Mecánica

          <br>
          <input type="checkbox" name="l" <?php if($mrow["laminado"]==1) {echo checked;}?>>Laminado
          <br>
          <input type="checkbox" name="p" <?php if($mrow["pintura"]==1) {echo checked;}?> >Pintura
          <br>
          <input type="checkbox" name="d" <?php if($mrow["detallado"]==1) {echo checked;}?>>Detallado
          <br>
				</div>
				<br>

        <div class="wrapper_options">
          <input id = "sliderProgress" name = "progress"; type="range" name="points" value="<?php echo $mrow["progreso"];?>" min="0" max="100" step="5" onchange="changeValue('sliderProgress','sliderValue')"  ><span id="sliderValue"> <?php echo $mrow["progreso"]; ?>% </span>
          <br>
          <input class="button" type="submit" style="margin-top:2em; width:33% v" value = "Guardar cambios">
          </form>

        </div>
			</div>
		</div>
	</div>

</body>
</html>

<?php
    //Se incluye el archivo sessionAdmin.
   include('sessionAdmin.php');
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $nombre = $_POST['nombre'];
      $correo = $_POST['correo'];
      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $ano = $_POST['ano'];
      $placas =$_POST['placas'];
      $actual = $_POST['actual'];
      $fechaSalida =$_POST['edate'];
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

      //Se insertan los datos obtenidos del POST a la base de datos.
      $insert = "INSERT INTO Accidents (placas, fechaSalida, areaActual, mecanica, laminado, pintura, detallado, nombre, correo) VALUES ('$placas', '$fechaSalida', '$actual', '$mecanica', '$laminado', '$pintura', '$detallado', '$nombre', '$correo')";

      $insert2 = "INSERT INTO Vehicles VALUES ('$placas', '$modelo', '$marca', '$ano')";

      mysqli_query($db, $insert); 
      mysqli_query($db, $insert2);

      //Se obtiene el número de siniestro del registro recién creado.
      $squery = "SELECT noSiniestro FROM Accidents WHERE placas = '$placas'";
      $sresult = mysqli_query($db, $squery);
      $srow = mysqli_fetch_array($sresult,MYSQLI_ASSOC);
      $imgsin = $srow["noSiniestro"];


      //Se inserta la imagen si hay una.
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
           move_uploaded_file($file_tmp,"img/".$imgsin.".jpg");
        }
    }

      header("location: adminList.php");

    }

?>

<html>
<head>
  <meta charset="utf-8">
  <title>Crear registro</title>
  <link rel = "stylesheet" href="css/admin.css">
</head>
<body>
  <div class="contenedor">

    <div class="left">
      <h2>Nuevo registro</h2>

      <div class="texto">
        <form action = "" method = "POST" enctype="multipart/form-data">
        
        <br>
        <br>

        <p>Nombre: <input type="text" name="nombre"><p>
        <p>Correo: <input type="text" name="correo"><p>
        <p>Marca: <input type="text" name="marca"><p>
        <p>Modelo: <input type="text" name="modelo"><p>
        <p>Año: <input type="text" name="ano"><p>
        <p>Placas: <input type="text" name="placas"><p>

        <input type="file" name="image"/>
        
      </div>
    </div>
    <div class="right" style="margin-top:5vh">
      <div align="right">
      <a  style ="padding-right:2em"  href="adminList.php">Regresar</a>
      </div>
      <div class="texto">
        <p style="margin-top:2em;">Área actual del vehículo: <p>
        <select name = "actual">
          <option value="Mecanica">Mecánica</option>
          <option value="Laminado">Laminado</option>
          <option value="Pintura">Pintura</option>
          <option value="Detallado">Detallado</option>
        </select>


        <p>Fecha estimada de entrega: <input type="date" name="edate"><p>

        <p class="areas">Áreas pendientes: </p>
        <div class = "pendientes">
          <p style="margin-top: 2em;"></p>
          <input type="checkbox" name="m">Mecánica
          <br>
          <input type="checkbox" name="l">Laminado
          <br>
          <input type="checkbox" name="p">Pintura
          <br>
          <input type="checkbox" name="d">Detallado
          <br>
        </div>
        <br>

        <div class="wrapper_options">
          <br>
          <input class="button" type="submit" style="margin-top:2em; width:33% v" value = "Guardar">
          </form>

        </div>
      </div>
    </div>
  </div>

</body>
</html>

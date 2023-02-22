<?php 
require_once '../model/conexion/conexion.php';            
     $msg = "";
     $id = $_POST["id"];
    // $nombre = $_POST["nombre"];
    // $precioVenta = $_POST["precioVenta"];
    // $precioCompra = $_POST["precioCompra"];
    // $existencia = $_POST["existencia"];
    
     $sentencia = "SELECT * FROM materia_prima WHERE id = '$id' and active = 1";
    
     $operacion = mysqli_query($conn, $sentencia) or die(mysqli_error($conn));    
    $result = mysqli_fetch_array($operacion);
     $msg = $result["id"].",".$result["nombre"].",".$result["cantidad"];

     mysqli_free_result($operacion);
     mysqli_close($conn);
     echo $msg;


?>
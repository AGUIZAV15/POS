<?php 
 require_once '../model/conexion/conexion.php';            
 session_start();
 $msg = "";
    $nombre = $_POST["user"];
    $contraseña = $_POST["password"];
   
    
    $sentencia = 
    "SELECT * FROM `user` WHERE user.nombre = '".$nombre."' AND contraseña = AES_ENCRYPT('".$contraseña."','señor_que_esto_funcione_amen')";
    $result = mysqli_query($conn, $sentencia) or die(mysqli_error($conn));    
    $count = 0;
    $id = 0;
    foreach($result as $val):
        $count = $count + 1;
        $id = $val['id_user'];
    endforeach;

    if($count == 1 && $id > 0){
        mysqli_free_result($result);
        mysqli_close($conn);
        $_SESSION['usuario'] = $nombre;
        $_SESSION['id_usuario'] = $id;
        $msg = "ok";
       
    }else{
        $msg = "error";
    }    

echo $msg;
?>
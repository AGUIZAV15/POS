<?php 
 require_once '../model/conexion/conexion.php';            
    
 
 $id = $_POST['id'];
               
 
    $res = mysqli_query($conn, "UPDATE `ventas` SET `status_venta` = '2' WHERE `ventas`.`id` =".$id) or die(mysqli_error($conn));    
 
if($res === true){
    mysqli_close($conn); 
    echo "ok";
}else{
    echo "err";
}

?>
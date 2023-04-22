<?php 
 require_once '../model/conexion/conexion.php';            
    
 
 $id = $_POST['id'];
               
 
    $res = mysqli_query($conn, "UPDATE `message` SET `message_status` = '2' WHERE `message`.`message_id` =".$id) or die(mysqli_error($conn));    
 
if($res === true){
    mysqli_close($conn); 
    echo "ok";
}else{
    echo "err";
}

?>
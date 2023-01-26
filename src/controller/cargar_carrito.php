<?php 
require_once '../model/conexion/conexion.php';  

$result = mysqli_query ($conn,"SELECT * FROM carrito WHERE status = 1") or die(mysqli_error($conn));
$qty = 0;

foreach ($result as $val): 
$qty += $val['cantidad'];
endforeach;

echo $qty;
mysqli_free_result($result);
mysqli_close($conn);
?>

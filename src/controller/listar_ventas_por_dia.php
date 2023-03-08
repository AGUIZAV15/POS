<?php 
require_once '../model/conexion/conexion.php';

$result = mysqli_query ($conn,"SELECT fecha, SUM(total - (descuento * total)/100 ) AS total FROM `ventas` WHERE status_venta = 1 GROUP BY fecha ORDER BY fecha DESC") or die(mysqli_error($conn));
?>
 <?php foreach ($result as $val): ?>
 <div class="col-12 col-sm-12">
    <div class="card border-warning">
      <div class="card-header">
      <h5 class="card-title"><?php echo "Total de vendido el día: ".$val["fecha"]; ?></h5>    
      </div>
      <div class="card-body">
    <center>
      <?php 
           $t = sprintf("%.2f", floatval($val["total"]));           
           echo "<h4>TOTAL VENDIDO: <b>$".$t."</b></h4>";
           ?>
           </center>                 
    </div>
    </div>
    <?php endforeach ?>
   
     
        

        
        
  <?php 
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>


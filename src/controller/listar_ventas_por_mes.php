<?php 
require_once '../model/conexion/conexion.php';

$result = mysqli_query ($conn,"SELECT MONTH(fecha) AS mes, SUM(total - (descuento * total)/100 ) AS total FROM `ventas` WHERE status_venta = 1 GROUP BY MONTH(fecha) ORDER BY MONTH(fecha) DESC;") or die(mysqli_error($conn));
?>
 <?php foreach ($result as $val):  
  $numero = intval($val["mes"]);
  $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    
  ?>
 <div class="col-12 col-sm-12">
    <div class="card border-warning">
      <div class="card-header">
      <h5 class="card-title"><?php echo "Total de vendido en: ".strtoupper($meses[$numero - 1]); ?></h5>    
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


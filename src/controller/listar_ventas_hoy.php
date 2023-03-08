<?php 
require_once '../model/conexion/conexion.php';

$totalVendido = 0.0;

$result = mysqli_query ($conn,"SELECT * FROM ventas WHERE status_venta = 1 AND fecha = CURDATE()") or die(mysqli_error($conn));
?>
 <?php foreach ($result as $val): ?>
 <div class="col-12 col-sm-12">
    <div class="card border-warning">
      <div class="card-body">
    <h5 class="card-title"><?php echo "Venta No. ".$val["id"]."&nbsp;&nbsp;Fecha: ".$val["fecha"]; ?></h5>    
    <div class="container">
<div class="row">   
 <div id="rellenarProductosVender">
 <table class="table align-middle">
        <tr>
            <th>Nombre</th>
            <th>Cant. X Precio</th>
        </tr>
        <?php 
    $res = mysqli_query ($conn,"SELECT nombre,cantidad,costo_producto,id_venta FROM productos INNER JOIN productos_vendidos ON productos.id = productos_vendidos.id_producto WHERE productos.active = 1 AND id_venta =".$val['id']) or die(mysqli_error($conn));
    foreach ($res as $v):
        ?>
        <tr>
            <th><?php echo $v['nombre'];?></th>
            <th><?php echo $v['cantidad']."&nbsp;X&nbsp;".$v['costo_producto']?></th>
        </tr>       
<?php
    endforeach;
    ?>
     </table>
    </div>
</div>
</div>     
      <div class="card-footer">
      <?php 
           $t = sprintf("%.2f", floatval($val["total"]));
           $d = sprintf("%.1f", floatval($val["descuento"]));
           $totalVendido += (floatval($val["total"]) - (floatval($val["total"]) * floatval($val["descuento"]))/100);
           echo "TOTAL: <b>$".$t."</b> DESCUENTO: <b>".$d." %</b> ";
           ?>
           <br>           
      </div>
    </div>
    </div>
    <?php endforeach ?>
    <div class="card border-warning">
  <div class="card-body">
    <center>
  <?php 
           $t = sprintf("%.2f", floatval($totalVendido));           
           echo "<h3>TOTAL VENDIDO EN EL DÍA: <b>$".$t."</b></h3>";
           ?>
           </center>
  </div>
</div>
     
        

        
        
  <?php 
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>


<table class="table align-middle">
     <tr>
   <!-- <th>Codigo</th> -->
    <th>Nombre</th>
        <th>Precio X Cantidad</th>
   <!-- <th>Precio Compra</th> -->   
    <th>Total</th>    
    <th>Quitar Elmnt.</th> 
  </tr>
 <?php 
  require_once '../model/conexion/conexion.php'; 
  $costoTotal = floatval(0);
  $result = mysqli_query ($conn,"SELECT carrito.id AS cid,nombre, precio_venta, cantidad, existencia
  FROM productos
  INNER JOIN carrito ON productos.id = carrito.id_producto WHERE productos.active = 1 AND carrito.status = 1") or die(mysqli_error($conn));
  ?>
      <?php foreach ($result as $val): 
        $costo = floatval($val["precio_venta"]);
        $cantidad = floatval($val["cantidad"]);
        $existencia = floatval($val['existencia']);
        $total = $costo * $cantidad;
        $costoTotal = $costoTotal + $total;
        if(($existencia - $cantidad) >= 0){       
        ?>
        <tr>
            <!--<td></td>-->
            <td><?php echo $val["nombre"]; ?></td>
            <td class="text-nowrap"><?php echo "$".sprintf("%.2f", $costo)." x ".$cantidad; ?></td>           
            <td><?php echo "$".sprintf("%.2f", $total); ?></td>
            <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarProductoVenta(<?php echo $val['cid']; ?>,<?php echo $cantidad; ?>)"><i class="fa-solid fa-minus"></i></button>                  
        </tr>
        <?php } else {?>
          <tr class="table-danger">
            <!--<td></td>-->
            <td><?php echo $val["nombre"]; ?></td>
            <td class="text-nowrap"><?php echo "$".sprintf("%.2f", $costo)." x ".$cantidad; ?></td>           
            <td><?php echo "$".sprintf("%.2f", $total); ?></td>
            <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarProductoVenta(<?php echo $val['cid']; ?>,<?php echo $cantidad; ?>)"><i class="fa-solid fa-minus"></i></button>                  
        </tr>
          
        <?php } ?>
        <?php endforeach; ?>
  <?php 
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>
  <tfoot>
    <tr>
        <td colspan="2"><p class="text-center"><b>TOTAL</b></p></td>
        <!-- <td></td>
        <td></td> -->
        <td><span id='cTotal'><?php echo "$".sprintf("%.2f", $costoTotal); ?></span></td>
        <td></td>
    </tr>
  </tfoot>
  </table>

  
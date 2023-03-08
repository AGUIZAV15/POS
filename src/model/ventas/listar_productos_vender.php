<table class="table">
  <thead>
  <tr>
   <!-- <th>Codigo</th> -->
    <th>Producto</th>
        <th>Precio</th>
   <!-- <th>Precio Compra</th> -->
    <th>
    <div class="d-flex justify-content-center">   
    Añadir al carrito
    </div>
  </th>        
  </tr>
  </thead>   
<tbody class="busquedaRapida">
<?php 
require_once '../conexion/conexion.php';

include "../../templates/header.php";

$result = mysqli_query ($conn,"SELECT * FROM productos WHERE active = 1 AND existencia > 0") or die(mysqli_error($conn));
?>
 <?php foreach ($result as $val): ?>
 <tr>
    <td><?php echo $val["nombre"]." (".$val["codigo"].")"; ?></td>
    
    <td>
          <?php 
           $pv = sprintf("%.2f", floatval($val["precio_venta"]));
           echo "<b>$".$pv."</b>";
           ?>
     </td>
     <td>     
          <div class="d-flex justify-content-center">                  
            <button class="btn btn-primary" onclick="añadirAlCarrito(<?php echo $val['id'];?>)"><i class="fa-solid fa-cart-shopping"></i></button>       
          </div>
      </td>
    </tr>
    <?php endforeach ?>
   
     
        
          
<!--            
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modificarModal" onclick = "llenarCamposTexto( <?php echo $val['id']; ?> )"><i class="fa-solid fa-pen-to-square"></i></button>                 
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"  data-bs-target="#eliminarModal" onclick="idProductoEliminar( <?php echo $val['id']; ?> )"><i class="fa-solid fa-trash"></i></button>
                </div> -->
        
        
  <?php 
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>
</tbody>
<?php  include "../../templates/footer.php"; ?>
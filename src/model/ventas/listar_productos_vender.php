<?php 
require_once '../conexion/conexion.php';

include "../../templates/header.php";

$result = mysqli_query ($conn,"SELECT * FROM productos WHERE active = 1") or die(mysqli_error($conn));
?>
 <?php foreach ($result as $val): ?>
 <div class="col-12 col-sm-12">
    <div class="card">
      <div class="card-body">
    <h5 class="card-title"><?php echo $val["nombre"]." (".$val["codigo"].")"; ?></h5>
    <p class="card-text"> 
    <?php 
           $pv = sprintf("%.2f", floatval($val["precio_venta"]));
           echo "Precio del producto: <b>$".$pv."</b>";
           ?>
           <br>
           
    </p>
    <div class="d-flex justify-content-end">                  
    <button class="btn btn-primary" onclick="añadirAlCarrito(<?php echo $val['id'];?>)"><i class="fa-solid fa-cart-shopping"></i> Añadir al carrito</button>   
    
      </div>
    </div>
    </div>
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

<?php  include "../../templates/footer.php"; ?>
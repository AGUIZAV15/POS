<table class="table">
  <thead>
     <tr>
   <!-- <th>Codigo</th> -->
    <th>Nombre</th>
        <th>Existencia</th>
   <!-- <th>Precio Compra</th> -->    
    <th>Edicion</th>    
  </tr>
  </thead>
  <tbody class="bsqRapida">
 <?php 
  require_once '../model/conexion/conexion.php'; 
  $result = mysqli_query ($conn,"SELECT * FROM materia_prima WHERE active = 1 ORDER BY cantidad ASC") or die(mysqli_error($conn));
  ?>
      <?php foreach ($result as $val): 
         if($val['cantidad'] >= 5){  
        ?>
        <tr>
            <!--<td></td>-->
            <td><?php echo $val["nombre"]; ?></td>          
            <td><?php echo $val["cantidad"]; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modificarModal" onclick = "llenarCamposTexto( <?php echo $val['id']; ?> )"><i class="fa-solid fa-pen-to-square"></i></button>                 
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"  data-bs-target="#eliminarModal" onclick="idProductoEliminar( <?php echo $val['id']; ?> )"><i class="fa-solid fa-trash"></i></button>
                </div>
        </tr>
        <?php } else {?>
          <tr class="table-danger">
            <!--<td></td>-->
            <td><?php echo $val["nombre"]; ?></td>          
            <td><?php echo $val["cantidad"]; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modificarModal" onclick = "llenarCamposTexto( <?php echo $val['id']; ?> )"><i class="fa-solid fa-pen-to-square"></i></button>                 
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"  data-bs-target="#eliminarModal" onclick="idProductoEliminar( <?php echo $val['id']; ?> )"><i class="fa-solid fa-trash"></i></button>
                </div>
        </tr>
          <?php } ?>
        <?php endforeach ?>
  <?php 
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>
  </tbody>
  </table>
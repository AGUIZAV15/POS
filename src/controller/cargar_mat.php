<select class="form-select form-control" aria-label="Select material" required id="cb_materia">
    <option value="0" selected>Seleccione el material para este producto</option>
 <?php 
  require_once '../model/conexion/conexion.php'; 
  $result = mysqli_query ($conn,"SELECT * FROM materia_prima WHERE active = 1") or die(mysqli_error($conn));
  ?>
      <?php foreach ($result as $val): ?>        
            
        <option value="<?php echo $val["id"]; ?>"><?php echo $val["nombre"]; ?></option>
        <?php endforeach ?>
  <?php 
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>
 </select>
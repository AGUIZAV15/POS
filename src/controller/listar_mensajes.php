<?php 
require_once '../model/conexion/conexion.php';

$result = mysqli_query ($conn,"SELECT * FROM message ORDER BY message_id DESC") or die(mysqli_error($conn));
?>
 <?php foreach ($result as $val): ?>
 <div class="col-12 col-sm-12">
    <div class="card border-warning">
      <div class="card-body">
    <h5 class="card-title"><?php echo "Articulo u Materia Prima: ".$val['message_subject']; ?></h5>    
    <div class="container">
<div class="row">   
    <p>
    <?php echo $val['message_text']; ?>
    </p>
</div>
</div>     
      <div class="card-footer">
            <?php
            if($val['message_status'] == 1){
                ?>                
           <div class="d-flex justify-content-end">                  
                <button class="btn btn-info" onclick="leerMensaje(<?php echo $val['message_id'];?>)"><i class="fa-solid fa-envelope-open-text"></i> Leer Mensaje</button>       
            </div>
            <?php
            }
            ?>    
      </div>
    </div>
    </div>
    <?php endforeach ?>
   
     
        

        
        
  <?php 
  mysqli_free_result($result);
  mysqli_close($conn);
  ?>


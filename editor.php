<?php 
include './src/templates/header.php';
require_once './src/model/conexion/conexion.php'; 
?>
<center>
<div class="card" style="width: 90%;">
  <div class="card-header">
    PRODUCTOS
  </div>
  <ul class="list-group list-group-flush">
  <?php  

    $result = mysqli_query ($conn,"SELECT * FROM productos WHERE active = 1") or die(mysqli_error($conn));
    ?>
        <?php foreach ($result as $val):?>
      <li class="list-group-item">
      <h3 id="cod-<?php echo $val['id']; ?>"><?php echo $val["codigo"]; ?></h3>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">nombre del producto</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="nombre-<?php echo $val['id']; ?>" value="<?php echo $val['nombre']; ?>">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">precio de venta</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="precio_venta-<?php echo $val['id']; ?>" value='<?php echo floatval($val["precio_venta"]); ?>' step="any">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">precio de compra</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="precio_compra-<?php echo $val['id']; ?>" value='<?php echo floatval($val["precio_compra"]);?>' step="any">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">existencia</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="existencia-<?php echo $val['id']; ?>" value='<?php echo $val["existencia"]; ?>' step="any">
      </div>
      
      <select class="form-select form-control" aria-label="Select material" required id="cb_materia-<?php echo $val['id']; ?>">
      <option value="0">Seleccione el material para este producto</option>
  <?php 

    $res = mysqli_query ($conn,"SELECT * FROM materia_prima WHERE active = 1") or die(mysqli_error($conn));
    ?>
        <?php foreach ($res as $sval): 
          if($sval["id"] == $val["id_materia_prima"]){?> 
                 <option value="<?php echo $sval["id"]; ?>" selected><?php echo $sval["nombre"]; ?></option>
          <?php } else {?>    
          <option value="<?php echo $sval["id"]; ?>"><?php echo $sval["nombre"]; ?></option>
          <?php } ?>    
          <?php endforeach ?>
    <?php 
  mysqli_free_result($res); 
    ?>
  </select>
      

      <div class="d-flex justify-content-end">  
      <div class="btn-group" role="group" aria-label="...">
                      <button type="button" class="btn btn-warning" onclick="guardarCambios(<?php echo $val['id']; ?>)"><i class="fa-solid fa-pen-to-square"></i> Editar producto</button>                 
                        <!-- <p>&nbsp&nbsp&nbsp</p>
                      <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button> -->
                  </div>  
  </div>
      </li>
  <?php endforeach ?>
    <?php 
  mysqli_free_result($result);  
  mysqli_close($conn);
  ?>
  </ul>
</div>
</center>
<script>

function verificarValor(value){
    if (typeof value !== 'undefined' && value) {
    return true;
    }
  }

  function guardarCambios(id){
    let codigo = document.getElementById("cod-"+id);
    let nombre = document.getElementById("nombre-"+id);
    let precioVenta = document.getElementById("precio_venta-"+id);
    let precioCompra = document.getElementById("precio_compra-"+id);
    let existencia = document.getElementById("existencia-"+id);
    let mat_pr = document.getElementById('cb_materia-'+id);

  const cod = codigo.innerHTML;
  const nom = verificarValor(nombre.value) ? nombre.value.toUpperCase() : "SIN NOMBRE";
  const pv = verificarValor(precioVenta.value) ? precioVenta.value : 0;
  const pc = verificarValor(precioCompra.value) ? precioCompra.value : 0;
  const ex = verificarValor(existencia.value) ? existencia.value : 0;
    console.log("paso antes condicion con val",cod,nom,pv,pc,ex);
  if(cod && nom && pv && pc && ex)
  {
    console.log("entramos");
    $.post("/POS/src/controller/update_producto.php",
  {
    id: id,
    codigo: cod,
    nombre: nom,
    precioVenta: pv,
    precioCompra: pc,
    existencia: ex,
    materia_prima : mat_pr.value
  },
  function(data, status){
   
   if(data === 'Se han guardado los datos correctamente'){
    
    document.getElementById("nombre-"+id).value = nombre.value.toUpperCase();
    alert("se han guardado los datos correctamemte con codigo: "+ cod); 
    
   }else{
   alert(data);
   }
    
  });
  } 
}
</script>
<?php include './src/templates/footer.php'; ?>
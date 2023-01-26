
<!-- Modal -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título del modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
        <!-- FORMULARIO PARA MODIFICAR UN PRODUCTO-->
       Al eliminar este producto no podra ser recuperado. <br> Verifique la acción a efectuar
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="eliminar()">Eliminar Producto</button>
      </div>
    </div>
  </div>
</div>

<script>
  
 let idv = 0;
function idProductoEliminar(idProd){
    idv = idProd;   
}

function eliminar(){
    $.post("/POS/src/controller/delete_producto.php",
  {
    id: idv,
    active: 2
  },
  function(data, status){      
    if(data === 'Se han eliminado los datos correctamente'){
    
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,3000);  
    $('#parteRecargar').load('/POS/src/controller/cargar_productos.php');
   }else{
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,4000);  
   }
  });
}


</script>
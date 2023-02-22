
<!-- Modal -->
<div class="modal fade" id="modificarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título del modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
        <!-- FORMULARIO PARA MODIFICAR UN PRODUCTO-->
        <div class="container">
<div class="row">
<div class="col-12 col-sm-12">
	<h1>Modificar materia prima</h1>
  <!-- /POS/src/controller/nuevo_producto.php-->
	<form method="post" action="#">
	
		<label for="nombre">Nombre del material:</label>
		<textarea required id="nombre" name="nombre" cols="30" rows="2" class="form-control" placeholder="Escribe el nombre del producto"></textarea>
               
		<label for="existencia">Existencia:</label>
		<input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
		<br><br>
        
        <!-- <input class="btn btn-info" type="button" value="Guardar" id="enviar" onclick="crearNuevoProducto()"><span>&nbsp;&nbsp;</span>        
    <input class="btn btn-secondary" type="button" value="Volver" id="volver" onclick="redirigirAListarProducto()"> -->
	</form>
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="guardarCambios()">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<script>
  
 
  const nombre = document.getElementById('nombre'); 
  const existencia = document.getElementById('existencia');
 // alert en el codigo
 const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
//OBJETO DEL PRODUCTO
const producto = {
  id: 0, 
  nombre: "",  
  existencia: 0
}
function mensajeAviso(message, type) {
  var wrapper = document.createElement('div')
  wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

  alertPlaceholder.append(wrapper)
}

function verificarValor(value){
    if (typeof value !== 'undefined' && value) {
    return true;
    }
  }

  function limpiarMensajeAviso(){
  alertPlaceholder.innerHTML = '';
}

function llenarCamposTexto(idProd){
    
    $.post("/POS/src/controller/buscar_materia_id.php",
  {
    id: idProd
  },
  function(data, status){      
    const datos = data.split(",");
   producto.id = datos[0];   
   producto.nombre = datos[1];   
   producto.existencia = datos[2];

  
  nombre.value = datos[1];  
  existencia.value = datos[2];
  });
 
}

function guardarCambios(){
 
const nom = verificarValor(nombre.value) ? nombre.value : producto.nombre;
const ex = verificarValor(existencia.value) ? existencia.value : producto.existencia;

  if( nom && ex)
  {
    $.post("/POS/src/controller/update_materia.php",
  {
    id: producto.id,    
    nombre: nom,    
    existencia: ex
  },
  function(data, status){
   
   if(data === 'Se han guardado los datos correctamente'){
    
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,3000);  
    $('#parteRecargar').load('/POS/src/controller/cargar_materia.php');
   }else{
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,4000);  
   }
    
  });
  } 
}

</script>
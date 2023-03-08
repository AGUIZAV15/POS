
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
	<h1>Nuevo producto</h1>
  <!-- /POS/src/controller/nuevo_producto.php-->
	<form method="post" action="#">
		<label for="codigo">Código de barras:</label>
		<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

		<label for="nombre">Nombre del producto:</label>
		<textarea required id="nombre" name="nombre" cols="30" rows="2" class="form-control" placeholder="Escribe el nombre del producto"></textarea>
        
        <label for="precioVenta">Precio de venta:</label>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

		<label for="precioCompra">Precio de compra:</label>
		<input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

		<label for="existencia">Existencia:</label>
		<input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
		<br>
    <div id="listarMat"></div>  
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
  
 const codigo = document.getElementById('codigo');
  const nombre = document.getElementById('nombre');
  const precioVenta = document.getElementById('precioVenta');
  const precioCompra = document.getElementById('precioCompra');
  const existencia = document.getElementById('existencia');
 // alert en el codigo
 const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

 $(document).ready(function(){
    $('#listarMat').load('/POS/src/controller/cargar_mat.php');
  });
  

//OBJETO DEL PRODUCTO
const producto = {
  id: 0,
  codigo: "",
  nombre: "",
  precioVenta: 0,
  precioCompra: 0,
  existencia: 0,
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
    
    $.post("/POS/src/controller/buscar_producto_id.php",
  {
    id: idProd
  },
  function(data, status){      
    const datos = data.split(",");
   producto.id = datos[0];
   producto.codigo = datos[1];
   producto.nombre = datos[2];
   producto.precioVenta = datos[3];
   producto.precioCompra = datos[4];
   producto.existencia = datos[5];

  codigo.value = datos[1];
  nombre.value = datos[2];
  precioVenta.value = datos[3] ;
  precioCompra.value = datos[4];
  existencia.value = datos[5];
  document.getElementById('cb_materia').value = datos[6];
  });
 
}

function guardarCambios(){
  const cod = verificarValor(codigo.value) ? codigo.value : producto.codigo;
const nom = verificarValor(nombre.value) ? nombre.value : producto.nombre;
const pv = verificarValor(precioVenta.value) ? precioVenta.value : producto.precioVenta;
const pc = verificarValor(precioCompra.value) ? precioCompra.value : producto.precioCompra;
const ex = verificarValor(existencia.value) ? existencia.value : producto.existencia;

  if(cod && nom && pv && pc && ex)
  {
    $.post("/POS/src/controller/update_producto.php",
  {
    id: producto.id,
    codigo: cod,
    nombre: nom,
    precioVenta: pv,
    precioCompra: pc,
    existencia: ex,
    materia_prima : document.getElementById('cb_materia').value
  },
  function(data, status){
   
   if(data === 'Se han guardado los datos correctamente'){
    
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,3000);  
    $('#parteRecargar').load('/POS/src/controller/cargar_productos.php');
   }else{
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,4000);  
   }
    
  });
  } 
}

</script>
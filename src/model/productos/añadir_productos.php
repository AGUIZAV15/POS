<?php 
require_once '../conexion/conexion.php';
include "../../templates/header.php";
?>
<!-- MENU PRINCIPAL DE LA PAGINA-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/POS/index.php">DICAC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="/POS/src/model/ventas/vender_productos.php">VENTAS</a>
        <a class="nav-link active" href="/POS/src/model/productos/listar_productos.php">PRODUCTOS</a>  
        <a class="nav-link" href="/POS/src/model/materiaPrima/listar_materia.php">MATERIA PRIMA</a>
        <a class="nav-link" href="/POS/src/model/historialVentas/historialVentas.php">HISTORIAL</a>   

        <a style="position:absolute;right:15px" class="nav-link btn btn-secondary" href="/POS/src/model/mensajes/historial_mensajes.php" role="button"> 
        <i class="fa-solid fa-bell fa-lg" style="color: #ffffff;"></i>
        <div id="efecto-solicitud">         
  </div>
            </a>
      </div>
    </div>
  </div>
</nav>
 <!-- FORMULARIO PARA AÑADIR PRODUCTOS -->
 <div id="liveAlertPlaceholder">
  
</div>

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
    

    <br><br>
        
        <input class="btn btn-info" type="button" value="Guardar" id="enviar" onclick="crearNuevoProducto()"><span>&nbsp;&nbsp;</span>        
    <input class="btn btn-secondary" type="button" value="Volver" id="volver" onclick="redirigirAListarProducto()">
	</form>
</div>
</div>
</div>

<script>
  // variables usadas en el formulario almacenadas
  const codigo = document.getElementById('codigo');
  const nombre = document.getElementById('nombre');
  const precioVenta = document.getElementById('precioVenta');
  const precioCompra = document.getElementById('precioCompra');
  const existencia = document.getElementById('existencia');  
  

  // alert en el codigo
  const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
  
  function verificarValor(value){
    if (typeof value !== 'undefined' && value) {
    return true;
    }
  }
 
function redirigirAListarProducto(){
    location.href = '/POS/src/model/productos/listar_productos.php';
}

function mensajeAviso(message, type) {
  var wrapper = document.createElement('div')
  wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

  alertPlaceholder.append(wrapper)
}

function limpiarMensajeAviso(){
  alertPlaceholder.innerHTML = '';
}
function limpiarCampos(){
  codigo.value = "";
  nombre.value = "";
  precioVenta.value = "" ;
  precioCompra.value = "";
  existencia.value = "";  
  document.getElementById('cb_materia').value = '0';
}

$(document).ready(function(){
    $('#listarMat').load('/POS/src/controller/cargar_mat.php');
    $('#efecto-solicitud').load('/POS/src/model/mensajes/cantidad_mensajes.php');
  });
  

function crearNuevoProducto(){
const cod = verificarValor(codigo.value) ? codigo.value : null;
const nom = verificarValor(nombre.value) ? nombre.value : null;
const pv = verificarValor(precioVenta.value) ? precioVenta.value : null;
const pc = verificarValor(precioCompra.value) ? precioCompra.value : null;
const ex = verificarValor(existencia.value) ? existencia.value : null;


  if(cod && nom && pv && pc && ex)
  {
    $.post("/POS/src/controller/nuevo_producto.php",
  {
    codigo: cod,
    nombre: nom,
    precioVenta: pv,
    precioCompra: pc,
    existencia: ex,
    materia_prima : document.getElementById('cb_materia').value
  },
  function(data, status){
   
   if(data === 'Se han añadido los datos correctamente'){
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,4000);  
    limpiarCampos();
   }else{
    mensajeAviso(data, 'secondary');
    setTimeout(limpiarMensajeAviso,4000);  
   }
    
  });
  }
  else
  {
    mensajeAviso('Añada los valores dentro de los campos de texto','secondary');
    setTimeout(limpiarMensajeAviso,4000);
  }

  }




</script>

<?php include "../../templates/footer.php"; ?>
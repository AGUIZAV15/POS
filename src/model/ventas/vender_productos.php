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
        <a class="nav-link active" aria-current="page" href="/POS/src/model/ventas/vender_productos.php">VENTAS</a>
        <a class="nav-link" href="/POS/src/model/productos/listar_productos.php">PRODUCTOS</a>
        <a class="nav-link" href="/POS/src/model/materiaPrima/listar_materia.php">MATERIA PRIMA</a>
        <a class="nav-link" href="/POS/src/model/historialVentas/historialVentas.php">HISTORIAL</a>
        <!-- <a class="nav-link" href="#">Precios</a>
        <a class="nav-link disabled">Deshabilitado</a> -->
      </div>
    </div>
  </div>
</nav>
<!-- ALERT PARA MOSTRAR AVISOS DE ACCIONES EFECTUADAS-->
<div id="liveAlertPlaceholder">
  
  </div>
<div class="card border-dark">
  <div class="card-body border-dark">
<!-- CREAR TABLA PARA CARGAR PRODUCTOS EN CARRITO PARA VENDER -->
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading fs-1">
        VENDER
        <div class="btn-group" role="group" aria-label="...">
         <button type="button" class="btn btn-success" id="añadir_producto" onclick="dirigirMenuPrincipal()"><i class="fa-solid fa-plus"></i></button>
        </div>
    </div>

  <!-- Table -->
  <div class="table-responsive">
  
 <div id="parteRecargar">
        
</div>
  
  </div>
</div>
<!-- </div c= panel panle-default>"-->
<div class="input-group mb-3">
  <span class="input-group-text">Descuento (%): </span>
  <input type="number" class="form-control" min="0" max="100" value ="0" id="area_descuento" aria-label="Cantidad (al dólar más cercano)">  
  <span class="input-group-text">Se recibe : $</span>
  <input type="number" class="form-control" value ="0" id="area_pago" aria-label="Cantidad (al dólar más cercano)">  
</div>
</div>
<!-- card body-->
<div class="card-footer">
<div class="d-flex justify-content-end">  
        <div class="btn-group" role="group" aria-label="...">
         <button type="button" class="btn btn-success" id="efectuar_venta" onclick="efectuarVenta()" ><i class="fa-solid fa-cart-shopping"></i> Vender Mercancia</button>
         <span>&nbsp;&nbsp;</span>
         <button type="button" class="btn btn-danger" id="cancelar_venta" onclick="cancelarVenta()"><i class="fa-solid fa-trash"></i> Cancelar Venta</button>
        </div>
</div>
</div>
</div>
<!-- card -->
<script>
   // alert en el codigo
   const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

   function mensajeAviso(message, type) {
  var wrapper = document.createElement('div')
  wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

  alertPlaceholder.append(wrapper)
}

function limpiarMensajeAviso(){
  alertPlaceholder.innerHTML = '';
}

$(document).ready(function() {
    $('#parteRecargar').load('/POS/src/controller/cargar_tabla_venta.php');
});
function dirigirMenuPrincipal(){
  location.href = '/POS/index.php';
}

function efectuarVenta(){
  descuento = document.getElementById('area_descuento').value;
  pago = document.getElementById('area_pago').value;
  total = document.getElementById('cTotal').innerText;
if(total !== "$0.00" && pago !== undefined && pago > 0){ // <------- validar campos para venta
 // console.log(pago);
$.post("/POS/src/controller/efectuar_venta_productos.php",
  {    
    descuento,
    total,
    pago
  },
  function(data, status){  
//    console.log(data);
    if(data !== 'error'){           
    $('#parteRecargar').load('/POS/src/controller/cargar_tabla_venta.php');
    document.getElementById('area_descuento').value = 0;
    document.getElementById('area_pago').value = 0;
     mensajeAviso("El cambio del cliente es: $" + data, "success");
     setTimeout(limpiarMensajeAviso,10000);  
   }else{
    mensajeAviso("No se pudo efectuar la venta", "danger");
 setTimeout(limpiarMensajeAviso,4000);  
   }
  });
}else{
 mensajeAviso("Verifique productos a vender", "danger");
 setTimeout(limpiarMensajeAviso,4000);  
}
  
}

function cancelarVenta(){
  
  total = document.getElementById('cTotal').innerText;
if(total !== "$0.00"){
  $.get("/POS/src/controller/cancelar_venta_prod.php",
  function(data, status){      
    
    if(data === 'd-ok'){           
    $('#parteRecargar').load('/POS/src/controller/cargar_tabla_venta.php');
    document.getElementById('area_descuento').value = 0
   }else{
    console.log("error");
   }
  });
  }else{
    mensajeAviso("No hay venta por cancelar", "danger");
 setTimeout(limpiarMensajeAviso,4000);  
  }
  
}

function eliminarProductoVenta(idProducto,cantidad){
  
$.post("/POS/src/controller/quitar_prod_carrito.php",
  {
    id: idProducto,
    qty: cantidad
  },
  function(data, status){      
    if(data === 'u-ok' || data === 'd-ok'){           
    $('#parteRecargar').load('/POS/src/controller/cargar_tabla_venta.php');
   }else{
    console.log("error");
   }
  });

}
</script>

<?php  include "../../templates/footer.php"; ?>
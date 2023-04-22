<?php 
include "../../templates/header.php";
?>

<!-- MENU PRINCIPAL DE LA PAGINA-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/POS/index.php">DICAC</a>    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-controls="collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> 
    <div class="collapse navbar-collapse" id="collapse">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="/POS/src/model/ventas/vender_productos.php">VENTAS</a>
        <a class="nav-link" href="/POS/src/model/productos/listar_productos.php">PRODUCTOS</a>
        <a class="nav-link" href="/POS/src/model/materiaPrima/listar_materia.php">MATERIA PRIMA</a>
        <a class="nav-link active" href="/POS/src/model/historialVentas/historialVentas.php">HISTORIAL</a>

        <a style="position:absolute;right:15px" class="nav-link btn btn-secondary" href="/POS/src/model/mensajes/historial_mensajes.php" role="button"> 
        <i class="fa-solid fa-bell fa-lg" style="color: #ffffff;"></i>
        <div id="efecto-solicitud">         
  </div>
            </a>
        <!-- <a class="nav-link" href="#">Precios</a>
        <a class="nav-link disabled">Deshabilitado</a> -->
      </div>
    </div>     
  </div>
</nav>

<div class="container">
  <div class="row"> 
  <div class="col-12 col-sm-12">  
  <div class="card">    
  <div class="card-body">
    <p class="fs-1">Bienvenido de vuelta <?php echo $_SESSION['usuario'];?><br>
    Listado de Ventas
    </p>   

    <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="switchBusquedaHoy">
  <label class="form-check-label" for="flexSwitchCheckDefault">Total vendido el dia de hoy</label>
</div>

    <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="switchBusquedaDia">
  <label class="form-check-label" for="flexSwitchCheckDefault">Resumén de venta por día</label>
</div>

    <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="switchBusquedaMes">
  <label class="form-check-label" for="flexSwitchCheckDefault">Resumén de venta por més</label>
</div>    
    
  </div>
  </div>
</div>
  </div>
</div>


<div class="container">
  <div class="row">   
   <div id="rellenarVentas">


   </div>
  </div>
</div>



<script>  
  $('document').ready(function(){
    $('#rellenarVentas').load('/POS/src/controller/listar_ventas_efectuadas.php');
    $('#efecto-solicitud').load('/POS/src/model/mensajes/cantidad_mensajes.php');
  });
  $("#switchBusquedaHoy").on( 'change', function() {
    if( $(this).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
        // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
        document.getElementById("switchBusquedaMes").checked = false;
        document.getElementById("switchBusquedaDia").checked = false;
        $('#rellenarVentas').load('/POS/src/controller/listar_ventas_hoy.php');
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
        $('#rellenarVentas').load('/POS/src/controller/listar_ventas_efectuadas.php');
    }
});
  $("#switchBusquedaDia").on( 'change', function() {
    if( $(this).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
        // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
        document.getElementById("switchBusquedaMes").checked = false;
        document.getElementById("switchBusquedaHoy").checked = false;
        $('#rellenarVentas').load('/POS/src/controller/listar_ventas_por_dia.php');
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
        $('#rellenarVentas').load('/POS/src/controller/listar_ventas_efectuadas.php');
    }
});
$("#switchBusquedaMes").on( 'change', function() {
    if( $(this).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
        // alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
        document.getElementById("switchBusquedaDia").checked = false;
        document.getElementById("switchBusquedaHoy").checked = false;
        $('#rellenarVentas').load('/POS/src/controller/listar_ventas_por_mes.php');
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        // alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
        $('#rellenarVentas').load('/POS/src/controller/listar_ventas_efectuadas.php');
    }
});

  function cancelarVenta(id){
    $.post("/POS/src/controller/eliminar_venta.php",
  {
    id
  },
  function(data, status){   
    if(data === 'ok'){      
      $('#rellenarVentas').load('/POS/src/controller/listar_ventas_efectuadas.php');
    }else{
      console.log("error");
    }
    
  });
  }
</script>

<?php include '../../templates/footer.php'; ?>
<?php 
require_once '../conexion/conexion.php';

include "../../templates/header.php";
?>
<!-- MENU PRINCIPAL DE LA PAGINA-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/PointSale/index.php">DICAC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="/PointSale/src/model/ventas/vender_productos.php">VENTAS</a>
        <a class="nav-link active" href="/PointSale/src/model/productos/listar_productos.php">PRODUCTOS</a>
        <a class="nav-link" href="/PointSale/src/model/historialVentas/historialVentas.php">HISTORIAL</a>
        <!-- <a class="nav-link" href="#">Precios</a>
        <a class="nav-link disabled">Deshabilitado</a> -->
      </div>
    </div>
  </div>
</nav>
<!-- ALERT PARA MOSTRAR AVISOS DE ACCIONES EFECTUADAS-->
<div id="liveAlertPlaceholder">
  
  </div>


<!-- SE MUESTRA UNA TABLA CON TODOS LOS PRODUCTOS EN LA BASE DE DATOS -->

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading fs-1">
        Productos
        <div class="btn-group" role="group" aria-label="...">
         <button type="button" class="btn btn-success" id="añadir_producto" onclick="añadirProducto()"><i class="fa-solid fa-plus"></i></button>
        </div>
    </div>
    
  <!-- Table -->
  <div class="table-responsive">
  
 <div id="parteRecargar">
        
</div>
  
  </div>
</div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Lanzar demo de modal
</button> -->

<?php include "./modificar_productos.php"; ?>
<?php include "./eliminar_productos.php"; ?>
<script>
  $(document).ready(function(){
    $('#parteRecargar').load('/PointSale/src/controller/cargar_productos.php');
  });
  
  function añadirProducto(){
    location.href = '/PointSale/src/model/productos/añadir_productos.php';
  }
  function cargarProductos(){

   
  }

</script>

<?php  include "../../templates/footer.php"; ?>
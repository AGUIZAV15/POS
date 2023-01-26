<?php 
include './src/templates/header.php';
?>

<!-- MENU PRINCIPAL DE LA PAGINA-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">DICAC</a>    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-controls="collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> 
    <div class="collapse navbar-collapse" id="collapse">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="/PointSale/src/model/ventas/vender_productos.php">VENTAS</a>
        <a class="nav-link" href="/PointSale/src/model/productos/listar_productos.php">PRODUCTOS</a>
        <a class="nav-link" href="/PointSale/src/model/historialVentas/historialVentas.php">HISTORIAL</a>
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
    <p class="fs-1">Bienvenido de vuelta <?php echo $_SESSION['usuario'];?> </p>
    <p class="fs-4 fw-bold"><i class="fa-solid fa-cart-shopping"></i>  Carrito: (<span id="qty">0</span>) </p>
    
  </div>
  </div>
</div>
  </div>
</div>


<div class="container">
  <div class="row">   
   <div id="rellenarProductosVender">


   </div>
  </div>
</div>



<script>
  $('document').ready(function(){
    $('#rellenarProductosVender').load('/PointSale/src/model/ventas/listar_productos_vender.php');
  });
  $('document').ready(function(){
    $('#qty').load('/PointSale/src/controller/cargar_carrito.php');
  });
 
  function añadirAlCarrito(codigo){
    $.post("/PointSale/src/controller/añadir_prod_carrito.php",
  {
    id: codigo,
    qty: 1
  },
  function(data, status){   
    if(data === 'ok'){
      $('#qty').load('/PointSale/src/controller/cargar_carrito.php');
     
    }else{
      console.log("error");
    }
    
  });
  }

</script>

<?php include './src/templates/footer.php'; ?>
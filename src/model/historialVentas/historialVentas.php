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
        <a class="nav-link active" href="/POS/src/model/historialVentas/historialVentas.php">HISTORIAL</a>
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
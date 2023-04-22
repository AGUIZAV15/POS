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
        <a class="nav-link" href="/POS/src/model/historialVentas/historialVentas.php">HISTORIAL</a>

        <a style="position:absolute;right:15px" class="nav-link btn btn-secondary" href="/POS/src/model/mensajes/historial_mensajes.php" role="button"> 
        <i class="fa-solid fa-bell fa-lg" style="color: #ffffff;"></i>
        <div id="efecto-solicitud">         
  </div>
            </a>
        <!-- 
        AGUIZAV te recomiendo en el futuro mejorar el funcionamiento de las notificaciones, de momento sirve para lo que fue creado        
        -->
      </div>
    </div>     
  </div>
</nav>

<div class="container">
  <div class="row"> 
  <div class="col-12 col-sm-12">  
  <div class="card">    
  <div class="card-body">
    <p class="fs-1">
        Bienvenido de vuelta <?php echo $_SESSION['usuario'];?><br>
        Listado de Notificaciones   
    </p>         
  </div>
  </div>
</div>
  </div>
</div>


<div class="container">
  <div class="row">   
   <div id="rellenarMensajes">


   </div>
  </div>
</div>



<script>  
  $('document').ready(function(){
    $('#rellenarMensajes').load('/POS/src/controller/listar_mensajes.php');
    $('#efecto-solicitud').load('/POS/src/model/mensajes/cantidad_mensajes.php');
  });
  
  function leerMensaje(id){
    $.post("/POS/src/controller/leer_mensaje.php",
  {
    id
  },
  function(data, status){   
    if(data === 'ok'){      
      $('#rellenarMensajes').load('/POS/src/controller/listar_mensajes.php');
      $('#efecto-solicitud').load('/POS/src/model/mensajes/cantidad_mensajes.php');
    }else{
      console.log("error");
    }
    
  });
  }
</script>

<?php include '../../templates/footer.php'; ?>
<?php 
include './src/templates/header.php';
?>

<!-- MENU PRINCIPAL DE LA PAGINA-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./loggin.php">DICAC</a>    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-controls="collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> 
    
  </div>
</nav>

<div class="card border-dark mb-3"  style="width: 18rem;  margin: auto; width: 50%;">
  <div class="card-body">
  <form>
  <div class="mb-3">
    <label for="usr" class="form-label">Nombre de usuario</label>
    <input type="text" class="form-control" id="usr" aria-describedby="emailHelp">    
  </div>
  <div class="mb-3">
    <label for="pss" class="form-label">Contraseña</label>
    <input type="password" class="form-control" id="pss">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="button" class="btn btn-primary" id="my_form">Submit</button>
</form>
  </div>
</div>


<script>
$('#my_form').click(function () {
    const usr = document.getElementById("usr").value;
    const pss = document.getElementById("pss").value;
    $.post("/POS/src/controller/log.php",
  {
    user: usr,
    password: pss
  },
  function(data, status){ 
    
    if(data === 'ok'){
        location.href = '/POS/index.php';        
    }else{
      console.log("error");
    }
    
  });
});



 
 
  

</script>

<?php include './src/templates/footer.php'; ?>
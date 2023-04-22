
  <?php 
require_once '../conexion/conexion.php';  

$result = mysqli_query ($conn,"SELECT count(*) as cantidad FROM message WHERE message_status = 1") or die(mysqli_error($conn));
$data = mysqli_fetch_object($result);
$cantidad = $data->cantidad;

if ($cantidad > 0) {
    ?>
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <span id="cant">
    <?php echo $cantidad; ?>
    </span>
<span class="visually-hidden">unread messages</span>
</span>
<?php
}
mysqli_free_result($result);
mysqli_close($conn);
?>
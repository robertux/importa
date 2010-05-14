<?php
session_start();
//Eliminar variables de session
session_destroy();

echo "<script>document.location='index.php';</script>";

?>

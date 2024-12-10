<?php
// Cierre de la sesión.
session_start();
session_destroy(); 
header("Location: index.php");
exit();
?>
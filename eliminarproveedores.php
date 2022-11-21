<?php

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$id = $_GET["id"];

$query = "DELETE FROM Proveedor WHERE idProveedor='$id'";

mysqli_query($conn,$query);

header("Location: ./proveedores.php");

?>
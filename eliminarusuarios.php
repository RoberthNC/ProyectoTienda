<?php

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$id = $_GET["id"];
$cargo = $_GET["cargo"];
if($cargo==="admin"){
    $query = "DELETE FROM administrador WHERE idUsuario='$id'";
}else{
    $query = "DELETE FROM empleado WHERE idUsuario='$id'";
}
mysqli_query($conn,$query);

$query2 = "DELETE FROM usuario WHERE idUsuario='$id'";


mysqli_query($conn,$query2);

header("Location: /usuarios.php")


?>
<?php

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$buscador = $_POST["buscador"];
$filtro_producto = $_POST["filtro_producto"];
$orden = $_POST["orden"];
$vacio = [];

if($buscador===""){
    $query = "SELECT producto.idProducto AS idProducto, producto.nombre AS nombre, producto.precio AS precio, producto.cantidad AS cantidad, categoria.nombre AS categoria FROM producto INNER JOIN categoria ON producto.idCategoria=categoria.idCategoria ORDER BY ${filtro_producto} ${orden}";
}
else{
    $query = "SELECT producto.idProducto AS idProducto, producto.nombre AS nombre, producto.precio AS precio, producto.cantidad AS cantidad, categoria.nombre AS categoria FROM producto INNER JOIN categoria ON producto.idCategoria=categoria.idCategoria WHERE producto.${filtro_producto} LIKE '%${buscador}%'";
}

$resultados = mysqli_query($conn,$query);

if($resultados->num_rows!==0){
    while($row=mysqli_fetch_assoc($resultados)){
        $vacio[]=$row;
    }
}

echo json_encode($vacio);

?>
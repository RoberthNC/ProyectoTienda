<?php

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$buscador = $_POST["buscador"];
$filtro_categoria = $_POST["filtro_categoria"];
$orden = $_POST["orden"];
$vacio = [];

if($buscador===""){
    $query = "SELECT * FROM Categoria ORDER BY ${filtro_categoria} ${orden}";
}
else{
    $query = "SELECT * FROM Categoria WHERE ${filtro_categoria} LIKE '%${buscador}%'";
}

$resultados = mysqli_query($conn,$query);

if($resultados->num_rows!==0){
    while($row=mysqli_fetch_assoc($resultados)){
        $vacio[]=$row;
    }
}

echo json_encode($vacio);



?>
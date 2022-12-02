<?php
    require "./includes/funciones/conexion.php";
    require "./includes/funciones/funciones.php";

    $conn = ConexionBD();

    $buscador = $_POST["buscar"];
    $filtro = $_POST["filtro"];
    $vacio = [];
    
    $query = "SELECT * FROM Producto WHERE $filtro LIKE '$buscador'";

    $resultados = mysqli_query($conn,$query);

    while($row=mysqli_fetch_assoc($resultados)){
        $vacio[]=$row;
    }

    echo json_encode($vacio);
?>
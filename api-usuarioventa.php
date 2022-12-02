<?php

    require "./includes/funciones/conexion.php";
    require "./includes/funciones/funciones.php";

    session_start();

    $conn = ConexionBD();

    $id = (int)$_SESSION["id_usuario"];

    //Obteniendo los valores enviados desde el javascript
    $buscador = $_POST["buscador"];
    $filtro_venta = $_POST["filtro_venta"];
    $ordenar = $_POST["ordenar"];

    //Caso 01: Buscador vacío
    if($buscador===""){
        $query = "SELECT * FROM Venta WHERE idUsuario=$id ORDER BY $filtro_venta $ordenar";
    }
    else{
        $query = "SELECT * FROM Venta WHERE idUsuario=$id AND $filtro_venta='$buscador' ORDER BY $filtro_venta $ordenar";
    }

    $resultados = mysqli_query($conn,$query);
    $vacio = [];

    if($resultados->num_rows>0){
        while($row = mysqli_fetch_assoc($resultados)){
            $vacio[] = $row;
        }

        echo json_encode($vacio);
    }

?>
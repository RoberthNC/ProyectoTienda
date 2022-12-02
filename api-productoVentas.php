<?php

    session_start();

    require "./includes/funciones/conexion.php";
    require "./includes/funciones/funciones.php";

    $conn = ConexionBD();

    //Tabla de venta
    $arregloVenta = json_decode($_POST["arregloVenta"]);
    $montoTotal = 0;
    $idUser = $_SESSION['id_usuario'];

    foreach ($arregloVenta as $venta) {
        $montoTotal += $venta->cantidad * $venta->precio;
    }

    $fecha = date('Y-m-d');

    $queryVenta = "INSERT INTO Venta(idUsuario,montototal,fecha) VALUES($idUser,'$montoTotal','$fecha')";
    $resultadosVenta = mysqli_query($conn,$queryVenta);
    
    //Tabla Producto_Compra
    $obtenerVenta = mysqli_query($conn,"SELECT idVenta FROM Venta ORDER BY idVenta DESC LIMIT 1");
    
    $venta = mysqli_fetch_assoc($obtenerVenta);
    $idVenta = $venta["idVenta"];
    foreach($arregloVenta as $pventa){
        $query = "INSERT INTO Producto_Venta(idVenta,idProducto,precioventa,cantidad,fecha) VALUES($idVenta,$pventa->id,$pventa->precio,$pventa->cantidad,'$fecha')";
        $compras = mysqli_query($conn,$query);
    }
?>
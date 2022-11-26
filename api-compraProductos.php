<?php

    session_start();

    require "./includes/funciones/conexion.php";
    require "./includes/funciones/funciones.php";

    $conn = ConexionBD();

    //Tabla de compra
    $arregloCompra = json_decode($_POST["arregloCompra"]);
    $montoTotal = 0;
    $idUser = $_SESSION['id_usuario'];
    $idProvider = $_POST['idProveedor'];

    foreach ($arregloCompra as $compra) {
        $montoTotal += $compra->cantidad * $compra->precio;
    }

    $fecha = date('Y-m-d');

    $queryCompra = "INSERT INTO Compra(idUsuario,idProveedor,montototal,fecha) VALUES($idUser,$idProvider,'$montoTotal','$fecha')";
    $resultadosCompra = mysqli_query($conn,$queryCompra);
    
    //Tabla Producto_Compra
    $obtenerCompra = mysqli_query($conn,"SELECT idCompra FROM Compra ORDER BY idCompra DESC LIMIT 1");
    
    $compra = mysqli_fetch_assoc($obtenerCompra);
    $idcompra = $compra["idCompra"];
    foreach($arregloCompra as $pcompra){
        $query = "INSERT INTO Producto_Compra(idCompra,idProducto,preciocompra,cantidad,fecha) VALUES($idcompra,$pcompra->id,$pcompra->precio,$pcompra->cantidad,'$fecha')";
        $compras = mysqli_query($conn,$query);
    }
?>
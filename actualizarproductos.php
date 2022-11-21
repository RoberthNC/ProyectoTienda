<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$idActualizar = (int)$_GET["id"];

$query = "SELECT * FROM Producto WHERE idProducto=$idActualizar";
$resultadosQuery = mysqli_query($conn,$query);

$query2 = "SELECT * FROM Categoria";
$resultadosCategorias = mysqli_query($conn,$query2);

$idCategoria = 0;
$nombre = "";
$cantidad = 0;
$precio = 0;
$preciodeventa = 0;

if($resultadosQuery->num_rows){

    while($row=mysqli_fetch_assoc($resultadosQuery)){
        $idCategoria = $row["idCategoria"];
        $nombre = $row["nombre"];
        $cantidad = $row["cantidad"];
        $precio = $row["precio"];
        $preciodeventa = $row["preciodeventa"];
    }
    
}

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $categoriaActualizar = $_POST["categoria"];
    $nombreActualizar = $_POST["nombre"];
    $cantidadActualizar = $_POST["cantidad"];
    $precioActualizar = $_POST["precio"];
    $precioVentaActualizar = $_POST["precioventa"];

    $queryActualizar = "UPDATE Producto SET idCategoria='$categoriaActualizar', nombre='$nombreActualizar', cantidad='$cantidadActualizar', precio='$precioActualizar', preciodeventa='$precioVentaActualizar' WHERE idCategoria=${idCategoria}";

    $resultadosActualizar = mysqli_query($conn,$queryActualizar);

    if($resultadosActualizar){

        header("Location: ./productos.php");

    }

}

?>

<div class="contenedor-regresar">
    <a href="./productos.php">Regresar</a>
</div>

<div class="contenedor-formulario-producto">
    <form method="POST" class="formulario">
        <div class="contenedor-campos-producto">
            <label>Categoría:</label>
            <select name="categoria">
                <?php
                if($resultadosCategorias->num_rows>0){
                    while($row2=mysqli_fetch_assoc($resultadosCategorias)){
                ?>
                <option value="<?php echo $row2['idCategoria']?>" <?php echo $row2["idCategoria"]===$idCategoria?"selected":"";?>><?php echo $row2["nombre"];?></option>
                <?php
                    }    
                }
                ?>
            </select>
        </div>
        <div class="contenedor-campos-producto">
            <label>Nombre:</label>
            <input type="text" placeholder="Ingrese nombre" name="nombre" value="<?php echo $nombre?>">
        </div>
        <div class="contenedor-campos-producto">
            <label>Cantidad:</label>
            <input type="number" placeholder="Ingrese cantidad" name="cantidad" value="<?php echo $cantidad?>">
        </div>
        <div class="contenedor-campos-producto">
            <label>Precio:</label>
            <input type="number" placeholder="Ingrese precio" name="precio" value="<?php echo $precio?>">
        </div>
        <div class="contenedor-campos-producto">
            <label>Precio de venta:</label>
            <input type="number" placeholder="Ingrese precio venta" name="precioventa" value="<?php echo $preciodeventa?>">
        </div>
        <div class="contenedor-boton-producto">
            <input type="submit" value="Actualizar">
        </div>
    </form>
</div>

<?php
$contenido = ob_get_clean();
require "./includes/layout/menulayout.php";
?>
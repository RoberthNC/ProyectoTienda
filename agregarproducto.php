<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$queryCategorias = "SELECT * FROM Categoria";
$resultadosCategorias = mysqli_query($conn,$queryCategorias);

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $idCategoria = $_POST["categoria"];
    $nombre = $_POST["nombre"];
    $cantidad =  $_POST["cantidad"];
    $precio = $_POST["precio"];
    $precioventa = $_POST["precioventa"];

    $query = "INSERT INTO Producto(idCategoria,nombre,cantidad,precio,preciodeventa) VALUES('$idCategoria','$nombre','$cantidad','$precio','$precioventa')";
    $resultadosInsercion = mysqli_query($conn,$query);

    if($resultadosInsercion){
        header("Location: ./agregarproducto.php");
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
                    while($row=mysqli_fetch_assoc($resultadosCategorias)){
                ?>
                <option value="<?php echo $row['idCategoria']?>"><?php echo $row["nombre"]?></option>
                <?php
                    }    
                }
                ?>
            </select>
        </div>
        <div class="contenedor-campos-producto">
            <label>Nombre:</label>
            <input type="text" placeholder="Ingrese nombre" name="nombre">
        </div>
        <div class="contenedor-campos-producto">
            <label>Cantidad:</label>
            <input type="number" placeholder="Ingrese cantidad" name="cantidad">
        </div>
        <div class="contenedor-campos-producto">
            <label>Precio:</label>
            <input type="number" placeholder="Ingrese precio" name="precio">
        </div>
        <div class="contenedor-campos-producto">
            <label>Precio de venta:</label>
            <input type="number" placeholder="Ingrese precio venta" name="precioventa">
        </div>
        <div class="contenedor-boton-producto">
            <input type="submit" value="Guardar">
        </div>
    </form>
</div>

<?php
$contenido = ob_get_clean();
require "./includes/layout/menulayout.php";
?>
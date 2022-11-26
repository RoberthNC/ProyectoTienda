<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();
$query = "SELECT * FROM Proveedor";
$resultados = mysqli_query($conn,$query);

?>
<form method="POST">
<div class="contenedor-filtrar-producto">
    <div class="contenedor-buscar-producto">
        <input type="text" placeholder="Buscar" id="buscador">
        <select id="filtro" name="filtro">
            <option value="idProducto">Id</option>
            <option value="nombre">Nombre</option>
        </select>

        <input type="submit" value="Buscar" id="submit">
    </div>
</div>

<div class="contenedor-tabla">
    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tbody">
            
        </tbody>
    </table>
</div>

<div class="contenedor-proveedor">
    <label for="proveedor">Seleccione el proveedor:</label>
    <select name="proveedor" id="proveedor">
        <?php
            if($resultados->num_rows>0){
                while($row = mysqli_fetch_assoc($resultados)){
        ?>
        <option value="<?php echo $row["idProveedor"]?>"><?php echo $row["ruc"]?></option>
        <?php
                }
            }
        ?>
    </select>
</div>

<div class="contenedor-carrito">
    <table class="tabla-secundaria">
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>CANTIDAD</th>
            </tr>
            <tbody id="tbody-secundario">
            
            </tbody>
        </thead>
    </table>
</div>

<div class="contenedor-confirmar-compra">
    <input type="submit" value="Confirmar Compra" id="confirmarcompra">
</div>

</form>
<?php
$contenido = ob_get_clean();
require "./includes/layout/menulayout.php";
?>

<script src="./indexCompra.js"></script>
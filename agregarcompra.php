<?php
ob_start();
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
    <input type="submit" value="Confirmar Compra">
</div>

</form>
<?php
$contenido = ob_get_clean();
require "./includes/layout/menulayout.php";
?>

<script src="./indexCompra.js"></script>
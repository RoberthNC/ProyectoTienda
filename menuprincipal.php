<?php
ob_start();
?>

<div class="contenedor-secciones">
    <section class="seccion">
        <h2>Cantidad de ventas del día:</h2>
        <p>Lorem, ipsum dolor</p>
    </section>
    <section class="seccion">
        <h2>Cantidad de productos vendidos:</h2>
        <p>Lorem, ipsum dolor</p>
    </section>
    <section class="seccion">
        <h2>Dinero de ventas del día:</h2>
        <p>Lorem, ipsum dolor</p>
    </section>
</div>

<div class="contenedor-ordenar-ventas">
    <div class="contenedor-ordenar">
        <label>Ordenar por:</label>
        <select>
            <option>Precio de menor a mayor</option>
            <option>Precio de mayor a menor</option>
            <option>Fecha de menor a mayor</option>
            <option>Fecha de mayor a menor</option>
        </select>
    </div>
    <div class="contenedor-mostrar">
        <fieldset>
            <legend>Ventas del día</legend>
            <ul>
            <?php
            for($i=0;$i<10;$i++){
                echo "<li>Lorem, ipsum dolor</li>";
            }
            ?>
            </ul>
        </fieldset>
    </div>
</div>

<?php
$contenido = ob_get_clean();

require "./includes/layout/menulayout.php";
?>

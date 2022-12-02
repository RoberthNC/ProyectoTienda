<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$query = "SELECT Venta.idVenta as idVenta, Usuario.nombre as nombre, Venta.montototal as montototal, Venta.fecha as fecha FROM Venta LEFT JOIN Usuario ON Venta.idUsuario=Usuario.idUsuario";

$resultados = mysqli_query($conn,$query);

$fechaHoy = date('Y-m-d');

$consultarFechaHoy = "SELECT COUNT(idVenta) as cantidadVentasHoy FROM Venta WHERE fecha = '$fechaHoy'";
$resultadosFechaHoy = mysqli_query($conn,$consultarFechaHoy);
$resultadosFechaHoy = mysqli_fetch_assoc($resultadosFechaHoy);

$consultarCantidadHoy = "SELECT SUM(cantidad) as productosVendidos FROM producto_venta WHERE fecha = '$fechaHoy'";
$resultadosCantidadHoy = mysqli_query($conn,$consultarCantidadHoy);
$resultadosCantidadHoy = mysqli_fetch_assoc($resultadosCantidadHoy);

$consutarMontoHoy = "SELECT SUM(montototal) as montoTotalHoy FROM Venta WHERE fecha = '$fechaHoy'";
$resultadosMontoHoy = mysqli_query($conn,$consutarMontoHoy);
$resultadosMontoHoy = mysqli_fetch_assoc($resultadosMontoHoy);

?>

<div class="contenedor-secciones">
    <section class="seccion">
        <h2>Cantidad de ventas del día:</h2>
        <p><?php echo $resultadosFechaHoy["cantidadVentasHoy"];?></p>
    </section>
    <section class="seccion">
        <h2>Cantidad de productos vendidos hoy:</h2>
        <p><?php echo $resultadosCantidadHoy["productosVendidos"];?></p>
    </section>
    <section class="seccion">
        <h2>Dinero de ventas del día:</h2>
        <p><?php echo $resultadosMontoHoy["montoTotalHoy"];?></p>
    </section>
</div>

<div class="contenedor-tabla">
    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>MONTO TOTAL</th>
                <th>FECHA</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tbody">
        <?php
                if($resultados->num_rows>0){

                    while($row = mysqli_fetch_assoc($resultados)){

            ?>
            
            <tr>
                <td><?php echo $row["idVenta"];?></td>
                <td><?php echo $row["nombre"];?></td>
                <td><?php echo $row["montototal"];?></td>
                <td><?php echo $row["fecha"];?></td>
            </tr>

            <?php
                    }

                }
            ?>
        </tbody>
    </table>
</div>

<?php
$contenido = ob_get_clean();

require "./includes/layout/menulayout.php";
?>

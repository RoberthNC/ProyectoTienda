<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();
$id = $_GET['id'];
$queryProveedor = "SELECT * FROM Proveedor WHERE idProveedor = '${id}'";
$resultadosProveedor = mysqli_query($conn,$queryProveedor);
$proveedor=mysqli_fetch_assoc($resultadosProveedor);

if($_SERVER["REQUEST_METHOD"]==="POST"){

    
    $razonSocial=$_POST["razonSocial"];
    $ruc=$_POST["ruc"];
    $telefono=$_POST["telefono"];

    $query = "UPDATE Proveedor SET razonSocial='${razonSocial}' , ruc = '${ruc}' , telefono= '${telefono}' where idProveedor = ${id} ";
    $resultadosInsercion = mysqli_query($conn,$query);

    if($resultadosInsercion){
        header("Location: ./proveedores.php");
    }
}

?>

<div class="contenedor-regresar">
    <a href="./proveedores.php">Regresar</a>
</div>

<div class="contenedor-formulario-producto">
    <form method="POST" class="formulario">

        <div class="contenedor-campos-producto">
            <label>Razon Social:</label>
            <input type="text" value="<?php echo $proveedor['razonSocial'] ?>"placeholder="Ingrese la Razon Social" name="razonSocial">
        </div>
        <div class="contenedor-campos-producto">
            <label>Ruc:</label>
            <input type="text" value="<?php echo $proveedor['ruc'] ?>"placeholder="Ingrese El Ruc" name="ruc">
        </div>
        <div class="contenedor-campos-producto">
            <label>Telefono:</label>
            <input type="tel" value="<?php echo $proveedor['telefono'] ?>"placeholder="Ingrese el Telefono" name="telefono">
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
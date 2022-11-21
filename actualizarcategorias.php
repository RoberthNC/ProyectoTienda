<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$idBuscar = $_GET["id"];
$query = "SELECT * FROM Categoria WHERE idCategoria='$idBuscar'";

$resultados = mysqli_query($conn,$query);

if($resultados->num_rows>0){

    while($row = mysqli_fetch_assoc($resultados)){
        $nombreActualizar = $row["nombre"];
        $descripcionActualizar = $row["descripcion"];
    }

}

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $nombre2 = $_POST['nombre'];
    $descripcion2 = $_POST['descripcion'];
    $queryActualizar = "UPDATE Categoria SET nombre='$nombre2', descripcion='$descripcion2' WHERE idCategoria=${idBuscar}";        
    $resultados2 = mysqli_query($conn,$queryActualizar);

    if($resultados2){
        header("Location: ./categoria.php");
    }
}

?>

<div class="contenedor-regresar">
    <a href="./categoria.php">Regresar</a>
</div>

<div class="contenedor-formulario-categoria">
    <form method="POST" class="formulario">
        <div class="contenedor-campos-categoria">
            <label>Nombre:</label>
            <input type="text" placeholder="Ingrese nombre" name="nombre" value="<?php echo $nombreActualizar?>">
        </div>
        <div class="contenedor-campos-categoria">
            <label>Descripcion:</label>
            <input type="text" placeholder="Ingrese descripción" name="descripcion" value="<?php echo $descripcionActualizar?>">
        </div>
        <div class="contenedor-boton-categoria">
            <input type="submit" value="Actualizar">
        </div>
    </form>
</div>

<?php
$contenido = ob_get_clean();
require "./includes/layout/menulayout.php";
?>
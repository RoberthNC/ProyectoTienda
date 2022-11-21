<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $conn = ConexionBD();

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];

    $query = "INSERT INTO Categoria(nombre,descripcion) VALUES('$nombre','$descripcion')";
    
    $resultados = mysqli_query($conn,$query);

    if($resultados){
        header("Location: ./agregarcategoria.php");
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
            <input type="text" placeholder="Ingrese nombre" name="nombre">
        </div>
        <div class="contenedor-campos-categoria">
            <label>Descripcion:</label>
            <input type="text" placeholder="Ingrese descripción" name="descripcion">
        </div>
        <div class="contenedor-boton-categoria">
            <input type="submit" value="Guardar">
        </div>
    </form>
</div>

<?php
$contenido = ob_get_clean();
require "./includes/layout/menulayout.php";
?>
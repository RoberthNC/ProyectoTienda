<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$queryCategorias = "SELECT * FROM Categoria";
$resultadosCategorias = mysqli_query($conn,$queryCategorias);

if($_SERVER["REQUEST_METHOD"]==="POST"){

    
    $nombre=$_POST["nombre"];
    $correo=$_POST["correo"];
    $dni=$_POST["dni"];
    $clave=$_POST["clave"];
    $cargo=$_POST["cargo"];
    $fecha = date('Y-m-d');

    $query = "INSERT INTO usuario(nombre,correo,clave,dni,fechadecreacion) VALUES('$nombre','$correo','$clave','$dni','$fecha')";
    $resultadosInsercion = mysqli_query($conn,$query);

    $queryBuscar = "SELECT * FROM usuario WHERE dni ='$dni'";
    $consultaBusqueda=mysqli_query($conn,$queryBuscar);
    $resultadoBusqueda= mysqli_fetch_assoc($consultaBusqueda);
    $id_usuario=$resultadoBusqueda['idUsuario'];
    if($cargo==='1'){
        mysqli_query($conn,"INSERT INTO administrador(idUsuario) VALUES('$id_usuario')");
    }
    else{
        mysqli_query($conn,"INSERT INTO empleado(idUsuario) VALUES('$id_usuario')");

    }

    if($resultadosInsercion){
        header("Location: ./usuarios.php");
    }
}

?>

<div class="contenedor-regresar">
    <a href="./usuarios.php">Regresar</a>
</div>

<div class="contenedor-formulario-producto">
    <form method="POST" class="formulario">

        <div class="contenedor-campos-producto">
            <label>Nombre:</label>
            <input type="text" placeholder="Ingrese el nombre" name="nombre">
        </div>
        <div class="contenedor-campos-producto">
            <label>Correo:</label>
            <input type="text" placeholder="Ingrese el correo" name="correo">
        </div>
        <div class="contenedor-campos-producto">
            <label>Clave:</label>
            <input type="password" placeholder="Ingrese la contraseña" name="clave">
        </div>
        <div class="contenedor-campos-producto">
            <label>DNI:</label>
            <input type="text" placeholder="Ingrese el DNI" name="dni">
        </div>
        <select name="cargo">
            <option value='1'>Administrador</option>
            <option value='0'>Empleado</option>
        </select>
        <div class="contenedor-boton-producto">
            <input type="submit" value="Guardar">
        </div>

    </form>
</div>

<?php
$contenido = ob_get_clean();
require "./includes/layout/menulayout.php";
?>
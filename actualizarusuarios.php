<?php
ob_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();
$id = $_GET['id'];
$queryUsuario = "SELECT * FROM usuario WHERE idUsuario = '$id'";
$resultadosUsuario = mysqli_query($conn,$queryUsuario);
$usuario = mysqli_fetch_assoc($resultadosUsuario);
if($_SERVER["REQUEST_METHOD"]==="POST"){

    
    $nombre=$_POST["nombre"];
    $correo=$_POST["correo"];
    $dni=$_POST["dni"];
    $clave=$_POST["clave"];
    $cargo=$_POST["cargo"];
    $fecha = date('Y-m-d');

    $query = "UPDATE usuario SET nombre='$nombre',correo='$correo', clave='$clave',dni='$dni' WHERE idUsuario='$id'";
    $resultadosInsercion = mysqli_query($conn,$query);
    if($cargo==='1'){
        $queryVerificar="SELECT * FROM administrador WHERE idUsuario='$id'";
        $resultado=mysqli_query($conn,$queryVerificar);
        if($resultado->num_rows>0){
  
        }else{
            mysqli_query($conn,"INSERT INTO administrador(idUsuario) VALUES('$id')");
            mysqli_query($conn,"DELETE FROM empleado WHERE idUsuario='$id'");
        }   

    }
    else{
        $queryVerificar="SELECT * FROM empleado WHERE idUsuario='$id'";
        $resultado=mysqli_query($conn,$queryVerificar);
        if($resultado->num_rows>0){

        }else{
            mysqli_query($conn,"INSERT INTO empleado(idUsuario) VALUES('$id')");
            mysqli_query($conn,"DELETE FROM administrador WHERE idUsuario='$id'");

        }

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
            <input type="text" placeholder="Ingrese el nombre" name="nombre" value="<?php echo $usuario["nombre"] ?>">
        </div>
        <div class="contenedor-campos-producto">
            <label>Correo:</label>
            <input type="text" placeholder="Ingrese el correo" name="correo" value="<?php echo $usuario["correo"] ?>">
        </div>
        <div class="contenedor-campos-producto">
            <label>Clave:</label>
            <input type="password" placeholder="Ingrese la contraseña" name="clave" value="<?php echo $usuario["clave"] ?>">
        </div>
        <div class="contenedor-campos-producto">
            <label>DNI:</label>
            <input type="text" placeholder="Ingrese el DNI" name="dni" value="<?php echo $usuario["dni"] ?>">
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
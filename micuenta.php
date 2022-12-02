<?php

ob_start();

error_reporting(0);
session_start();

require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    //Verificamos si la contraseña actual es la correcta
    $password = $_POST["contra_actual"];
    $contraActual = "SELECT * FROM Usuario WHERE clave='$password'";
    $resultadosContraActual = mysqli_query($conn,$contraActual);
    if($resultadosContraActual->num_rows>0){
        //Contraseña actual es correcta
        $arrayResultados = mysqli_fetch_assoc($resultadosContraActual);
        $id = (int)$arrayResultados["idUsuario"];
        
        //Query para actualizar la contraseña
        $newPassword = $_POST["contra_nueva"];
        $queryActualizar = "UPDATE Usuario SET clave='$newPassword' WHERE idUsuario=$id";
        $resultadosActualizacion = mysqli_query($conn,$queryActualizar);
    }
    header("Location: ./micuenta.php");
}

?>

<div class="contenedor-datos-usuario">
    <div class="datos_usuario">
        <h2><?php echo "NOMBRE USUARIO: " . $_SESSION["nombre_usuario"];?></h2>
    </div>
    <div class="datos_usuario">
        <h2><?php echo "ROL: " . $_SESSION["rol"];?></h2>
    </div>
    <div class="datos_usuario">
        <a href="./menuprincipal.php">< Menú Principal</a>
    </div>
</div>

<div class="titulo_historial">
    <h2>Historial de ventas:</h2>
</div>

<div class="contenedor_ventas_usuario">
    <div class="buscador_venta">
        <input type="text" placeholder="Buscar" id="buscar_venta">
    </div>
    <div class="filtro_venta">
        <select name="select" id="select">
            <option value="idVenta">ID</option>
            <option value="montototal">MONTO TOTAL</option>
            <option value="fecha">FECHA</option>
        </select>
    </div>
    <div class="texto_ordenar">
        <label for="ordenar">Ordenar por: </label>
    </div>
    <div class="ordenar_venta">
        <select name="ordenar" id="ordenar">
            <option value="DESC">Mayor a menor</option>
            <option value="ASC">Menor a mayor</option>
        </select>
    </div>
    <div class="filtrar_ventas">
        <button id="filtrar">Filtrar</button>
    </div>
</div>

<div class="contenedor_ventas_contra">
    <div class="tabla_ventas">
        <table class="tabla">
            <thead>
                <th>ID</th>
                <th>MONTO TOTAL</th>
                <th>FECHA</th>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>

    <div class="div_actualizar">
        <form method="POST" class="formulario">
            <div class="contra_actual">
                <label for="contra_actual">Contraseña Actual:</label>
                <input type="text" placeholder="Ingrese contraseña actual" id="contra_actual" name="contra_actual">
            </div>
            <div class="contra_nueva">
                <label for="contra_nueva">Contraseña Nueva: </label>
                <input type="text" placeholder="Ingrese contraseña nueva" id="contra_nueva" name="contra_nueva">
            </div>
            <div class="guardar">
                <input type="submit" value="Guardar Contraseña">
            </div>
        </form>
    </div>
</div>

<?php

$contenido = ob_get_clean();

require "./includes/layout/menulayout.php";

?>

<script src="./indexUsuarioVenta.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./build/css/app.css">
</head>
<body>

    <?php

        error_reporting(0);

        require "./includes/funciones/conexion.php";
        require "./includes/funciones/funciones.php";

        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $conn = ConexionBD();

            $usuario = $_POST["usuario"];
            $contra = $_POST["contra"];

            $query = "SELECT * FROM Usuario WHERE correo='$usuario' AND clave='$contra'";
            $resultados = mysqli_query($conn,$query);

            if($resultados->num_rows>0){
                $resultados = mysqli_fetch_assoc($resultados);
                $id_usuario = $resultados['idUsuario'];
                $consulta =mysqli_query($conn,"SELECT * FROM administrador WHERE idUsuario = '$id_usuario'");
                session_start();
                $_SESSION["id_usuario"] = $resultados["idUsuario"];
                $_SESSION["nombre_usuario"] = $resultados["nombre"];
                if($consulta->num_rows>0){
                    $_SESSION["cargo"]="admin";
                }
                else{
                    $_SESSION["cargo"]="empleado";
                }
                header("Location: ./menuprincipal.php");
            }
        }
    ?>

    <div class="contenedor-login">
        <div class="contenedor">
            <div class="login-titulo">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="12" cy="12" r="9" />
  <circle cx="12" cy="10" r="3" />
  <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
</svg>
                <h1>INICIA SESIÓN</h1>
            </div>
            <div class="login-formulario">
                <form class="formulario" method="POST">
                    <div class="contenedor-campos">
                        <label for="usuario">Usuario:</label>
                        <input type="mail" id="usuario" placeholder="Ingrese usuario" name="usuario" required>
                    </div>
                    <div class="contenedor-campos">
                        <label for="contra">Contraseña:</label>
                        <input type="password" id="contra" placeholder="Ingrese contraseña" name="contra" required>
                    </div>
                    <div class="contenedor-boton">
                        <input type="submit" value="INICIAR SESION">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
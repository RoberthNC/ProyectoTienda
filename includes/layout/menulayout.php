<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="./build/css/app.css">
</head>
<body>
    <?php
    session_start();
    $nombreUsuario = $_SESSION["nombre_usuario"]??"";
    ?>
    <div class="contenedor-pagina">
        <div class="sidebar">
            <div class="sidebar__titulo">
                <h1>NOVEDADES IVANNA</h1>
            </div>
            <nav class="sidebar__enlaces">
                <a href="#">Ventas</a>
                <a href="./categoria.php">Categorías</a>
                <a href="./productos.php">Productos</a>
                <a href="./proveedores.php">Proveedores</a>
                <a href="#">Usuarios</a>
            </nav>
        </div>
        <main class="main">
            <div class="contenedor-barra">
                <div class="contenedor-barra__user">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="12" cy="12" r="9" />
  <circle cx="12" cy="10" r="3" />
  <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
</svg>
<p><?php echo $nombreUsuario;?></p>
                </div>
                <a href="" class="contenedor-barra_enlace">Mi Cuenta</a>
                <a href="./index.php" class="contenedor-barra_enlace">Cerrar Sesión</a>
            </div>
            <?php
            echo $contenido;
            ?>
        </main>
    </div>
</body>
</html>
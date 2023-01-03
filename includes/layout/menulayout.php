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
                <a href="./menuprincipal.php">NOVEDADES IVANNA</a>
            </div>
            <nav class="sidebar__enlaces">
                <a href="./ventas.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-mastercard" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="14" cy="12" r="3" />
  <path d="M12 9.765a3 3 0 1 0 0 4.47" />
  <rect x="3" y="5" width="18" height="14" rx="2" />
</svg> Ventas</a>
                <a href="./categoria.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="9" y1="6" x2="20" y2="6" />
  <line x1="9" y1="12" x2="20" y2="12" />
  <line x1="9" y1="18" x2="20" y2="18" />
  <line x1="5" y1="6" x2="5" y2="6.01" />
  <line x1="5" y1="12" x2="5" y2="12.01" />
  <line x1="5" y1="18" x2="5" y2="18.01" />
</svg> Categorías</a>
                <a href="./productos.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shirt" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M15 4l6 2v5h-3v8a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-8h-3v-5l6 -2a3 3 0 0 0 6 0" />
</svg> Productos</a>
                <a href="./proveedores.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ambulance" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="7" cy="17" r="2" />
  <circle cx="17" cy="17" r="2" />
  <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
  <path d="M6 10h4m-2 -2v4" />
</svg> Proveedores</a>
                <?php if($_SESSION['cargo']==='admin'){?>
                <a href="./usuarios.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="9" cy="7" r="4" />
  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
</svg> Usuarios</a>
                <?php }?>
                <a href="./compras.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-mastercard" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="14" cy="12" r="3" />
  <path d="M12 9.765a3 3 0 1 0 0 4.47" />
  <rect x="3" y="5" width="18" height="14" rx="2" />
</svg> Compras</a>
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
                <a href="./micuenta.php" class="contenedor-barra_enlace">Mi Cuenta</a>
                <a href="./index.php" class="contenedor-barra_enlace">Cerrar Sesión</a>
            </div>
            <?php
            echo $contenido;
            ?>
        </main>
    </div>
</body>
</html>
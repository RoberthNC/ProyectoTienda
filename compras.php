<?php
ob_start();


require "./includes/funciones/conexion.php";
require "./includes/funciones/funciones.php";

$conn = ConexionBD();

$band = false;

$query = "SELECT Compra.idCompra as idCompra, Proveedor.razonSocial as proveedor, Compra.montototal as montototal, Compra.fecha as fecha FROM Compra INNER JOIN Proveedor ON Compra.idProveedor=Proveedor.idProveedor";

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $band = true;

    $buscador = $_POST["buscador"];
    $filtro = $_POST["filtro"];
    $orden = $_POST["orden"];

    //Caso 1
    if($buscador==""){
        $query = "SELECT Compra.idCompra as idCompra, Proveedor.razonSocial as proveedor, Compra.montototal as montototal, Compra.fecha as fecha FROM Compra INNER JOIN Proveedor ON Compra.idProveedor=Proveedor.idProveedor ORDER BY Compra.$filtro $orden";
    }
    //Caso 2
    else{
        $query = "SELECT Compra.idCompra as idCompra, Proveedor.razonSocial as proveedor, Compra.montototal as montototal, Compra.fecha as fecha FROM Compra INNER JOIN Proveedor ON Compra.idProveedor=Proveedor.idProveedor WHERE Compra.$filtro='$buscador' ORDER BY Compra.$filtro $orden";
    }
}

$resultados = mysqli_query($conn,$query);

?>

<div class="contenedor-agregar-producto">
    <div class="agregar-producto">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="12" cy="12" r="9" />
  <line x1="9" y1="12" x2="15" y2="12" />
  <line x1="12" y1="9" x2="12" y2="15" />
</svg>
        <a href="./agregarcompra.php">Agregar</a>
    </div>
</div>

<form method="POST">
<div class="contenedor-filtrar-categoria">
    <div class="contenedor-buscar-categoria">
        <input type="text" placeholder="Buscar" id="buscador" name="buscador">
        <select id="filtro" name="filtro">
            <option value="idCompra">Id</option>
            <option value="fecha">Fecha</option>
        </select>

        <input type="submit" value="Buscar" id="submit">
    </div>

    <div class="contenedor-ordenar-categoria">
        <label>Ordenar por:</label>
        <select id="orden" name="orden">
            <option value="DESC">Mayor a menor</option>
            <option value="ASC">Menor a mayor</option>
        </select>
    </div>
</div>
</form>

<div class="contenedor-tabla">
    <table class="tabla">
        <thead>
            <tr>
                <th>ID COMPRA</th>
                <th>PROVEEDOR</th>
                <th>MONTO TOTAL</th>
                <th>FECHA</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php

            //Caso sin filtros ni buscadores
            if($band===false){

                if($resultados->num_rows>0){

                    while($row = mysqli_fetch_assoc($resultados)){

            ?>
            
            <tr>
                <td><?php echo $row["idCompra"];?></td>
                <td><?php echo $row["proveedor"];?></td>
                <td><?php echo $row["montototal"];?></td>
                <td><?php echo $row["fecha"];?></td>
            </tr>

            <?php
                    }

                }

            }

            else{
                //Caso con filtros y buscadores

                if($resultados->num_rows>0){

                    while($row = mysqli_fetch_assoc($resultados)){
            ?>

            <tr>
                <td><?php echo $row["idCompra"];?></td>
                <td><?php echo $row["proveedor"];?></td>
                <td><?php echo $row["montototal"];?></td>
                <td><?php echo $row["fecha"];?></td>
            </tr>
            
            <?php
                    }
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
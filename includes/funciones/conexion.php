<?php

function ConexionBD(){
    $conn = mysqli_connect("localhost","root","Flash123","tiendavictor");

    return $conn;
}

?>
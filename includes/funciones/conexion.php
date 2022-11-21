<?php

function ConexionBD(){
    $conn = mysqli_connect("localhost","root","","tiendavictor");

    return $conn;
}

?>
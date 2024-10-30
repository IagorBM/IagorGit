<?php
    session_start();
    $var = $_GET['var'];

    include_once('../banco/conect.php');
    $obj = new conect();
    $resultado = $obj->ConectarBanco();

    $sql = "DELETE FROM contatos WHERE id_contatos=$var;";

    $query = $resultado->prepare($sql);
    $query->execute();
    
    header("location: agrenda.php");
?>
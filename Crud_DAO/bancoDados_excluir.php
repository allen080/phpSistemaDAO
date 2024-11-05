<?php
session_start();
require "../bancoDados_config.php";
require "dao/UsuarioDAOMysql.php";

function redirect($file, $msgAviso=""){
    header("Location: $file");
    exit;
}

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$usuarioDAO = new UsuarioDAOMysql($pdo);

if($id){// remove o usuario
    $usuarioDAO->remove($id);
}

redirect("bancoDados_acesso.php");
?>


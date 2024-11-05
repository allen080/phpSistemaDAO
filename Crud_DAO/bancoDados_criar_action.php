<?php
session_start();
require "../bancoDados_config.php";
require "dao/UsuarioDAOMysql.php";

function redirect($file, $msgAviso=""){
    $_SESSION["avisoMsg"] = $msgAviso;
    header("Location: $file");
    exit;
}

$sistemaDAO = new UsuarioDAOMysql($pdo);

$nome = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);

if(!$nome || !$email){
    redirect("bancoDados_criar.php", "<p style=\"color: red\">preencha tudo corretamente</p>");
}

// checa se tem o email
if($sistemaDAO->findByEmail($email)){
    redirect("bancoDados_criar.php", "<p style=\"color: red\">email já cadastrado no sistema</p>");
}

// insere
$sistemaDAO->add(new Usuario($nome, $email));

redirect("bancoDados_criar.php", "<p style=\"color: green\">[*] dados cadastrados</p>");
?>
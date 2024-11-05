<?php
session_start();
require "../bancoDados_config.php";
require "dao/UsuarioDAOMysql.php";

function redirect($file, $msgAviso=""){
    $_SESSION["avisoMsg"] = $msgAviso;
    header("Location: $file");
    exit;
}

$usuarioDAO = new UsuarioDAOMysql($pdo);

$nome = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(!$nome || !$email || !$id){
    redirect("bancoDados_editar.php?id=$id", "<p style=\"color: red\">preencha tudo corretamente</p>");
}

// checa se tem o email
$usuarioCheckEmail = $usuarioDAO->findByEmail($email);

if($usuarioCheckEmail->getId() != $id){
    redirect("bancoDados_editar.php?id=$id", "<p style=\"color: red\">email já cadastrado no sistema</p>");
}

// pega o usuario do sistema com os dados dele
$usuarioCadastrado = $usuarioDAO->findById($id); 
// atualiza os dados
$usuarioCadastrado->setNome($nome);
$usuarioCadastrado->setEmail($email);

$usuarioDAO->update($usuarioCadastrado);

redirect("bancoDados_editar.php?id=$id", "<p style=\"color: green\">[*] dados atualizados</p>");

?>
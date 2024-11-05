<?php
session_start();
require "../bancoDados_config.php";
require "dao/UsuarioDAOMysql.php";

$usuarioDAO = new UsuarioDAOMysql($pdo);

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(!$id){
    header("Location: bancoDados_acesso.php");
    exit;
}

$usuario = $usuarioDAO->findById($id);
if(!$usuario){
    header("Location: bancoDados_acesso.php");
    exit;
}
?>

<h2>Editar usuário - <a href="bancoDados_acesso.php">Voltar</a></h2>
<form method="GET" action="bancoDados_editar_action.php">
    <label>
        Nome:
        <input type="text" name="nome" value="<?=$usuario->getNome()?>"/>
    </label><br/><br/>

    <label>
        Email:
        <input type="email" name="email" value="<?=$usuario->getEmail()?>"/>
    </label><br/><br/>

    <input type="hidden" name="id" value="<?=$usuario->getId()?>"/>
    <input type="submit"/>

    <?php
        $aviso = $_SESSION["avisoMsg"] ?? "";
        echo $aviso;
        $_SESSION["avisoMsg"] = '';
    ?>
</form>
<?php
require "../bancoDados_config.php";
require "dao/UsuarioDAOMysql.php";

$usuarioDAO = new UsuarioDAOMysql($pdo);
$dados = $usuarioDAO->findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        tr { font-size:20px; }
        th { padding:8px; }
        td { padding:8px; }
    </style>
</head>
<body>
<strong>Criar usuários <a href="bancoDados_criar.php">aqui</a></strong><br/><br/>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>ID</th>
        <th>Ações</th>
    </tr>

    <?php        
        foreach($dados as $usuario): ?>
            <tr>
                <td><?= $usuario->getNome() ?></td>
                <td><?= $usuario->getEmail() ?></td>
                <td><?= $usuario->getId()?></td>
                <td>
                    <a href="bancoDados_editar.php?id=<?=$usuario->getId()?>">[ Editar ]</a>
                    <a href="bancoDados_excluir.php?id=<?=$usuario->getId()?>"
                        onclick="return confirm('Deseja excluir o usuário de id <?=$usuario->getId()?>?')">[ Excluir ]</a>
                </td>
            </tr>
        <?php endforeach;?>
        
</table>

</body>
</html>


<?php session_start(); ?>
<h1>Adicionar usuário <a href="bancoDados_acesso.php">Voltar</a></h1>
<form method="GET" action="bancoDados_criar_action.php">
    <label>
        Nome:
        <input type="text" name="nome"/>
    </label><br/><br/>

    <label>
        Email:
        <input type="email" name="email"/>
    </label><br/><br/>

    <input type="submit"/>

    <?php
        //if(isset($_SESSION["errorMsg"]) && !empty($_SESSION["errorMsg"])){
            $erro = $_SESSION["avisoMsg"] ?? "";
            echo $erro;
            $_SESSION["avisoMsg"] = '';
        //}
    ?>
</form>
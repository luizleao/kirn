<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();

$o%%NOME_CLASSE%% = (!isset($_REQUEST['%%ID_PK%%'])) ? NULL : $oController->get($_REQUEST['%%ID_PK%%']);
$label   = (is_null($o%%NOME_CLASSE%%)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($o%%NOME_CLASSE%%)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

%%CARREGA_COLECAO%%
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <div id="app" class="container">
        <?php 
        require_once("includes/titulo.php"); 
        require_once("includes/menu.php"); 
        ?>
        <ol class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li><a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a></li>
            <li class="active"><?=$label?></li>
        </ol>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
            <div class="row">
            	%%ATRIBUICAO%%
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="adm%%NOME_CLASSE%%.php">Voltar</a>
                        %%CHAVE_PRIMARIA%%
                        <input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
    <script>
    //Vue.config.devtools = true;
    var app = new Vue({
		el: '#app',
		data: {
			classe: ''
		}
	});
    </script>
</body>
</html>
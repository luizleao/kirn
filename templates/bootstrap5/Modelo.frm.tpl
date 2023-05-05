<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();

$o%%NOME_CLASSE%% = (isset($_REQUEST['%%ID_PK%%'])) ? $oController->get($_REQUEST['%%ID_PK%%']) : NULL;
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
    <div class="container">
        <?php require_once("includes/menu.php"); ?>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb p-3">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?=$label?></li>
			</ol>
		</nav>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                %%ATRIBUICAO%%
            </div>
            <div class="row">
                <div class="col-md-4 p-3">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-success">Salvar</button>
                        <a class="btn btn-secondary" href="adm%%NOME_CLASSE%%.php">Voltar</a>
                        %%CHAVE_PRIMARIA%%
                        <input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
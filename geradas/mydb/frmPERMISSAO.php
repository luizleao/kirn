<?php
require_once("classes/autoload.php");
$oController = new ControllerPERMISSAO();

$oPERMISSAO = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oPERMISSAO)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPERMISSAO)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}


?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <div class="container">
        <?php 
        require_once("includes/titulo.php"); 
        require_once("includes/menu.php"); 
        ?>
        <ol class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li><a href="admPERMISSAO.php">PERMISSAO</a></li>
            <li class="active"><?=$label?></li>
        </ol>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
            <div class="row">
            	
<div class="col-md-4">
	<div class="form-group">
		<label for="alteracao">Alteracao</label>
		<input type="text" class="form-control" id="alteracao" name="alteracao" value="<?=$oPERMISSAO->alteracao?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="insercao">Insercao</label>
		<input type="text" class="form-control" id="insercao" name="insercao" value="<?=$oPERMISSAO->insercao?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="exclusao">Exclusao</label>
		<input type="text" class="form-control" id="exclusao" name="exclusao" value="<?=$oPERMISSAO->exclusao?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="visualizacao">Visualizacao</label>
		<input type="text" class="form-control" id="visualizacao" name="visualizacao" value="<?=$oPERMISSAO->visualizacao?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admPERMISSAO.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="PERMISSAO" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
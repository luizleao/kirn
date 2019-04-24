<?php
require_once("classes/autoload.php");
$oController = new ControllerPERFILACESSO();

$oPERFILACESSO = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oPERFILACESSO)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPERFILACESSO)) ? ($oController->alterar()) : ($oController->cadastrar());
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
            <li><a href="admPERFILACESSO.php">PERFILACESSO</a></li>
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
		<label for="nome">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$oPERFILACESSO->nome?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="se_semana">Se_semana</label>
		<input type="text" class="form-control" id="se_semana" name="se_semana" value="<?=$oPERFILACESSO->se_semana?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admPERFILACESSO.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="PERFILACESSO" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
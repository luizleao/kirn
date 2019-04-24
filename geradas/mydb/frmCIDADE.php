<?php
require_once("classes/autoload.php");
$oController = new ControllerCIDADE();

$oCIDADE = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oCIDADE)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oCIDADE)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerESTADO = new ControllerESTADO();$aESTADO = $oControllerESTADO->getAll([], []);
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
            <li><a href="admCIDADE.php">CIDADE</a></li>
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
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$oCIDADE->nome?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="ESTADO_id">ESTADO</label>
		<select name="ESTADO_id" id="ESTADO_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aESTADO as $oESTADO){
		?>
			<option value="<?=$oESTADO->ESTADO_id?>"<?=($oESTADO->ESTADO_id == $oCIDADE->oESTADO->id) ? " selected" : ""?>><?=$oESTADO->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admCIDADE.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="CIDADE" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
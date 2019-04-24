<?php
require_once("classes/autoload.php");
$oController = new ControllerENDERECO();

$oENDERECO = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oENDERECO)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oENDERECO)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerCIDADE = new ControllerCIDADE();$aCIDADE = $oControllerCIDADE->getAll([], []);
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
            <li><a href="admENDERECO.php">ENDERECO</a></li>
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
		<label for="rua">Rua</label>
		<input type="text" class="form-control" id="rua" name="rua" value="<?=$oENDERECO->rua?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="bairro">Bairro</label>
		<input type="text" class="form-control" id="bairro" name="bairro" value="<?=$oENDERECO->bairro?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="cep">Cep</label>
		<input type="text" class="form-control cep" id="cep" name="cep" value="<?=$oENDERECO->cep?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="numero">Numero</label>
		<input type="text" class="form-control" id="numero" name="numero" value="<?=$oENDERECO->numero?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="complemento">Complemento</label>
		<input type="text" class="form-control" id="complemento" name="complemento" value="<?=$oENDERECO->complemento?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="CIDADE_id">CIDADE</label>
		<select name="CIDADE_id" id="CIDADE_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aCIDADE as $oCIDADE){
		?>
			<option value="<?=$oCIDADE->CIDADE_id?>"<?=($oCIDADE->CIDADE_id == $oENDERECO->oCIDADE->id) ? " selected" : ""?>><?=$oCIDADE->nome?></option>
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
                        <a class="btn btn-default" href="admENDERECO.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="ENDERECO" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
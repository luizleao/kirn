<?php
require_once("classes/autoload.php");
$oController = new ControllerTELAPERMISSAO();

$oTELAPERMISSAO = ($_REQUEST[''] == "") ? NULL        : $oController->get($_REQUEST['']);
$label   = (is_null($oTELAPERMISSAO)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oTELAPERMISSAO)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerTELA = new ControllerTELA();$aTELA = $oControllerTELA->getAll([], []);
$oControllerPERMISSAO = new ControllerPERMISSAO();$aPERMISSAO = $oControllerPERMISSAO->getAll([], []);
$oControllerPERFIL = new ControllerPERFIL();$aPERFIL = $oControllerPERFIL->getAll([], []);
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
            <li><a href="admTELAPERMISSAO.php">TELAPERMISSAO</a></li>
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
		<label for="TELA_id">TELA</label>
		<select name="TELA_id" id="TELA_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aTELA as $oTELA){
		?>
			<option value="<?=$oTELA->TELA_id?>"<?=($oTELA->TELA_id == $oTELAPERMISSAO->oTELA->id) ? " selected" : ""?>><?=$oTELA->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="PERMISSAO_id">PERMISSAO</label>
		<select name="PERMISSAO_id" id="PERMISSAO_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aPERMISSAO as $oPERMISSAO){
		?>
			<option value="<?=$oPERMISSAO->PERMISSAO_id?>"<?=($oPERMISSAO->PERMISSAO_id == $oTELAPERMISSAO->oPERMISSAO->id) ? " selected" : ""?>><?=$oPERMISSAO->id?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="PERFIL_id">PERFIL</label>
		<select name="PERFIL_id" id="PERFIL_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aPERFIL as $oPERFIL){
		?>
			<option value="<?=$oPERFIL->PERFIL_id?>"<?=($oPERFIL->PERFIL_id == $oTELAPERMISSAO->oPERFIL->id) ? " selected" : ""?>><?=$oPERFIL->nome?></option>
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
                        <a class="btn btn-default" href="admTELAPERMISSAO.php">Voltar</a>
                        
                        <input type="hidden" name="classe" id="classe" value="TELAPERMISSAO" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
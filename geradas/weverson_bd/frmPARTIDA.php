<?php
require_once("classes/autoload.php");
$oController = new ControllerPARTIDA();

$oPARTIDA = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oPARTIDA)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPARTIDA)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerTIME = new ControllerTIME();$aTIME = $oControllerTIME->getAll([], []);
$oControllerTIME = new ControllerTIME();$aTIME = $oControllerTIME->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
	<?php include_once("includes/menu.php");?>
	<?php include_once("includes/loading.php");?>
    <main class="container light">
    	<blockquote class="border">
    		<a href="home.php">Home</a> <i class="material-icons">chevron_right</i>
    	 	<a href="admPARTIDA.php">PARTIDA</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    
<div class="input-field">
	<select name="idmadante" id="idmadante">
		<option value="">Selecione</option>
	<?php
	foreach($aTIME as $oTIME){
	?>
		<option value="<?=$oTIME->idmadante?>"<?=($oTIME->idmadante == $oPARTIDA->oTIME->id) ? " selected" : ""?>><?=$oTIME->id?></option>
	<?php
	}
	?>
	</select>
	<label for="idmadante">TIME</label>
</div>
<div class="input-field">
	<select name="idvisitante" id="idvisitante">
		<option value="">Selecione</option>
	<?php
	foreach($aTIME as $oTIME){
	?>
		<option value="<?=$oTIME->idvisitante?>"<?=($oTIME->idvisitante == $oPARTIDA->oTIME->id) ? " selected" : ""?>><?=$oTIME->id?></option>
	<?php
	}
	?>
	</select>
	<label for="idvisitante">TIME</label>
</div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="admPARTIDA.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
<input name="idmadante" type="hidden" id="idmadante" value="<?=$_REQUEST['idmadante']?>" />
<input name="idvisitante" type="hidden" id="idvisitante" value="<?=$_REQUEST['idvisitante']?>" />
                    <input type="hidden" name="classe" id="classe" value="PARTIDA" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
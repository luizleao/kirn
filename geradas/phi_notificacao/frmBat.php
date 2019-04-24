<?php
require_once("classes/autoload.php");
$oController = new ControllerBat();

$oBat = ($_REQUEST['id_bat'] == "") ? NULL        : $oController->get($_REQUEST['id_bat']);
$label   = (is_null($oBat)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oBat)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerSensor = new ControllerSensor();$aSensor = $oControllerSensor->getAll([], []);
$oControllerUsuario = new ControllerUsuario();$aUsuario = $oControllerUsuario->getAll([], []);
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
    	 	<a href="admBat.php">Bat</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    
<div class="input-field">
	<select name="locasens" id="locasens">
		<option value="">Selecione</option>
	<?php
	foreach($aSensor as $oSensor){
	?>
		<option value="<?=$oSensor->locasens?>"<?=($oSensor->locasens == $oBat->oSensor->id_sensor) ? " selected" : ""?>><?=$oSensor->id_sensor?></option>
	<?php
	}
	?>
	</select>
	<label for="locasens">Sensor</label>
</div>
<div class="input-field">
	<select name="pessoa" id="pessoa">
		<option value="">Selecione</option>
	<?php
	foreach($aUsuario as $oUsuario){
	?>
		<option value="<?=$oUsuario->pessoa?>"<?=($oUsuario->pessoa == $oBat->oUsuario->id) ? " selected" : ""?>><?=$oUsuario->nome?></option>
	<?php
	}
	?>
	</select>
	<label for="pessoa">Usuario</label>
</div>
<div class="input-field">
    <textarea name="descricao" class="materialize-textarea" id="descricao" cols="80" rows="10"><?=$oBat->descricao?></textarea>
    <label for="descricao">Descricao</label>
</div>
<div class="input-field">
    <?php $oController->componenteCalendario('data', Util::formataDataHoraBancoForm($oBat->data), NULL, true)?>
    <label for="data">Data</label>
</div>
<p>
	<label>
	    <input type="checkbox" name="raiva" id="raiva" value="1"<?=($oBat->raiva == 1) ? ' checked="checked"' : '' ?> />
	    <span>Raiva</span>
    </label>
</p>
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="admBat.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    <input name="id_bat" type="hidden" id="id_bat" value="<?=$_REQUEST['id_bat']?>" />
                    <input type="hidden" name="classe" id="classe" value="Bat" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
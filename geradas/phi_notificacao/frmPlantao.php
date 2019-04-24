<?php
require_once("classes/autoload.php");
$oController = new ControllerPlantao();

$oPlantao = ($_REQUEST['p_id'] == "") ? NULL        : $oController->get($_REQUEST['p_id']);
$label   = (is_null($oPlantao)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPlantao)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerUsuario = new ControllerUsuario();$aUsuario = $oControllerUsuario->getAll([], []);
$oControllerSensor = new ControllerSensor();$aSensor = $oControllerSensor->getAll([], []);
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
    	 	<a href="admPlantao.php">Plantao</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    
<div class="input-field">
	<select name="p_usuario_id" id="p_usuario_id">
		<option value="">Selecione</option>
	<?php
	foreach($aUsuario as $oUsuario){
	?>
		<option value="<?=$oUsuario->p_usuario_id?>"<?=($oUsuario->p_usuario_id == $oPlantao->oUsuario->id) ? " selected" : ""?>><?=$oUsuario->nome?></option>
	<?php
	}
	?>
	</select>
	<label for="p_usuario_id">Usuario</label>
</div>
<div class="input-field">
	<select name="p_id_sensor" id="p_id_sensor">
		<option value="">Selecione</option>
	<?php
	foreach($aSensor as $oSensor){
	?>
		<option value="<?=$oSensor->p_id_sensor?>"<?=($oSensor->p_id_sensor == $oPlantao->oSensor->id_sensor) ? " selected" : ""?>><?=$oSensor->id_sensor?></option>
	<?php
	}
	?>
	</select>
	<label for="p_id_sensor">Sensor</label>
</div>
<div class="input-field">
    <?php $oController->componenteCalendario('datai', Util::formataDataHoraBancoForm($oPlantao->datai), NULL, true)?>
    <label for="datai">Datai</label>
</div>
<div class="input-field">
    <?php $oController->componenteCalendario('dataf', Util::formataDataHoraBancoForm($oPlantao->dataf), NULL, true)?>
    <label for="dataf">Dataf</label>
</div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="admPlantao.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    <input name="p_id" type="hidden" id="p_id" value="<?=$_REQUEST['p_id']?>" />
                    <input type="hidden" name="classe" id="classe" value="Plantao" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
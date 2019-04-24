<?php
require_once("classes/autoload.php");
$oController = new ControllerBat();

$oBat = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes Bat</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Id_"><?=$oBat->id_bat?></div>
		<label for="Id_">Id_</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Sensor"><?=$oBat->oSensor->id_sensor?></div>
		<label for="Sensor">Sensor</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Usuario"><?=$oBat->oUsuario->nome?></div>
		<label for="Usuario">Usuario</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Descricao"><?=$oBat->descricao?></div>
		<label for="Descricao">Descricao</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Data"><?=Util::formataDataHoraBancoForm($oBat->data)?></div>
		<label for="Data">Data</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Raiva"><?=$oBat->raiva?></div>
		<label for="Raiva">Raiva</label>
	</div>
</div>
    </main>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerPlantao();

$oPlantao = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes Plantao</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="P_id"><?=$oPlantao->p_id?></div>
		<label for="P_id">P_id</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Usuario"><?=$oPlantao->oUsuario->nome?></div>
		<label for="Usuario">Usuario</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Sensor"><?=$oPlantao->oSensor->id_sensor?></div>
		<label for="Sensor">Sensor</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Datai"><?=Util::formataDataHoraBancoForm($oPlantao->datai)?></div>
		<label for="Datai">Datai</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Dataf"><?=Util::formataDataHoraBancoForm($oPlantao->dataf)?></div>
		<label for="Dataf">Dataf</label>
	</div>
</div>
    </main>
</body>
</html>
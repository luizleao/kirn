<?php
require_once("classes/autoload.php");
$oController = new ControllerSensor();

$oSensor = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes Sensor</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Id_"><?=$oSensor->id_sensor?></div>
		<label for="Id_">Id_</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Localizacao"><?=$oSensor->localizacao?></div>
		<label for="Localizacao">Localizacao</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Descricao"><?=$oSensor->descricao?></div>
		<label for="Descricao">Descricao</label>
	</div>
</div>
    </main>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerTIME();

$oTIME = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes TIME</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Id"><?=$oTIME->id?></div>
		<label for="Id">Id</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Pais"><?=$oTIME->pais?></div>
		<label for="Pais">Pais</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Tecnico"><?=$oTIME->tecnico?></div>
		<label for="Tecnico">Tecnico</label>
	</div>
</div>
    </main>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerPARTIDA();

$oPARTIDA = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes PARTIDA</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Id"><?=$oPARTIDA->id?></div>
		<label for="Id">Id</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="TIME"><?=$oPARTIDA->oTIME->id?></div>
		<label for="TIME">TIME</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="TIME"><?=$oPARTIDA->oTIME->id?></div>
		<label for="TIME">TIME</label>
	</div>
</div>
    </main>
</body>
</html>
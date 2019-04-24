<?php
require_once("classes/autoload.php");
$oController = new ControllerJOGADOR();

$oJOGADOR = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes JOGADOR</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Cpf"><?=$oJOGADOR->cpf?></div>
		<label for="Cpf">Cpf</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Nome"><?=$oJOGADOR->nome?></div>
		<label for="Nome">Nome</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="N_camisa"><?=$oJOGADOR->n_camisa?></div>
		<label for="N_camisa">N_camisa</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Status"><?=$oJOGADOR->status?></div>
		<label for="Status">Status</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="TIME"><?=$oJOGADOR->oTIME->id?></div>
		<label for="TIME">TIME</label>
	</div>
</div>
    </main>
</body>
</html>
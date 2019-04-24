<?php
require_once("classes/autoload.php");
$oController = new ControllerUsuario();

$oUsuario = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes Usuario</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Id"><?=$oUsuario->id?></div>
		<label for="Id">Id</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Nome"><?=$oUsuario->nome?></div>
		<label for="Nome">Nome</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Status"><?=$oUsuario->status?></div>
		<label for="Status">Status</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Contato"><?=$oUsuario->oContato->email?></div>
		<label for="Contato">Contato</label>
	</div>
</div>
    </main>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerContato();

$oContato = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes Contato</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Id_tel"><?=$oContato->id_tel?></div>
		<label for="Id_tel">Id_tel</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Numero"><?=$oContato->numero?></div>
		<label for="Numero">Numero</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Ddd"><?=$oContato->ddd?></div>
		<label for="Ddd">Ddd</label>
	</div>
</div>
<div class="row">
	<div class="input-field">
		<div id="Email"><?=$oContato->email?></div>
		<label for="Email">Email</label>
	</div>
</div>
    </main>
</body>
</html>
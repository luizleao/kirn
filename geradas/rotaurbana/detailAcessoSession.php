<?php
require_once("classes/autoload.php");
$oController = new ControllerAcessoSession();

$oAcessoSession = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes AcessoSession <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Acesso</label>
	</div>
	<div class="col-md-9">
		<?=$oAcessoSession->oAcesso->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Sessions_id</label>
	</div>
	<div class="col-md-9">
		<?=$oAcessoSession->sessions_id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>
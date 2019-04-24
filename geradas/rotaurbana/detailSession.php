<?php
require_once("classes/autoload.php");
$oController = new ControllerSession();

$oSession = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Session <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oSession->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Ident</label>
	</div>
	<div class="col-md-9">
		<?=$oSession->ident?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>
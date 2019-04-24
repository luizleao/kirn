<?php
require_once("classes/autoload.php");
$oController = new ControllerHibernateSequence();

$oHibernateSequence = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes HibernateSequence <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Next_val</label>
	</div>
	<div class="col-md-9">
		<?=$oHibernateSequence->next_val?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>
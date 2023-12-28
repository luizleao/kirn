<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();

$o%%NOME_CLASSE%% = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes %%NOME_CLASSE%%</legend>
		%%ATRIBUICAO%%
		</fieldset>
    </div>
</body>
</html>
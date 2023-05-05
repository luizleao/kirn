<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();

$o%%NOME_CLASSE%% = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes %%NOME_CLASSE%%</blockquote>
		%%ATRIBUICAO%%
    </main>
</body>
</html>
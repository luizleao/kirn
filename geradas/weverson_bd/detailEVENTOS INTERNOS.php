<?php
require_once("classes/autoload.php");
$oController = new ControllerEVENTOS INTERNOS();

$oEVENTOS INTERNOS = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes EVENTOS INTERNOS</blockquote>
		
    </main>
</body>
</html>
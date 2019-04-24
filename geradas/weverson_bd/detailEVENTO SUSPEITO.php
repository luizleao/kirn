<?php
require_once("classes/autoload.php");
$oController = new ControllerEVENTO SUSPEITO();

$oEVENTO SUSPEITO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes EVENTO SUSPEITO</blockquote>
		
    </main>
</body>
</html>
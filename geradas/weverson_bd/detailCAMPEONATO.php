<?php
require_once("classes/autoload.php");
$oController = new ControllerCAMPEONATO();

$oCAMPEONATO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <main class="container">
		<blockquote class="border">Detalhes CAMPEONATO</blockquote>
		<div class="row">
	<div class="input-field">
		<div id="Id"><?=$oCAMPEONATO->id?></div>
		<label for="Id">Id</label>
	</div>
</div>
    </main>
</body>
</html>
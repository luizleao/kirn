<?php
require_once ("classes/Autoload.php");
$oController = new Controller();
$config = $oController->config;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/menu.php")?>
	<?php require_once("includes/loading.php")?>  
    <main class="container">
<?php
Util::trace($_SESSION['usuarioAtual'] ?? NULL);
?>
    </main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php")?>
	<?php require_once("includes/js.php")?>
	</body>
</html>
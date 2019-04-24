<?php 
require_once("classes/autoload.php");
$oController = new Controller();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<?php require_once("includes/header.php");?>
</head>
<body>
    <div id="wrap">
        <?php require_once("includes/menu.php")?>
        <div class="container">
            <?php require_once("includes/titulo.php"); ?>
        </div>
        <div id="push"></div>
    </div>
<?php require_once("includes/footer.php")?>
<?php require_once("includes/modals.php");?>
</body>
</html>
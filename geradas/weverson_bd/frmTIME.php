<?php
require_once("classes/autoload.php");
$oController = new ControllerTIME();

$oTIME = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oTIME)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oTIME)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}


?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
	<?php include_once("includes/menu.php");?>
	<?php include_once("includes/loading.php");?>
    <main class="container light">
    	<blockquote class="border">
    		<a href="home.php">Home</a> <i class="material-icons">chevron_right</i>
    	 	<a href="admTIME.php">TIME</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    
<div class="input-field">
	<input type="text" class="" id="pais" name="pais" value="<?=$oTIME->pais?>" />
	<label for="pais">Pais</label>
</div>
<div class="input-field">
	<input type="text" class="" id="tecnico" name="tecnico" value="<?=$oTIME->tecnico?>" />
	<label for="tecnico">Tecnico</label>
</div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="admTIME.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                    <input type="hidden" name="classe" id="classe" value="TIME" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
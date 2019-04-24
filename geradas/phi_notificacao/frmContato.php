<?php
require_once("classes/autoload.php");
$oController = new ControllerContato();

$oContato = ($_REQUEST['id_tel'] == "") ? NULL        : $oController->get($_REQUEST['id_tel']);
$label   = (is_null($oContato)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oContato)) ? ($oController->alterar()) : ($oController->cadastrar());
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
    	 	<a href="admContato.php">Contato</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    
<div class="input-field">
	<input type="text" class="" id="numero" name="numero" value="<?=$oContato->numero?>" />
	<label for="numero">Numero</label>
</div>
<div class="input-field">
	<input type="text" class="" id="ddd" name="ddd" value="<?=$oContato->ddd?>" />
	<label for="ddd">Ddd</label>
</div>
<div class="input-field">
	<i class="material-icons prefix">email</i>
	<input type="text" name="email" id="email" value="<?=$oContato->email?>" />
    <label for="email">email</label>
</div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="admContato.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    <input name="id_tel" type="hidden" id="id_tel" value="<?=$_REQUEST['id_tel']?>" />
                    <input type="hidden" name="classe" id="classe" value="Contato" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
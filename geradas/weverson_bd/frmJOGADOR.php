<?php
require_once("classes/autoload.php");
$oController = new ControllerJOGADOR();

$oJOGADOR = ($_REQUEST['cpf'] == "") ? NULL        : $oController->get($_REQUEST['cpf']);
$label   = (is_null($oJOGADOR)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oJOGADOR)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerTIME = new ControllerTIME();$aTIME = $oControllerTIME->getAll([], []);
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
    	 	<a href="admJOGADOR.php">JOGADOR</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    
<div class="input-field">
	<input type="text" class="" id="nome" name="nome" value="<?=$oJOGADOR->nome?>" />
	<label for="nome">Nome</label>
</div>
<div class="input-field">
	<input type="text" class="" id="n_camisa" name="n_camisa" value="<?=$oJOGADOR->n_camisa?>" />
	<label for="n_camisa">N_camisa</label>
</div>
<div class="input-field">
	<input type="text" class="" id="status" name="status" value="<?=$oJOGADOR->status?>" />
	<label for="status">Status</label>
</div>
<div class="input-field">
	<select name="TIME_id" id="TIME_id">
		<option value="">Selecione</option>
	<?php
	foreach($aTIME as $oTIME){
	?>
		<option value="<?=$oTIME->TIME_id?>"<?=($oTIME->TIME_id == $oJOGADOR->oTIME->id) ? " selected" : ""?>><?=$oTIME->id?></option>
	<?php
	}
	?>
	</select>
	<label for="TIME_id">TIME</label>
</div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="admJOGADOR.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    <input name="cpf" type="hidden" id="cpf" value="<?=$_REQUEST['cpf']?>" />
                    <input type="hidden" name="classe" id="classe" value="JOGADOR" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
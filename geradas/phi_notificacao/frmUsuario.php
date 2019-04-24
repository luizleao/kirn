<?php
require_once("classes/autoload.php");
$oController = new ControllerUsuario();

$oUsuario = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oUsuario)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oUsuario)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerContato = new ControllerContato();$aContato = $oControllerContato->getAll([], []);
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
    	 	<a href="admUsuario.php">Usuario</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    
<div class="input-field">
	<input type="text" class="" id="nome" name="nome" value="<?=$oUsuario->nome?>" />
	<label for="nome">Nome</label>
</div>
<p>
	<label>
	    <input type="checkbox" name="status" id="status" value="1"<?=($oUsuario->status == 1) ? ' checked="checked"' : '' ?> />
	    <span>Status</span>
    </label>
</p>
<div class="input-field">
	<select name="id_contato" id="id_contato">
		<option value="">Selecione</option>
	<?php
	foreach($aContato as $oContato){
	?>
		<option value="<?=$oContato->id_contato?>"<?=($oContato->id_contato == $oUsuario->oContato->id_tel) ? " selected" : ""?>><?=$oContato->email?></option>
	<?php
	}
	?>
	</select>
	<label for="id_contato">Contato</label>
</div>
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="admUsuario.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                    <input type="hidden" name="classe" id="classe" value="Usuario" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
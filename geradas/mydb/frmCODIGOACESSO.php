<?php
require_once("classes/autoload.php");
$oController = new ControllerCODIGOACESSO();

$oCODIGOACESSO = ($_REQUEST[''] == "") ? NULL        : $oController->get($_REQUEST['']);
$label   = (is_null($oCODIGOACESSO)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oCODIGOACESSO)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerPESSOA = new ControllerPESSOA();$aPESSOA = $oControllerPESSOA->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <div class="container">
        <?php 
        require_once("includes/titulo.php"); 
        require_once("includes/menu.php"); 
        ?>
        <ol class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li><a href="admCODIGOACESSO.php">CODIGOACESSO</a></li>
            <li class="active"><?=$label?></li>
        </ol>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
            <div class="row">
            	<div class="col-md-4">
	<div class="form-group">
		<label for="codigo">Codigo</label>
		<input type="text" class="form-control" id="codigo" name="codigo" value="<?=$oCODIGOACESSO->codigo?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="PESSOA_id">PESSOA</label>
		<select name="PESSOA_id" id="PESSOA_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aPESSOA as $oPESSOA){
		?>
			<option value="<?=$oPESSOA->PESSOA_id?>"<?=($oPESSOA->PESSOA_id == $oCODIGOACESSO->oPESSOA->id) ? " selected" : ""?>><?=$oPESSOA->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admCODIGOACESSO.php">Voltar</a>
                        
                        <input type="hidden" name="classe" id="classe" value="CODIGOACESSO" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
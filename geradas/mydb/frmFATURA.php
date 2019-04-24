<?php
require_once("classes/autoload.php");
$oController = new ControllerFATURA();

$oFATURA = ($_REQUEST[''] == "") ? NULL        : $oController->get($_REQUEST['']);
$label   = (is_null($oFATURA)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oFATURA)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerCLIENTE = new ControllerCLIENTE();$aCLIENTE = $oControllerCLIENTE->getAll([], []);
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
            <li><a href="admFATURA.php">FATURA</a></li>
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
	    <label for="valor">valor</label>
	    <div class="input-group">
	        <span class="input-group-addon">R$</span>
	        <input type="text" class="form-control money" name="valor" id="valor" value="<?=$oFATURA->valor?>" />
	    </div>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="vencimento">Vencimento</label>
	    <?php $oController->componenteCalendario('vencimento', Util::formataDataBancoForm($oFATURA->vencimento), NULL, false)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="pagamento">Pagamento</label>
	    <?php $oController->componenteCalendario('pagamento', Util::formataDataBancoForm($oFATURA->pagamento), NULL, false)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="CLIENTE_id">CLIENTE</label>
		<select name="CLIENTE_id" id="CLIENTE_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aCLIENTE as $oCLIENTE){
		?>
			<option value="<?=$oCLIENTE->CLIENTE_id?>"<?=($oCLIENTE->CLIENTE_id == $oFATURA->oCLIENTE->id) ? " selected" : ""?>><?=$oCLIENTE->id?></option>
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
                        <a class="btn btn-default" href="admFATURA.php">Voltar</a>
                        
                        <input type="hidden" name="classe" id="classe" value="FATURA" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
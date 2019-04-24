<?php
require_once("classes/autoload.php");
$oController = new ControllerDATA();

$oDATA = ($_REQUEST[''] == "") ? NULL        : $oController->get($_REQUEST['']);
$label   = (is_null($oDATA)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oDATA)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerPERFILACESSO = new ControllerPERFILACESSO();$aPERFILACESSO = $oControllerPERFILACESSO->getAll([], []);
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
            <li><a href="admDATA.php">DATA</a></li>
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
	    <label for="data_inicio">Data_inicio</label>
	    <?php $oController->componenteCalendario('data_inicio', Util::formataDataBancoForm($oDATA->data_inicio), NULL, false)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="data_fim">Data_fim</label>
	    <?php $oController->componenteCalendario('data_fim', Util::formataDataBancoForm($oDATA->data_fim), NULL, false)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="PERFIL_ACESSO_id">PERFILACESSO</label>
		<select name="PERFIL_ACESSO_id" id="PERFIL_ACESSO_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aPERFILACESSO as $oPERFILACESSO){
		?>
			<option value="<?=$oPERFILACESSO->PERFIL_ACESSO_id?>"<?=($oPERFILACESSO->PERFIL_ACESSO_id == $oDATA->oPERFILACESSO->id) ? " selected" : ""?>><?=$oPERFILACESSO->nome?></option>
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
                        <a class="btn btn-default" href="admDATA.php">Voltar</a>
                        
                        <input type="hidden" name="classe" id="classe" value="DATA" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
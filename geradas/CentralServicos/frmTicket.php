<?php
require_once("classes/autoload.php");
$oController = new ControllerTicket();

$oTicket = ($_REQUEST['idTicket'] == "") ? NULL        : $oController->get($_REQUEST['idTicket']);
$label   = (is_null($oTicket)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oTicket)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerServico = new ControllerServico();$aServico = $oControllerServico->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
    <div id="wrap">
        <?php require_once("includes/menu.php");?>
        <div class="container">
            <?php require_once("includes/titulo.php"); ?>
            <ul class="breadcrumb">
                <li><a href="home.php">Home</a> <span class="divider">/</span></li>
                <li><a href="admTicket.php">Ticket</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

<label for="idServico">Servico</label>
<select name="idServico" id="idServico" class="input-xlarge">
    <option value="">Selecione</option>
<?php
foreach($aServico as $oServico){
?>
    <option value="<?=$oServico->idServico?>"<?=($oServico->idServico == $oTicket->oServico->idServico) ? " selected" : ""?>><?=$oServico->descricao?></option>
<?php
}
?>
</select>
<label for="cd_servidor_solicitante">Cd_servidor_solicitante</label>
<input type="text" class="input-xlarge" id="cd_servidor_solicitante" name="cd_servidor_solicitante" value="<?=$oTicket->cd_servidor_solicitante?>" />
<label for="cd_servidor_recebimento">Cd_servidor_recebimento</label>
<input type="text" class="input-xlarge" id="cd_servidor_recebimento" name="cd_servidor_recebimento" value="<?=$oTicket->cd_servidor_recebimento?>" />
<label for="numero">Numero</label>
<input type="text" class="input-xlarge" id="numero" name="numero" value="<?=$oTicket->numero?>" />
<label for="descricao">Descricao</label>
<textarea name="descricao" class="input-xlarge" id="descricao" cols="80" rows="10"><?=$oTicket->descricao?></textarea>
<div class="form-group">
    <label for="dataHoraAbertura">DataHoraAbertura</label>
    <?php $oController->componenteCalendario('dataHoraAbertura', Util::formataDataHoraBancoForm($oTicket->dataHoraAbertura), NULL, true)?>
</div>
<label for="flagAprovado">FlagAprovado</label>
<input type="text" class="input-xlarge" id="flagAprovado" name="flagAprovado" value="<?=$oTicket->flagAprovado?>" />
<label for="flagAtendido">FlagAtendido</label>
<input type="text" class="input-xlarge" id="flagAtendido" name="flagAtendido" value="<?=$oTicket->flagAtendido?>" />
<label for="flagExecutado">FlagExecutado</label>
<input type="text" class="input-xlarge" id="flagExecutado" name="flagExecutado" value="<?=$oTicket->flagExecutado?>" />
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oTicket->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admTicket.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="Ticket" />
                        <input name="idTicket" type="hidden" id="idTicket" value="<?=$_REQUEST['idTicket']?>" />
                    </div>
                </fieldset>
            </form>
        </div>
        <div id="push"></div>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php")?>
</body>
</html>
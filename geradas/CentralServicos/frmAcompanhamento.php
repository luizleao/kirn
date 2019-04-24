<?php
require_once("classes/autoload.php");
$oController = new ControllerAcompanhamento();

$oAcompanhamento = ($_REQUEST['idAcompanhamento'] == "") ? NULL        : $oController->get($_REQUEST['idAcompanhamento']);
$label   = (is_null($oAcompanhamento)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oAcompanhamento)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerTicket = new ControllerTicket();$aTicket = $oControllerTicket->getAll([], []);
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
                <li><a href="admAcompanhamento.php">Acompanhamento</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

<label for="idTicket">Ticket</label>
<select name="idTicket" id="idTicket" class="input-xlarge">
    <option value="">Selecione</option>
<?php
foreach($aTicket as $oTicket){
?>
    <option value="<?=$oTicket->idTicket?>"<?=($oTicket->idTicket == $oAcompanhamento->oTicket->idTicket) ? " selected" : ""?>><?=$oTicket->idTicket?></option>
<?php
}
?>
</select>
<label for="descricao">Descricao</label>
<input type="text" class="input-xlarge" id="descricao" name="descricao" value="<?=$oAcompanhamento->descricao?>" />
<div class="form-group">
    <label for="dataHora">DataHora</label>
    <?php $oController->componenteCalendario('dataHora', Util::formataDataHoraBancoForm($oAcompanhamento->dataHora), NULL, true)?>
</div>
<label for="usuario">Usuario</label>
<input type="text" class="input-xlarge" id="usuario" name="usuario" value="<?=$oAcompanhamento->usuario?>" />
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oAcompanhamento->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admAcompanhamento.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="Acompanhamento" />
                        <input name="idAcompanhamento" type="hidden" id="idAcompanhamento" value="<?=$_REQUEST['idAcompanhamento']?>" />
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
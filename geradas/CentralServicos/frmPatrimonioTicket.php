<?php
require_once("classes/autoload.php");
$oController = new ControllerPatrimonioTicket();

$oPatrimonioTicket = ($_REQUEST['idPatrimonioTicket'] == "") ? NULL        : $oController->get($_REQUEST['idPatrimonioTicket']);
$label   = (is_null($oPatrimonioTicket)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPatrimonioTicket)) ? ($oController->alterar()) : ($oController->cadastrar());
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
                <li><a href="admPatrimonioTicket.php">PatrimonioTicket</a> <span class="divider">/</span></li>
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
    <option value="<?=$oTicket->idTicket?>"<?=($oTicket->idTicket == $oPatrimonioTicket->oTicket->idTicket) ? " selected" : ""?>><?=$oTicket->idTicket?></option>
<?php
}
?>
</select>
<label for="tombamento">Tombamento</label>
<input type="text" class="input-xlarge" id="tombamento" name="tombamento" value="<?=$oPatrimonioTicket->tombamento?>" />
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oPatrimonioTicket->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admPatrimonioTicket.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="PatrimonioTicket" />
                        <input name="idPatrimonioTicket" type="hidden" id="idPatrimonioTicket" value="<?=$_REQUEST['idPatrimonioTicket']?>" />
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
<?php
require_once("classes/autoload.php");
$oController = new ControllerPrestador();

$oPrestador = ($_REQUEST['idPrestador'] == "") ? NULL        : $oController->get($_REQUEST['idPrestador']);
$label   = (is_null($oPrestador)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPrestador)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerNaturezaContratual = new ControllerNaturezaContratual();$aNaturezaContratual = $oControllerNaturezaContratual->getAll([], []);
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
                <li><a href="admPrestador.php">Prestador</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

<label for="idNaturezaContratual">NaturezaContratual</label>
<select name="idNaturezaContratual" id="idNaturezaContratual" class="input-xlarge">
    <option value="">Selecione</option>
<?php
foreach($aNaturezaContratual as $oNaturezaContratual){
?>
    <option value="<?=$oNaturezaContratual->idNaturezaContratual?>"<?=($oNaturezaContratual->idNaturezaContratual == $oPrestador->oNaturezaContratual->idNaturezaContratual) ? " selected" : ""?>><?=$oNaturezaContratual->descricao?></option>
<?php
}
?>
</select>
<label for="nome">Nome</label>
<input type="text" class="input-xlarge" id="nome" name="nome" value="<?=$oPrestador->nome?>" />
<label for="numeroContrato">NumeroContrato</label>
<input type="text" class="input-xlarge" id="numeroContrato" name="numeroContrato" value="<?=$oPrestador->numeroContrato?>" />
<label for="nomePreposto">NomePreposto</label>
<input type="text" class="input-xlarge" id="nomePreposto" name="nomePreposto" value="<?=$oPrestador->nomePreposto?>" />
<label for="contatoPreposto">ContatoPreposto</label>
<input type="text" class="input-xlarge" id="contatoPreposto" name="contatoPreposto" value="<?=$oPrestador->contatoPreposto?>" />
<label for="usuario">Usuario</label>
<input type="text" class="input-xlarge" id="usuario" name="usuario" value="<?=$oPrestador->usuario?>" />
<label for="senha">Senha</label>
<input type="password" class="input-xlarge" id="senha" name="senha" value="<?=$oPrestador->senha?>" />
<label class="control-label" for="email">email</label>
<div class="controls">
    <div class="input-prepend">
        <span class="add-on"><i class="icon-envelope"></i></span>
        <input type="email" class="input-xlarge" name="email" id="email" value="<?=$oPrestador->email?>" />
    </div>
</div>
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oPrestador->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admPrestador.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="Prestador" />
                        <input name="idPrestador" type="hidden" id="idPrestador" value="<?=$_REQUEST['idPrestador']?>" />
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
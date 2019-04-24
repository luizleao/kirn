<?php
require_once("classes/autoload.php");
$oController = new ControllerPESSOA();

$oPESSOA = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oPESSOA)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPESSOA)) ? ($oController->alterar()) : ($oController->cadastrar());
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
            <li><a href="admPESSOA.php">PESSOA</a></li>
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
		<label for="nome">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$oPESSOA->nome?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="cpf">Cpf</label>
		<input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?=$oPESSOA->cpf?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="nascimento">Nascimento</label>
	    <?php $oController->componenteCalendario('nascimento', Util::formataDataBancoForm($oPESSOA->nascimento), NULL, false)?>
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
			<option value="<?=$oPERFILACESSO->PERFIL_ACESSO_id?>"<?=($oPERFILACESSO->PERFIL_ACESSO_id == $oPESSOA->oPERFILACESSO->id) ? " selected" : ""?>><?=$oPERFILACESSO->nome?></option>
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
                        <a class="btn btn-default" href="admPESSOA.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="PESSOA" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
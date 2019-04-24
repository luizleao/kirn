<?php
require_once("classes/autoload.php");
$oController = new ControllerEstado();

$oEstado = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oEstado)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oEstado)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerPais = new ControllerPais();$aPais = $oControllerPais->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="EstadoController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admEstado.php">Estado</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?=$label?></li>
			</ol>
		</nav>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                
<div class="col-md-4">
	<div class="form-group">
		<label for="nome">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$oEstado->nome?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="uf">Uf</label>
		<input type="text" class="form-control" id="uf" name="uf" value="<?=$oEstado->uf?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="pais_id">Pais</label>
		<select name="pais_id" id="pais_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aPais as $oPais){
		?>
			<option value="<?=$oPais->pais_id?>"<?=($oPais->pais_id == $oEstado->oPais->id) ? " selected" : ""?>><?=$oPais->nome?></option>
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
                        <a class="btn btn-default" href="admEstado.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Estado" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
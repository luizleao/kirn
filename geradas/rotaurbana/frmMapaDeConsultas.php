<?php
require_once("classes/autoload.php");
$oController = new ControllerMapaDeConsultas();

$oMapaDeConsultas = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oMapaDeConsultas)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oMapaDeConsultas)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerCidade = new ControllerCidade();$aCidade = $oControllerCidade->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="MapaDeConsultasController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admMapaDeConsultas.php">MapaDeConsultas</a></li>
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
		<label for="latDestino">LatDestino</label>
		<input type="text" class="form-control" id="latDestino" name="latDestino" value="<?=$oMapaDeConsultas->latDestino?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="latOrigem">LatOrigem</label>
		<input type="text" class="form-control" id="latOrigem" name="latOrigem" value="<?=$oMapaDeConsultas->latOrigem?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="lngDestino">LngDestino</label>
		<input type="text" class="form-control" id="lngDestino" name="lngDestino" value="<?=$oMapaDeConsultas->lngDestino?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="lngOrigem">LngOrigem</label>
		<input type="text" class="form-control" id="lngOrigem" name="lngOrigem" value="<?=$oMapaDeConsultas->lngOrigem?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="dataBusca">DataBusca</label>
	    <?php $oController->componenteCalendario('dataBusca', Util::formataDataHoraBancoForm($oMapaDeConsultas->dataBusca), NULL, true)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="cidade_id">Cidade</label>
		<select name="cidade_id" id="cidade_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aCidade as $oCidade){
		?>
			<option value="<?=$oCidade->cidade_id?>"<?=($oCidade->cidade_id == $oMapaDeConsultas->oCidade->id) ? " selected" : ""?>><?=$oCidade->nome?></option>
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
                        <a class="btn btn-default" href="admMapaDeConsultas.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="MapaDeConsultas" />
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
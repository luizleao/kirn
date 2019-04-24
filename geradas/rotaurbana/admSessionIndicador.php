<?php
require_once("classes/autoload.php");
$oController = new ControllerSessionIndicador();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['indicadores_id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aSessionIndicador = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["session_indicador.indicadores_id"], $_REQUEST['pag']);
//Util::trace($aSessionIndicador);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="SessionIndicadorController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar SessionIndicador</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar SessionIndicador" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmSessionIndicador.php" class="btn btn-success" title="Cadastrar SessionIndicador"><i class="icon ion-ios-add"></i></a>
						</span>
					</div>
				</form>
			</div>
		</div>
<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="table table-sm table-striped">
<?php
if($aSessionIndicador){
?>	
			<thead>
				<tr>
					<th>Session</th>
					<th>Indicadores_id</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aSessionIndicador as $oSessionIndicador){
?>
				<tr>
					<td><?=$oSessionIndicador->oSession->id?></td>
					<td><?=$oSessionIndicador->indicadores_id?></td>
					<td><a id="btnDetalhes" data-id="<?=$oSessionIndicador->indicadores_id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes SessionIndicador"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmSessionIndicador.php?indicadores_id=<?=$oSessionIndicador->indicadores_id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="indicadores_id" data-id-valor="<?=$oSessionIndicador->indicadores_id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
				</tr>
<?php
	}
?>
			</tbody>
<?php 
} 
?>
		</table>
<?php
if(!$aSessionIndicador){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="SessionIndicador" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
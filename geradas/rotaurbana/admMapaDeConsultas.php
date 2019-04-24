<?php
require_once("classes/autoload.php");
$oController = new ControllerMapaDeConsultas();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aMapaDeConsultas = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["mapa_de_consultas.id"], $_REQUEST['pag']);
//Util::trace($aMapaDeConsultas);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="MapaDeConsultasController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar MapaDeConsultas</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar MapaDeConsultas" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmMapaDeConsultas.php" class="btn btn-success" title="Cadastrar MapaDeConsultas"><i class="icon ion-ios-add"></i></a>
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
if($aMapaDeConsultas){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>LatDestino</th>
					<th>LatOrigem</th>
					<th>LngDestino</th>
					<th>LngOrigem</th>
					<th>DataBusca</th>
					<th>Cidade</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aMapaDeConsultas as $oMapaDeConsultas){
?>
				<tr>
					<td><?=$oMapaDeConsultas->id?></td>
					<td><?=$oMapaDeConsultas->latDestino?></td>
					<td><?=$oMapaDeConsultas->latOrigem?></td>
					<td><?=$oMapaDeConsultas->lngDestino?></td>
					<td><?=$oMapaDeConsultas->lngOrigem?></td>
					<td><?=Util::formataDataHoraBancoForm($oMapaDeConsultas->dataBusca)?></td>
					<td><?=$oMapaDeConsultas->oCidade->nome?></td>
					<td><a id="btnDetalhes" data-id="<?=$oMapaDeConsultas->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes MapaDeConsultas"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmMapaDeConsultas.php?id=<?=$oMapaDeConsultas->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oMapaDeConsultas->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aMapaDeConsultas){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="MapaDeConsultas" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
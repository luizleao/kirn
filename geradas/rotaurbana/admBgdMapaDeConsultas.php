<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdMapaDeConsultas();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aBgdMapaDeConsultas = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["bgd_mapa_de_consultas.id"], $_REQUEST['pag']);
//Util::trace($aBgdMapaDeConsultas);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="BgdMapaDeConsultasController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar BgdMapaDeConsultas</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar BgdMapaDeConsultas" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmBgdMapaDeConsultas.php" class="btn btn-success" title="Cadastrar BgdMapaDeConsultas"><i class="icon ion-ios-add"></i></a>
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
if($aBgdMapaDeConsultas){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Data_captura</th>
					<th>LatDestino</th>
					<th>LatOrigem</th>
					<th>LngDestino</th>
					<th>LngOrigem</th>
					<th>BgdCidade</th>
					<th>BgdCidade</th>
					<th>Lat_proxma_usuario</th>
					<th>Lng_proxma_usuario</th>
					<th>Fonte</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aBgdMapaDeConsultas as $oBgdMapaDeConsultas){
?>
				<tr>
					<td><?=$oBgdMapaDeConsultas->id?></td>
					<td><?=Util::formataDataHoraBancoForm($oBgdMapaDeConsultas->data_captura)?></td>
					<td><?=$oBgdMapaDeConsultas->latDestino?></td>
					<td><?=$oBgdMapaDeConsultas->latOrigem?></td>
					<td><?=$oBgdMapaDeConsultas->lngDestino?></td>
					<td><?=$oBgdMapaDeConsultas->lngOrigem?></td>
					<td><?=$oBgdMapaDeConsultas->oBgdCidade->nome?></td>
					<td><?=$oBgdMapaDeConsultas->oBgdCidade->nome?></td>
					<td><?=$oBgdMapaDeConsultas->lat_proxma_usuario?></td>
					<td><?=$oBgdMapaDeConsultas->lng_proxma_usuario?></td>
					<td><?=$oBgdMapaDeConsultas->fonte?></td>
					<td><a id="btnDetalhes" data-id="<?=$oBgdMapaDeConsultas->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes BgdMapaDeConsultas"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmBgdMapaDeConsultas.php?id=<?=$oBgdMapaDeConsultas->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oBgdMapaDeConsultas->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aBgdMapaDeConsultas){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="BgdMapaDeConsultas" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
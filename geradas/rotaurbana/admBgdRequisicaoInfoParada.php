<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdRequisicaoInfoParada();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aBgdRequisicaoInfoParada = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["bgd_requisicao_info_parada.id"], $_REQUEST['pag']);
//Util::trace($aBgdRequisicaoInfoParada);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="BgdRequisicaoInfoParadaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar BgdRequisicaoInfoParada</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar BgdRequisicaoInfoParada" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmBgdRequisicaoInfoParada.php" class="btn btn-success" title="Cadastrar BgdRequisicaoInfoParada"><i class="icon ion-ios-add"></i></a>
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
if($aBgdRequisicaoInfoParada){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>CommentsParada</th>
					<th>Data_captura</th>
					<th>TitleParada</th>
					<th>BgdCidade</th>
					<th>BgdCidade</th>
					<th>BgdParada</th>
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
	foreach($aBgdRequisicaoInfoParada as $oBgdRequisicaoInfoParada){
?>
				<tr>
					<td><?=$oBgdRequisicaoInfoParada->id?></td>
					<td><?=$oBgdRequisicaoInfoParada->commentsParada?></td>
					<td><?=Util::formataDataHoraBancoForm($oBgdRequisicaoInfoParada->data_captura)?></td>
					<td><?=$oBgdRequisicaoInfoParada->titleParada?></td>
					<td><?=$oBgdRequisicaoInfoParada->oBgdCidade->nome?></td>
					<td><?=$oBgdRequisicaoInfoParada->oBgdCidade->nome?></td>
					<td><?=$oBgdRequisicaoInfoParada->oBgdParada->id?></td>
					<td><?=$oBgdRequisicaoInfoParada->lat_proxma_usuario?></td>
					<td><?=$oBgdRequisicaoInfoParada->lng_proxma_usuario?></td>
					<td><?=$oBgdRequisicaoInfoParada->fonte?></td>
					<td><a id="btnDetalhes" data-id="<?=$oBgdRequisicaoInfoParada->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes BgdRequisicaoInfoParada"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmBgdRequisicaoInfoParada.php?id=<?=$oBgdRequisicaoInfoParada->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oBgdRequisicaoInfoParada->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aBgdRequisicaoInfoParada){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="BgdRequisicaoInfoParada" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
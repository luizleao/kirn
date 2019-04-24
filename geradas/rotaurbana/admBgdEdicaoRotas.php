<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdEdicaoRotas();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aBgdEdicaoRotas = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["bgd_edicao_rotas.id"], $_REQUEST['pag']);
//Util::trace($aBgdEdicaoRotas);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="BgdEdicaoRotasController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar BgdEdicaoRotas</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar BgdEdicaoRotas" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmBgdEdicaoRotas.php" class="btn btn-success" title="Cadastrar BgdEdicaoRotas"><i class="icon ion-ios-add"></i></a>
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
if($aBgdEdicaoRotas){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>CodigoLinha</th>
					<th>ComentarioLinha</th>
					<th>Data_captura</th>
					<th>NomeLinhas</th>
					<th>BgdCidade</th>
					<th>BgdCidade</th>
					<th>BgdLinha</th>
					<th>BgdUsuario</th>
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
	foreach($aBgdEdicaoRotas as $oBgdEdicaoRotas){
?>
				<tr>
					<td><?=$oBgdEdicaoRotas->id?></td>
					<td><?=$oBgdEdicaoRotas->codigoLinha?></td>
					<td><?=$oBgdEdicaoRotas->comentarioLinha?></td>
					<td><?=Util::formataDataHoraBancoForm($oBgdEdicaoRotas->data_captura)?></td>
					<td><?=$oBgdEdicaoRotas->nomeLinhas?></td>
					<td><?=$oBgdEdicaoRotas->oBgdCidade->nome?></td>
					<td><?=$oBgdEdicaoRotas->oBgdCidade->nome?></td>
					<td><?=$oBgdEdicaoRotas->oBgdLinha->nome?></td>
					<td><?=$oBgdEdicaoRotas->oBgdUsuario->email?></td>
					<td><?=$oBgdEdicaoRotas->lat_proxma_usuario?></td>
					<td><?=$oBgdEdicaoRotas->lng_proxma_usuario?></td>
					<td><?=$oBgdEdicaoRotas->fonte?></td>
					<td><a id="btnDetalhes" data-id="<?=$oBgdEdicaoRotas->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes BgdEdicaoRotas"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmBgdEdicaoRotas.php?id=<?=$oBgdEdicaoRotas->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oBgdEdicaoRotas->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aBgdEdicaoRotas){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="BgdEdicaoRotas" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
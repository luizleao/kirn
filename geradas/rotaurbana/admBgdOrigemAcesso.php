<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdOrigemAcesso();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aBgdOrigemAcesso = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["bgd_origem_acesso.id"], $_REQUEST['pag']);
//Util::trace($aBgdOrigemAcesso);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="BgdOrigemAcessoController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar BgdOrigemAcesso</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar BgdOrigemAcesso" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmBgdOrigemAcesso.php" class="btn btn-success" title="Cadastrar BgdOrigemAcesso"><i class="icon ion-ios-add"></i></a>
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
if($aBgdOrigemAcesso){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Data_captura</th>
					<th>Lat_proxma_usuario</th>
					<th>Lng_proxma_usuario</th>
					<th>Origem_acesso</th>
					<th>BgdCidade</th>
					<th>Fonte</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aBgdOrigemAcesso as $oBgdOrigemAcesso){
?>
				<tr>
					<td><?=$oBgdOrigemAcesso->id?></td>
					<td><?=Util::formataDataHoraBancoForm($oBgdOrigemAcesso->data_captura)?></td>
					<td><?=$oBgdOrigemAcesso->lat_proxma_usuario?></td>
					<td><?=$oBgdOrigemAcesso->lng_proxma_usuario?></td>
					<td><?=$oBgdOrigemAcesso->origem_acesso?></td>
					<td><?=$oBgdOrigemAcesso->oBgdCidade->nome?></td>
					<td><?=$oBgdOrigemAcesso->fonte?></td>
					<td><a id="btnDetalhes" data-id="<?=$oBgdOrigemAcesso->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes BgdOrigemAcesso"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmBgdOrigemAcesso.php?id=<?=$oBgdOrigemAcesso->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oBgdOrigemAcesso->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aBgdOrigemAcesso){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="BgdOrigemAcesso" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
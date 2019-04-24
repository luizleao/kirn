<?php
require_once("classes/autoload.php");
$oController = new ControllerPontopesquisa();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aPontopesquisa = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["pontopesquisa.id"], $_REQUEST['pag']);
//Util::trace($aPontopesquisa);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="PontopesquisaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar Pontopesquisa</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar Pontopesquisa" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmPontopesquisa.php" class="btn btn-success" title="Cadastrar Pontopesquisa"><i class="icon ion-ios-add"></i></a>
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
if($aPontopesquisa){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>Posicao</th>
					<th>Tipo</th>
					<th>Linha</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aPontopesquisa as $oPontopesquisa){
?>
				<tr>
					<td><?=$oPontopesquisa->id?></td>
					<td><?=$oPontopesquisa->latitude?></td>
					<td><?=$oPontopesquisa->longitude?></td>
					<td><?=$oPontopesquisa->posicao?></td>
					<td><?=$oPontopesquisa->tipo?></td>
					<td><?=$oPontopesquisa->oLinha->nome?></td>
					<td><a id="btnDetalhes" data-id="<?=$oPontopesquisa->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes Pontopesquisa"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmPontopesquisa.php?id=<?=$oPontopesquisa->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oPontopesquisa->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aPontopesquisa){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="Pontopesquisa" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerCidade();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aCidade = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["cidade.id"], $_REQUEST['pag']);
//Util::trace($aCidade);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="CidadeController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar Cidade</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar Cidade" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmCidade.php" class="btn btn-success" title="Cadastrar Cidade"><i class="icon ion-ios-add"></i></a>
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
if($aCidade){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>Nome</th>
					<th>Estado</th>
					<th>Cidade</th>
					<th>SameAs</th>
					<th>LatitudeDouble</th>
					<th>LongitudeDouble</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aCidade as $oCidade){
?>
				<tr>
					<td><?=$oCidade->id?></td>
					<td><?=$oCidade->latitude?></td>
					<td><?=$oCidade->longitude?></td>
					<td><?=$oCidade->nome?></td>
					<td><?=$oCidade->oEstado->nome?></td>
					<td><?=$oCidade->oCidade->nome?></td>
					<td><?=$oCidade->sameAs?></td>
					<td><?=$oCidade->latitudeDouble?></td>
					<td><?=$oCidade->longitudeDouble?></td>
					<td><a id="btnDetalhes" data-id="<?=$oCidade->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes Cidade"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmCidade.php?id=<?=$oCidade->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oCidade->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aCidade){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="Cidade" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
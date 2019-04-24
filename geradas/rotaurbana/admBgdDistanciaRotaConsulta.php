<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdDistanciaRotaConsulta();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aBgdDistanciaRotaConsulta = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["bgd_distancia_rota_consulta.id"], $_REQUEST['pag']);
//Util::trace($aBgdDistanciaRotaConsulta);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="BgdDistanciaRotaConsultaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar BgdDistanciaRotaConsulta</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar BgdDistanciaRotaConsulta" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmBgdDistanciaRotaConsulta.php" class="btn btn-success" title="Cadastrar BgdDistanciaRotaConsulta"><i class="icon ion-ios-add"></i></a>
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
if($aBgdDistanciaRotaConsulta){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Data_captura</th>
					<th>Distancia</th>
					<th>BgdCidade</th>
					<th>BgdLinha</th>
					<th>Fonte</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aBgdDistanciaRotaConsulta as $oBgdDistanciaRotaConsulta){
?>
				<tr>
					<td><?=$oBgdDistanciaRotaConsulta->id?></td>
					<td><?=Util::formataDataHoraBancoForm($oBgdDistanciaRotaConsulta->data_captura)?></td>
					<td><?=$oBgdDistanciaRotaConsulta->distancia?></td>
					<td><?=$oBgdDistanciaRotaConsulta->oBgdCidade->nome?></td>
					<td><?=$oBgdDistanciaRotaConsulta->oBgdLinha->nome?></td>
					<td><?=$oBgdDistanciaRotaConsulta->fonte?></td>
					<td><a id="btnDetalhes" data-id="<?=$oBgdDistanciaRotaConsulta->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes BgdDistanciaRotaConsulta"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmBgdDistanciaRotaConsulta.php?id=<?=$oBgdDistanciaRotaConsulta->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oBgdDistanciaRotaConsulta->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aBgdDistanciaRotaConsulta){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="BgdDistanciaRotaConsulta" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
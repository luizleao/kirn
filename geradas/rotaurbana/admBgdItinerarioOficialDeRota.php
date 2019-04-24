<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdItinerarioOficialDeRota();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aBgdItinerarioOficialDeRota = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["bgd_itinerario_oficial_de_rota.id"], $_REQUEST['pag']);
//Util::trace($aBgdItinerarioOficialDeRota);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="BgdItinerarioOficialDeRotaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar BgdItinerarioOficialDeRota</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar BgdItinerarioOficialDeRota" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmBgdItinerarioOficialDeRota.php" class="btn btn-success" title="Cadastrar BgdItinerarioOficialDeRota"><i class="icon ion-ios-add"></i></a>
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
if($aBgdItinerarioOficialDeRota){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Data_captura</th>
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
	foreach($aBgdItinerarioOficialDeRota as $oBgdItinerarioOficialDeRota){
?>
				<tr>
					<td><?=$oBgdItinerarioOficialDeRota->id?></td>
					<td><?=Util::formataDataHoraBancoForm($oBgdItinerarioOficialDeRota->data_captura)?></td>
					<td><?=$oBgdItinerarioOficialDeRota->oBgdCidade->nome?></td>
					<td><?=$oBgdItinerarioOficialDeRota->oBgdCidade->nome?></td>
					<td><?=$oBgdItinerarioOficialDeRota->oBgdLinha->nome?></td>
					<td><?=$oBgdItinerarioOficialDeRota->oBgdUsuario->email?></td>
					<td><?=$oBgdItinerarioOficialDeRota->lat_proxma_usuario?></td>
					<td><?=$oBgdItinerarioOficialDeRota->lng_proxma_usuario?></td>
					<td><?=$oBgdItinerarioOficialDeRota->fonte?></td>
					<td><a id="btnDetalhes" data-id="<?=$oBgdItinerarioOficialDeRota->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes BgdItinerarioOficialDeRota"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmBgdItinerarioOficialDeRota.php?id=<?=$oBgdItinerarioOficialDeRota->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oBgdItinerarioOficialDeRota->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aBgdItinerarioOficialDeRota){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="BgdItinerarioOficialDeRota" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
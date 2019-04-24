<?php
require_once("classes/autoload.php");
$oController = new ControllerLinha();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aLinha = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["linha.id"], $_REQUEST['pag']);
//Util::trace($aLinha);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="LinhaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar Linha</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar Linha" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmLinha.php" class="btn btn-success" title="Cadastrar Linha"><i class="icon ion-ios-add"></i></a>
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
if($aLinha){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Codigo</th>
					<th>EmAvaliacao</th>
					<th>Nome</th>
					<th>Usuario</th>
					<th>SincronizacaoCodigo</th>
					<th>Tipo</th>
					<th>Comentario</th>
					<th>Completa</th>
					<th>FaltaCadastrarPontosPesquisa</th>
					<th>Url</th>
					<th>Cidade</th>
					<th>TipoDeRota</th>
					<th>ItinerarioTotalEncoding</th>
					<th>LastUpdate</th>
					<th>Semob</th>
					<th>Linha</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aLinha as $oLinha){
?>
				<tr>
					<td><?=$oLinha->id?></td>
					<td><?=$oLinha->codigo?></td>
					<td><?=$oLinha->emAvaliacao?></td>
					<td><?=$oLinha->nome?></td>
					<td><?=$oLinha->oUsuario->email?></td>
					<td><?=$oLinha->sincronizacaoCodigo?></td>
					<td><?=$oLinha->tipo?></td>
					<td><?=$oLinha->comentario?></td>
					<td><?=$oLinha->completa?></td>
					<td><?=$oLinha->faltaCadastrarPontosPesquisa?></td>
					<td><?=$oLinha->url?></td>
					<td><?=$oLinha->oCidade->nome?></td>
					<td><?=$oLinha->tipoDeRota?></td>
					<td><?=$oLinha->itinerarioTotalEncoding?></td>
					<td><?=Util::formataDataHoraBancoForm($oLinha->lastUpdate)?></td>
					<td><?=$oLinha->semob?></td>
					<td><?=$oLinha->oLinha->nome?></td>
					<td><a id="btnDetalhes" data-id="<?=$oLinha->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes Linha"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmLinha.php?id=<?=$oLinha->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oLinha->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aLinha){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="Linha" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerPlantao();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['p_id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aPlantao = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["plantao.p_id"], $_REQUEST['pag']);
//Util::trace($aPlantao);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php include_once("includes/menu.php");?>
	<?php include_once("includes/loading.php");?>
	<main class="container light">
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> Plantao <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar Plantao" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aPlantao){
?>	
			<thead>
				<tr>
					<th>P_id</th>
					<th>Usuario</th>
					<th>Sensor</th>
					<th>Datai</th>
					<th>Dataf</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aPlantao as $oPlantao){
?>
				<tr>
					<td><?=$oPlantao->p_id?></td>
					<td><?=$oPlantao->oUsuario->nome?></td>
					<td><?=$oPlantao->oSensor->id_sensor?></td>
					<td><?=Util::formataDataHoraBancoForm($oPlantao->datai)?></td>
					<td><?=Util::formataDataHoraBancoForm($oPlantao->dataf)?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oPlantao->p_id;?>" data-position="top" data-tooltip="Detalhes Plantao"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmPlantao.php?p_id=<?=$oPlantao->p_id;?>" data-position="top" data-tooltip="Editar Plantao"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="p_id" data-id-valor="<?=$oPlantao->p_id;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir Plantao"><i class="material-icons">delete</i></a></td>
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="8">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
			</tbody>	
<?php
}
?>
		</table>
<?php
if(!$aPlantao){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmPlantao.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="Plantao" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
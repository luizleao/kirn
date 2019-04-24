<?php
require_once("classes/autoload.php");
$oController = new ControllerSensor();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id_sensor'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aSensor = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["sensor.id_sensor"], $_REQUEST['pag']);
//Util::trace($aSensor);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> Sensor <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar Sensor" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aSensor){
?>	
			<thead>
				<tr>
					<th>Id_</th>
					<th>Localizacao</th>
					<th>Descricao</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aSensor as $oSensor){
?>
				<tr>
					<td><?=$oSensor->id_sensor?></td>
					<td><?=$oSensor->localizacao?></td>
					<td><?=$oSensor->descricao?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oSensor->id_sensor;?>" data-position="top" data-tooltip="Detalhes Sensor"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmSensor.php?id_sensor=<?=$oSensor->id_sensor;?>" data-position="top" data-tooltip="Editar Sensor"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="id_sensor" data-id-valor="<?=$oSensor->id_sensor;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir Sensor"><i class="material-icons">delete</i></a></td>
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="6">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
			</tbody>	
<?php
}
?>
		</table>
<?php
if(!$aSensor){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmSensor.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="Sensor" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
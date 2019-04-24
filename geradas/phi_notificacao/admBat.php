<?php
require_once("classes/autoload.php");
$oController = new ControllerBat();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id_bat'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aBat = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["bat.id_bat"], $_REQUEST['pag']);
//Util::trace($aBat);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> Bat <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar Bat" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aBat){
?>	
			<thead>
				<tr>
					<th>Id_</th>
					<th>Sensor</th>
					<th>Usuario</th>
					<th>Descricao</th>
					<th>Data</th>
					<th>Raiva</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aBat as $oBat){
?>
				<tr>
					<td><?=$oBat->id_bat?></td>
					<td><?=$oBat->oSensor->id_sensor?></td>
					<td><?=$oBat->oUsuario->nome?></td>
					<td><?=$oBat->descricao?></td>
					<td><?=Util::formataDataHoraBancoForm($oBat->data)?></td>
					<td><?=$oBat->raiva?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oBat->id_bat;?>" data-position="top" data-tooltip="Detalhes Bat"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmBat.php?id_bat=<?=$oBat->id_bat;?>" data-position="top" data-tooltip="Editar Bat"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="id_bat" data-id-valor="<?=$oBat->id_bat;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir Bat"><i class="material-icons">delete</i></a></td>
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="9">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
			</tbody>	
<?php
}
?>
		</table>
<?php
if(!$aBat){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmBat.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="Bat" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
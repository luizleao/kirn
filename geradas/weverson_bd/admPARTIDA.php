<?php
require_once("classes/autoload.php");
$oController = new ControllerPARTIDA();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'], $_REQUEST['idmadante'], $_REQUEST['idvisitante'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aPARTIDA = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["PARTIDA.id"], $_REQUEST['pag']);
//Util::trace($aPARTIDA);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> PARTIDA <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar PARTIDA" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aPARTIDA){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>TIME</th>
					<th>TIME</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aPARTIDA as $oPARTIDA){
?>
				<tr>
					<td><?=$oPARTIDA->id?></td>
					<td><?=$oPARTIDA->oTIME->id?></td>
					<td><?=$oPARTIDA->oTIME->id?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oPARTIDA->oTIME->id;?>" data-position="top" data-tooltip="Detalhes PARTIDA"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmPARTIDA.php?id=<?=$oPARTIDA->oTIME->id;?>" data-position="top" data-tooltip="Editar PARTIDA"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oPARTIDA->oTIME->id;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir PARTIDA"><i class="material-icons">delete</i></a></td>
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
if(!$aPARTIDA){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmPARTIDA.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="PARTIDA" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerTIME();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aTIME = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["TIME.id"], $_REQUEST['pag']);
//Util::trace($aTIME);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> TIME <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar TIME" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aTIME){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Pais</th>
					<th>Tecnico</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aTIME as $oTIME){
?>
				<tr>
					<td><?=$oTIME->id?></td>
					<td><?=$oTIME->pais?></td>
					<td><?=$oTIME->tecnico?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oTIME->id;?>" data-position="top" data-tooltip="Detalhes TIME"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmTIME.php?id=<?=$oTIME->id;?>" data-position="top" data-tooltip="Editar TIME"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oTIME->id;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir TIME"><i class="material-icons">delete</i></a></td>
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
if(!$aTIME){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmTIME.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="TIME" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
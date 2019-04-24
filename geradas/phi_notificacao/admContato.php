<?php
require_once("classes/autoload.php");
$oController = new ControllerContato();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id_tel'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aContato = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["contato.id_tel"], $_REQUEST['pag']);
//Util::trace($aContato);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> Contato <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar Contato" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aContato){
?>	
			<thead>
				<tr>
					<th>Id_tel</th>
					<th>Numero</th>
					<th>Ddd</th>
					<th>Email</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aContato as $oContato){
?>
				<tr>
					<td><?=$oContato->id_tel?></td>
					<td><?=$oContato->numero?></td>
					<td><?=$oContato->ddd?></td>
					<td><?=$oContato->email?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oContato->id_tel;?>" data-position="top" data-tooltip="Detalhes Contato"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmContato.php?id_tel=<?=$oContato->id_tel;?>" data-position="top" data-tooltip="Editar Contato"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="id_tel" data-id-valor="<?=$oContato->id_tel;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir Contato"><i class="material-icons">delete</i></a></td>
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="7">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
			</tbody>	
<?php
}
?>
		</table>
<?php
if(!$aContato){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmContato.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="Contato" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
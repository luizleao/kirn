<?php
require_once("classes/autoload.php");
$oController = new ControllerUsuario();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aUsuario = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["usuario.id"], $_REQUEST['pag']);
//Util::trace($aUsuario);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> Usuario <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar Usuario" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aUsuario){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Nome</th>
					<th>Status</th>
					<th>Contato</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aUsuario as $oUsuario){
?>
				<tr>
					<td><?=$oUsuario->id?></td>
					<td><?=$oUsuario->nome?></td>
					<td><?=$oUsuario->status?></td>
					<td><?=$oUsuario->oContato->email?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oUsuario->id;?>" data-position="top" data-tooltip="Detalhes Usuario"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmUsuario.php?id=<?=$oUsuario->id;?>" data-position="top" data-tooltip="Editar Usuario"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oUsuario->id;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir Usuario"><i class="material-icons">delete</i></a></td>
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
if(!$aUsuario){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmUsuario.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="Usuario" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
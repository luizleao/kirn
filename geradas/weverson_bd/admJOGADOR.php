<?php
require_once("classes/autoload.php");
$oController = new ControllerJOGADOR();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['cpf'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aJOGADOR = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["JOGADOR.cpf"], $_REQUEST['pag']);
//Util::trace($aJOGADOR);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> JOGADOR <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar JOGADOR" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aJOGADOR){
?>	
			<thead>
				<tr>
					<th>Cpf</th>
					<th>Nome</th>
					<th>N_camisa</th>
					<th>Status</th>
					<th>TIME</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aJOGADOR as $oJOGADOR){
?>
				<tr>
					<td><?=$oJOGADOR->cpf?></td>
					<td><?=$oJOGADOR->nome?></td>
					<td><?=$oJOGADOR->n_camisa?></td>
					<td><?=$oJOGADOR->status?></td>
					<td><?=$oJOGADOR->oTIME->id?></td>
					<td><a id="btnDetalhes" class="btn btn-small btn-flat tooltipped" href="#" data-id="<?=$oJOGADOR->cpf;?>" data-position="top" data-tooltip="Detalhes JOGADOR"><i class="material-icons">info_outline</i></a></td>
					<td><a class="btn btn-small btn-flat tooltipped" href="frmJOGADOR.php?cpf=<?=$oJOGADOR->cpf;?>" data-position="top" data-tooltip="Editar JOGADOR"><i class="material-icons">mode_edit</i></a></td>
					<td><a id="btnExcluir" data-id="cpf" data-id-valor="<?=$oJOGADOR->cpf;?>" class="btn btn-small btn-flat tooltipped" href="#" data-position="top" data-tooltip="Excluir JOGADOR"><i class="material-icons">delete</i></a></td>
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
if(!$aJOGADOR){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmJOGADOR.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="JOGADOR" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
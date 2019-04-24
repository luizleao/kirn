<?php
require_once("classes/autoload.php");

$oController = new ControllerPERMISSAO();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aPERMISSAO = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["PERMISSAO.id"], $_REQUEST['pag']);
//Util::trace($aPERMISSAO);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<div class="container">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="home.php">Home</a></li>
			<li class="active">Administrar PERMISSAO</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar PERMISSAO" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmPERMISSAO.php" class="btn btn-success btn-sm" title="Cadastrar PERMISSAO"><i class="glyphicon glyphicon-plus"></i></a>
					</span>
					</div>
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="table table-condensed table-striped">
<?php
if($aPERMISSAO){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Alteracao</th>
					<th>Insercao</th>
					<th>Exclusao</th>
					<th>Visualizacao</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aPERMISSAO as $oPERMISSAO){
?>
				<tr>
					<td><?=$oPERMISSAO->id?></td>
					<td><?=$oPERMISSAO->alteracao?></td>
					<td><?=$oPERMISSAO->insercao?></td>
					<td><?=$oPERMISSAO->exclusao?></td>
					<td><?=$oPERMISSAO->visualizacao?></td>
					<td><a id="btnDetalhes" data-id="<?=$oPERMISSAO->id;?>" class="btn btn-info btn-xs" href="#" title="Detalhes PERMISSAO"><i class="glyphicon glyphicon-search"></i></a></td>
					<td><a class="btn btn-success btn-xs" href="frmPERMISSAO.php?id=<?=$oPERMISSAO->id;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oPERMISSAO->id;?>" class="btn btn-danger btn-xs" href="javascript: void(0);" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="8">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
		
<?php
if(!$aPERMISSAO){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="PERMISSAO" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
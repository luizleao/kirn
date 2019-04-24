<?php
require_once("classes/autoload.php");

$oController = new ControllerENDERECO();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aENDERECO = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["ENDERECO.id"], $_REQUEST['pag']);
//Util::trace($aENDERECO);
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
			<li class="active">Administrar ENDERECO</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar ENDERECO" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmENDERECO.php" class="btn btn-success btn-sm" title="Cadastrar ENDERECO"><i class="glyphicon glyphicon-plus"></i></a>
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
if($aENDERECO){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Rua</th>
					<th>Bairro</th>
					<th>Cep</th>
					<th>Numero</th>
					<th>Complemento</th>
					<th>CIDADE</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aENDERECO as $oENDERECO){
?>
				<tr>
					<td><?=$oENDERECO->id?></td>
					<td><?=$oENDERECO->rua?></td>
					<td><?=$oENDERECO->bairro?></td>
					<td><?=$oENDERECO->cep?></td>
					<td><?=$oENDERECO->numero?></td>
					<td><?=$oENDERECO->complemento?></td>
					<td><?=$oENDERECO->oCIDADE->nome?></td>
					<td><a id="btnDetalhes" data-id="<?=$oENDERECO->id;?>" class="btn btn-info btn-xs" href="#" title="Detalhes ENDERECO"><i class="glyphicon glyphicon-search"></i></a></td>
					<td><a class="btn btn-success btn-xs" href="frmENDERECO.php?id=<?=$oENDERECO->id;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oENDERECO->id;?>" class="btn btn-danger btn-xs" href="javascript: void(0);" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="10">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
		
<?php
if(!$aENDERECO){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="ENDERECO" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
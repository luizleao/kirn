<?php
require_once("classes/autoload.php");

$oController = new ControllerREGISTROACESSO();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aREGISTROACESSO = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["REGISTRO_ACESSO.id"], $_REQUEST['pag']);
//Util::trace($aREGISTROACESSO);
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
			<li class="active">Administrar REGISTROACESSO</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar REGISTROACESSO" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmREGISTROACESSO.php" class="btn btn-success btn-sm" title="Cadastrar REGISTROACESSO"><i class="glyphicon glyphicon-plus"></i></a>
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
if($aREGISTROACESSO){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Data</th>
					<th>Hora</th>
					<th>Sentido</th>
					<th>Permissao</th>
					<th>PESSOA</th>
					<th>PERFILACESSO</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aREGISTROACESSO as $oREGISTROACESSO){
?>
				<tr>
					<td><?=$oREGISTROACESSO->id?></td>
					<td><?=Util::formataDataBancoForm($oREGISTROACESSO->data)?></td>
					<td><?=$oREGISTROACESSO->hora?></td>
					<td><?=$oREGISTROACESSO->sentido?></td>
					<td><?=$oREGISTROACESSO->permissao?></td>
					<td><?=$oREGISTROACESSO->oPESSOA->nome?></td>
					<td><?=$oREGISTROACESSO->oPERFILACESSO->nome?></td>
					<td><a id="btnDetalhes" data-id="<?=$oREGISTROACESSO->id;?>" class="btn btn-info btn-xs" href="#" title="Detalhes REGISTROACESSO"><i class="glyphicon glyphicon-search"></i></a></td>
					<td><a class="btn btn-success btn-xs" href="frmREGISTROACESSO.php?id=<?=$oREGISTROACESSO->id;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oREGISTROACESSO->id;?>" class="btn btn-danger btn-xs" href="javascript: void(0);" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
if(!$aREGISTROACESSO){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="REGISTROACESSO" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
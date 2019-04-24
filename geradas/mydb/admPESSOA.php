<?php
require_once("classes/autoload.php");

$oController = new ControllerPESSOA();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aPESSOA = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["PESSOA.id"], $_REQUEST['pag']);
//Util::trace($aPESSOA);
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
			<li class="active">Administrar PESSOA</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar PESSOA" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmPESSOA.php" class="btn btn-success btn-sm" title="Cadastrar PESSOA"><i class="glyphicon glyphicon-plus"></i></a>
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
if($aPESSOA){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Nome</th>
					<th>Cpf</th>
					<th>Nascimento</th>
					<th>PERFILACESSO</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aPESSOA as $oPESSOA){
?>
				<tr>
					<td><?=$oPESSOA->id?></td>
					<td><?=$oPESSOA->nome?></td>
					<td><?=$oPESSOA->cpf?></td>
					<td><?=Util::formataDataBancoForm($oPESSOA->nascimento)?></td>
					<td><?=$oPESSOA->oPERFILACESSO->nome?></td>
					<td><a id="btnDetalhes" data-id="<?=$oPESSOA->id;?>" class="btn btn-info btn-xs" href="#" title="Detalhes PESSOA"><i class="glyphicon glyphicon-search"></i></a></td>
					<td><a class="btn btn-success btn-xs" href="frmPESSOA.php?id=<?=$oPESSOA->id;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oPESSOA->id;?>" class="btn btn-danger btn-xs" href="javascript: void(0);" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
if(!$aPESSOA){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="PESSOA" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
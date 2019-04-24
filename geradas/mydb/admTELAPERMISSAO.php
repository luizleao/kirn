<?php
require_once("classes/autoload.php");

$oController = new ControllerTELAPERMISSAO();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir()) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aTELAPERMISSAO = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["TELA_PERMISSAO."], $_REQUEST['pag']);
//Util::trace($aTELAPERMISSAO);
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
			<li class="active">Administrar TELAPERMISSAO</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar TELAPERMISSAO" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmTELAPERMISSAO.php" class="btn btn-success btn-sm" title="Cadastrar TELAPERMISSAO"><i class="glyphicon glyphicon-plus"></i></a>
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
if($aTELAPERMISSAO){
?>	
			<thead>
				<tr>
					<th>TELA</th>
					<th>PERMISSAO</th>
					<th>PERFIL</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aTELAPERMISSAO as $oTELAPERMISSAO){
?>
				<tr>
					<td><?=$oTELAPERMISSAO->oTELA->nome?></td>
					<td><?=$oTELAPERMISSAO->oPERMISSAO->id?></td>
					<td><?=$oTELAPERMISSAO->oPERFIL->nome?></td>
					
					
					
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="6">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
		
<?php
if(!$aTELAPERMISSAO){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="TELAPERMISSAO" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
<?php
require_once("classes/autoload.php");

$oController = new ControllerSEMANAATIVA();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir()) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aSEMANAATIVA = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["SEMANA_ATIVA."], $_REQUEST['pag']);
//Util::trace($aSEMANAATIVA);
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
			<li class="active">Administrar SEMANAATIVA</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar SEMANAATIVA" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmSEMANAATIVA.php" class="btn btn-success btn-sm" title="Cadastrar SEMANAATIVA"><i class="glyphicon glyphicon-plus"></i></a>
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
if($aSEMANAATIVA){
?>	
			<thead>
				<tr>
					<th>Semana</th>
					<th>PERFILACESSO</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aSEMANAATIVA as $oSEMANAATIVA){
?>
				<tr>
					<td><?=$oSEMANAATIVA->semana?></td>
					<td><?=$oSEMANAATIVA->oPERFILACESSO->nome?></td>
					
					
					
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="5">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
		
<?php
if(!$aSEMANAATIVA){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="SEMANAATIVA" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
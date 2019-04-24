<?php
require_once("classes/autoload.php");

$oController = new ControllerCODIGOACESSO();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir()) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aCODIGOACESSO = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["CODIGO_ACESSO."], $_REQUEST['pag']);
//Util::trace($aCODIGOACESSO);
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
			<li class="active">Administrar CODIGOACESSO</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar CODIGOACESSO" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmCODIGOACESSO.php" class="btn btn-success btn-sm" title="Cadastrar CODIGOACESSO"><i class="glyphicon glyphicon-plus"></i></a>
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
if($aCODIGOACESSO){
?>	
			<thead>
				<tr>
					<th>Codigo</th>
					<th>PESSOA</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aCODIGOACESSO as $oCODIGOACESSO){
?>
				<tr>
					<td><?=$oCODIGOACESSO->codigo?></td>
					<td><?=$oCODIGOACESSO->oPESSOA->nome?></td>
					
					
					
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
if(!$aCODIGOACESSO){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="CODIGOACESSO" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
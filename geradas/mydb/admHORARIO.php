<?php
require_once("classes/autoload.php");

$oController = new ControllerHORARIO();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir()) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aHORARIO = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["HORARIO."], $_REQUEST['pag']);
//Util::trace($aHORARIO);
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
			<li class="active">Administrar HORARIO</li>
		</ol>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar HORARIO" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="frmHORARIO.php" class="btn btn-success btn-sm" title="Cadastrar HORARIO"><i class="glyphicon glyphicon-plus"></i></a>
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
if($aHORARIO){
?>	
			<thead>
				<tr>
					<th>Horario_inicio</th>
					<th>Horario_fim</th>
					<th>PERFILACESSO</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aHORARIO as $oHORARIO){
?>
				<tr>
					<td><?=$oHORARIO->horario_inicio?></td>
					<td><?=$oHORARIO->horario_fim?></td>
					<td><?=$oHORARIO->oPERFILACESSO->nome?></td>
					
					
					
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
if(!$aHORARIO){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>		
		<input type="hidden" name="classe" id="classe" value="HORARIO" />
	</div>
	<?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>
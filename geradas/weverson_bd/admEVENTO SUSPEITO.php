<?php
require_once("classes/autoload.php");
$oController = new ControllerEVENTO SUSPEITO();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir()) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aEVENTO SUSPEITO = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["EVENTO SUSPEITO."], $_REQUEST['pag']);
//Util::trace($aEVENTO SUSPEITO);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> EVENTO SUSPEITO <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar EVENTO SUSPEITO" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($aEVENTO SUSPEITO){
?>	
			<thead>
				<tr>
					
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aEVENTO SUSPEITO as $oEVENTO SUSPEITO){
?>
				<tr>
					
					
					
					
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="3">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
			</tbody>	
<?php
}
?>
		</table>
<?php
if(!$aEVENTO SUSPEITO){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frmEVENTO SUSPEITO.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="EVENTO SUSPEITO" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
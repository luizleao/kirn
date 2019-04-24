<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir(%%PK_REQUEST%%)) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$a%%NOME_CLASSE%% = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["%%PK%%"], $_REQUEST['pag']);
//Util::trace($a%%NOME_CLASSE%%);
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
		<blockquote class="border"><a href="home.php">Home</a> <i class="material-icons">chevron_right</i> %%NOME_CLASSE%% <i class="material-icons">chevron_right</i> Administrar</blockquote>
		<form action="" method="post">
			<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">search</i>
					<input name="txtConsulta" class="" id="txtConsulta" type="text" placeholder="Pesquisar %%NOME_CLASSE%%" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
				</div>
			</div>
		</form>

<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="striped">
<?php
if($a%%NOME_CLASSE%%){
?>	
			<thead>
				<tr>
					%%TITULOATRIBUTOS%%
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($a%%NOME_CLASSE%% as $o%%NOME_CLASSE%%){
?>
				<tr>
					%%VALORATRIBUTOS%%
					%%ADM_INFO%%
					%%ADM_EDIT%%
					%%ADM_DELETE%%
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="%%NUMERO_COLUNAS%%">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
			</tbody>	
<?php
}
?>
		</table>
<?php
if(!$a%%NOME_CLASSE%%){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<div class="fixed-action-btn">
		  <a class="btn-floating btn-large green darken-2" href="frm%%NOME_CLASSE%%.php">
		    <i class="large material-icons">add</i>
		  </a>
		</div>
		<input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
	</main>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>
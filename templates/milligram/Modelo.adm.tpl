<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if(isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'excluir'){
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
	<div class="container">
		<?php require_once("includes/menu.php");?>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar %%NOME_CLASSE%%</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar %%NOME_CLASSE%%" value="<?=$_REQUEST['txtConsulta'] ?? NULL ?>" autofocus />
						<button class="button" type="submit">Pesquisar</button>
						<a href="frm%%NOME_CLASSE%%.php" class="button button-outline" title="Cadastrar %%NOME_CLASSE%%">Cadastrar</a>
					</div>
				</form>
			</div>
		</div>
<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
		<table class="table table-sm table-striped">
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
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
</body>
</html>
<?php
require_once("classes/autoload.php");
$oController = new ControllerAcessoSession();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['sessions_id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aAcessoSession = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["acesso_session.sessions_id"], $_REQUEST['pag']);
//Util::trace($aAcessoSession);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="AcessoSessionController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar AcessoSession</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar AcessoSession" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmAcessoSession.php" class="btn btn-success" title="Cadastrar AcessoSession"><i class="icon ion-ios-add"></i></a>
						</span>
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
if($aAcessoSession){
?>	
			<thead>
				<tr>
					<th>Acesso</th>
					<th>Sessions_id</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aAcessoSession as $oAcessoSession){
?>
				<tr>
					<td><?=$oAcessoSession->oAcesso->id?></td>
					<td><?=$oAcessoSession->sessions_id?></td>
					<td><a id="btnDetalhes" data-id="<?=$oAcessoSession->sessions_id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes AcessoSession"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmAcessoSession.php?sessions_id=<?=$oAcessoSession->sessions_id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="sessions_id" data-id-valor="<?=$oAcessoSession->sessions_id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aAcessoSession){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="AcessoSession" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
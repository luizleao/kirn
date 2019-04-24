<?php
require_once("classes/autoload.php");
$oController = new ControllerUsuario();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['id'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aUsuario = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["usuario.id"], $_REQUEST['pag']);
//Util::trace($aUsuario);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/menu.php");?>
	<div class="container" ng-controller="UsuarioController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page">Administrar Usuario</li>
			</ol>
		</nav>

		<div class="row">
			<div class="col-md-6">
				<form action="" method="post">
					<div class="input-group mb-3">
						<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar Usuario" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
						<span class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="icon ion-ios-search"></i></button>
							<a href="frmUsuario.php" class="btn btn-success" title="Cadastrar Usuario"><i class="icon ion-ios-add"></i></a>
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
if($aUsuario){
?>	
			<thead>
				<tr>
					<th>Id</th>
					<th>Email</th>
					<th>Login</th>
					<th>Nome</th>
					<th>Roles</th>
					<th>Senha</th>
					<th>Tos</th>
					<th>Numlogins</th>
					<th>Numrotasvisu</th>
					<th>Paradascriadas</th>
					<th>Paradaseditadas</th>
					<th>Rotascriadas</th>
					<th>Rotaseditadas</th>
					<th>Totalpontos</th>
					<th>Nivel</th>
					<th>Insig1</th>
					<th>Insig2</th>
					<th>Insig3</th>
					<th>Insig4</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aUsuario as $oUsuario){
?>
				<tr>
					<td><?=$oUsuario->id?></td>
					<td><?=$oUsuario->email?></td>
					<td><?=$oUsuario->login?></td>
					<td><?=$oUsuario->nome?></td>
					<td><?=$oUsuario->roles?></td>
					<td><?=$oUsuario->senha?></td>
					<td><?=$oUsuario->tos?></td>
					<td><?=$oUsuario->numlogins?></td>
					<td><?=$oUsuario->numrotasvisu?></td>
					<td><?=$oUsuario->paradascriadas?></td>
					<td><?=$oUsuario->paradaseditadas?></td>
					<td><?=$oUsuario->rotascriadas?></td>
					<td><?=$oUsuario->rotaseditadas?></td>
					<td><?=$oUsuario->totalpontos?></td>
					<td><?=$oUsuario->nivel?></td>
					<td><?=$oUsuario->insig1?></td>
					<td><?=$oUsuario->insig2?></td>
					<td><?=$oUsuario->insig3?></td>
					<td><?=$oUsuario->insig4?></td>
					<td><a id="btnDetalhes" data-id="<?=$oUsuario->id;?>" class="btn btn-info btn-sm" href="#" title="Detalhes Usuario"><i class="icon ion-ios-information-circle-outline"></i></a></td>

					<td><a class="btn btn-success btn-sm" href="frmUsuario.php?id=<?=$oUsuario->id;?>" title="Editar"><i class="icon ion-ios-create"></i></a></td>
					<td><a id="btnExcluir" data-id="id" data-id-valor="<?=$oUsuario->id;?>" class="btn btn-danger btn-sm" href="javascript: void(0);" title="Excluir"><i class="icon ion-ios-trash"></i></a></td>
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
if(!$aUsuario){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
		<?php $oController->componentePaginacao($numPags);?>
		<input type="hidden" name="classe" id="classe" value="Usuario" />
	</div>
	<?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
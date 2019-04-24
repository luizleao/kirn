<?php
require_once("classes/autoload.php");
$oController = new ControllerUsuario();

$oUsuario = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oUsuario)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oUsuario)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}


?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="UsuarioController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admUsuario.php">Usuario</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?=$label?></li>
			</ol>
		</nav>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                
<div class="col-md-4">
	<div class="form-group">
	    <label for="email">email</label>
	    <div class="input-group">
	        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
	        <input type="text" class="form-control" name="email" id="email" value="<?=$oUsuario->email?>" />
	    </div>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="login">Login</label>
		<input type="text" class="form-control" id="login" name="login" value="<?=$oUsuario->login?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="nome">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$oUsuario->nome?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="roles">Roles</label>
		<input type="text" class="form-control" id="roles" name="roles" value="<?=$oUsuario->roles?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="senha">Senha</label>
	    <input type="password" class="form-control" id="senha" name="senha" value="<?=$oUsuario->senha?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="tos">Tos</label>
		<input type="text" class="form-control" id="tos" name="tos" value="<?=$oUsuario->tos?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="numlogins">Numlogins</label>
		<input type="text" class="form-control" id="numlogins" name="numlogins" value="<?=$oUsuario->numlogins?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="numrotasvisu">Numrotasvisu</label>
		<input type="text" class="form-control" id="numrotasvisu" name="numrotasvisu" value="<?=$oUsuario->numrotasvisu?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="paradascriadas">Paradascriadas</label>
		<input type="text" class="form-control" id="paradascriadas" name="paradascriadas" value="<?=$oUsuario->paradascriadas?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="paradaseditadas">Paradaseditadas</label>
		<input type="text" class="form-control" id="paradaseditadas" name="paradaseditadas" value="<?=$oUsuario->paradaseditadas?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="rotascriadas">Rotascriadas</label>
		<input type="text" class="form-control" id="rotascriadas" name="rotascriadas" value="<?=$oUsuario->rotascriadas?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="rotaseditadas">Rotaseditadas</label>
		<input type="text" class="form-control" id="rotaseditadas" name="rotaseditadas" value="<?=$oUsuario->rotaseditadas?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="totalpontos">Totalpontos</label>
		<input type="text" class="form-control" id="totalpontos" name="totalpontos" value="<?=$oUsuario->totalpontos?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="nivel">Nivel</label>
		<input type="text" class="form-control" id="nivel" name="nivel" value="<?=$oUsuario->nivel?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="insig1">Insig1</label>
		<input type="text" class="form-control" id="insig1" name="insig1" value="<?=$oUsuario->insig1?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="insig2">Insig2</label>
		<input type="text" class="form-control" id="insig2" name="insig2" value="<?=$oUsuario->insig2?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="insig3">Insig3</label>
		<input type="text" class="form-control" id="insig3" name="insig3" value="<?=$oUsuario->insig3?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="insig4">Insig4</label>
		<input type="text" class="form-control" id="insig4" name="insig4" value="<?=$oUsuario->insig4?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admUsuario.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Usuario" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>
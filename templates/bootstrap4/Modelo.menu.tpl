<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="principal.php">
		<a href="./home.php"><img src="img/logo.png"></a> %%PROJETO%%
	</a>
	<div id="menu" class="collapse navbar-collapse">
		<ul class="navbar-nav">
			%%MODELO_MENU%%
			<li class="nav-item dropdown">
				<a class="nav-item nav-link dropdown-toggle" href="#" id="Usuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <i class="icon ion-md-person"></i> <?=$_SESSION['usuarioAtual']['login'] ?? NULL ?> <span class="caret"></span>
				</a>
				<div class="dropdown-menu" aria-labelledby="Usuario">
					<a class="dropdown-item" href="frmAlterarSenha.php"><i class="icon ion-md-key"></i> Alterar Senha</a>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalSobre"><i class="icon ion-md-help"></i> Sobre</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logoff.php"><i class="icon ion-md-log-out"></i> Sair</a>
				</div>
			</li>			
		</ul>
	</div>
</nav>
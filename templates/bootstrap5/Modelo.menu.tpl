<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container-fluid">
		<a class="navbar-brand" href="home.php"><img src="img/logo.png"> %%PROJETO%%</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="menu" class="collapse navbar-collapse">
			<ul class="navbar-nav">
				%%MODELO_MENU%%
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="Usuario" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <i class="bi bi-person-fill"></i> <?=$_SESSION['usuarioAtual']['login'] ?? NULL ?> <span class="caret"></span>
					</a>
					<div class="dropdown-menu" aria-labelledby="Usuario">
						<a class="dropdown-item" href="frmAlterarSenha.php"><i class="bi bi-key"></i> Alterar Senha</a>
						<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalSobre"><i class="bi bi-question-circle-fill"></i> Sobre</a>
						
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logoff.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
					</div>
				</li>			
			</ul>
		</div>
	</div>
</nav>
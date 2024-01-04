<nav>
	<a href="home.php"><img src="img/logo.png"> %%PROJETO%%</a>
	<div id="menu">
		<ul>
			%%MODELO_MENU%%
			<li>
				<a href="#" id="Usuario" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <?=$_SESSION['usuarioAtual']['login'] ?? NULL ?>
				</a>
				<div>
					<a href="frmAlterarSenha.php">Alterar Senha</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#modalSobre">Sobre</a>
					<a href="logoff.php">Sair</a>
				</div>
			</li>			
		</ul>
	</div>
</nav>
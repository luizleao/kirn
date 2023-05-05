<nav class="grey lighten-1" >
	<div class="nav-wrapper">
		<a href="home.php" class="brand-logo"><img src="img/logo.png" /> %%PROJETO%%</a>
		<a href="#" data-target="menuMobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			%%MODELO_MENU%%
			<li><a class="dropdown-trigger" href="#" data-target="Sobre"><i class="material-icons left">person_outline</i><?=(isset($_SESSION['usuarioAtual']['login'])) ? $_SESSION['usuarioAtual']['login'] : ""?><i class="material-icons right">arrow_drop_down</i></a></li>
			<ul id="Sobre" class="dropdown-content">
				<li><a href="#">Alterar Senha</a></li>
				<li><a href="#modalSobre" class="modal-trigger">Sobre</a></li>
				<li class="divider"></li>
				<li><a href="logoff.php">Sair</a></li>
			</ul>
		</ul>
	</div>
</nav>
<ul class="sidenav" id="menuMobile">
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li><a class="collapsible-header waves-effect waves-teal">Post</a>
	  			<div class="collapsible-body">
	    			<ul>
	      				<li><a href="admPost.php"><i class="material-icons">assignment</i> Administrar</a></li>
						<li><a href="cadPost.php"><i class="material-icons">add</i> Cadastrar</a></li>
	            	</ul>
				</div>
			</li>
			<li><a class="collapsible-header waves-effect waves-teal">Comentario</a>
				<div class="collapsible-body">
					<ul>
						<li><a href="admComentario.php"><i class="material-icons">assignment</i> Administrar</a></li>
						<li><a href="cadComentario.php"><i class="material-icons">add</i> Cadastrar</a></li>
					</ul>
				</div>
			</li>
			<li><a class="collapsible-header waves-effect waves-teal">Usuario</a>
				<div class="collapsible-body">
					<ul>
	                    <li><a href="admUsuario.php"><i class="material-icons">assignment</i> Administrar</a></li>
						<li><a href="cadUsuario.php"><i class="material-icons">add</i> Cadastrar</a></li>
	    			</ul>
	  			</div>
			</li>
			<li><div class="divider"></div></li>
			<li><a class="collapsible-header waves-effect waves-teal"><i class="material-icons">help</i>Ajuda</a>
				<div class="collapsible-body">
					<ul>
						<li><a href="#">Perfil</a></li>
						<li><a href="#modalSobre" class="modal-trigger">Sobre</a></li>
						<li class="divider"></li>
						<li><a href="logoff.php">Sair</a></li>
	    			</ul>
				</div>
			</li>
		</ul>
	</li>
</ul>
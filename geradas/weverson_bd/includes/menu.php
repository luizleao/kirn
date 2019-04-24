<nav class="grey lighten-1" >
	<div class="nav-wrapper">
		<a href="home.php" class="brand-logo"><img src="img/logo.png" /> Weverson_bd</a>
		<a href="#" data-target="menuMobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a class="dropdown-trigger" href="#" data-target="CAMPEONATO">CAMPEONATO<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="CAMPEONATO" class="dropdown-content">
	<li><a href="admCAMPEONATO.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmCAMPEONATO.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="EVENTO SUSPEITO">EVENTO SUSPEITO<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="EVENTO SUSPEITO" class="dropdown-content">
	<li><a href="admEVENTO SUSPEITO.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmEVENTO SUSPEITO.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="EVENTOS INTERNOS">EVENTOS INTERNOS<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="EVENTOS INTERNOS" class="dropdown-content">
	<li><a href="admEVENTOS INTERNOS.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmEVENTOS INTERNOS.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="JOGADOR">JOGADOR<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="JOGADOR" class="dropdown-content">
	<li><a href="admJOGADOR.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmJOGADOR.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="PARTIDA">PARTIDA<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="PARTIDA" class="dropdown-content">
	<li><a href="admPARTIDA.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmPARTIDA.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="TIME">TIME<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="TIME" class="dropdown-content">
	<li><a href="admTIME.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmTIME.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>
			<li><a class="dropdown-trigger" href="#" data-target="Sobre"><i class="material-icons left">person_outline</i><?=$_SESSION['usuarioAtual']['login']?><i class="material-icons right">arrow_drop_down</i></a></li>
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
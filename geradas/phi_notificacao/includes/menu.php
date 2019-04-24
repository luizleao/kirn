<nav class="grey lighten-1" >
	<div class="nav-wrapper">
		<a href="home.php" class="brand-logo"><img src="img/logo.png" /> Phi_notificacao</a>
		<a href="#" data-target="menuMobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a class="dropdown-trigger" href="#" data-target="Bat">Bat<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="Bat" class="dropdown-content">
	<li><a href="admBat.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmBat.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="Contato">Contato<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="Contato" class="dropdown-content">
	<li><a href="admContato.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmContato.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="Plantao">Plantao<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="Plantao" class="dropdown-content">
	<li><a href="admPlantao.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmPlantao.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="Sensor">Sensor<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="Sensor" class="dropdown-content">
	<li><a href="admSensor.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmSensor.php"><i class="material-icons left">add</i> Cadastrar</a></li>
</ul>

<li><a class="dropdown-trigger" href="#" data-target="Usuario">Usuario<i class="material-icons right">arrow_drop_down</i></a></li>
<ul id="Usuario" class="dropdown-content">
	<li><a href="admUsuario.php"><i class="material-icons left">format_list_bulleted</i> Administrar</a></li>
	<li><a href="frmUsuario.php"><i class="material-icons left">add</i> Cadastrar</a></li>
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
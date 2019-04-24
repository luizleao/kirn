<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            
			<ul class="nav pull-right">
				<li class="divider-vertical"></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img id="imgUser" class="img-responsive img-circle" style="max-width: 12%" /> <span id="nameUser"></span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="frmAlterarSenha.php">Alterar Senha</a></li>
	                    <li><a href="#" data-toggle="modal" data-target="#modalSobre">Sobre</a></li>
	                    <li class="divider"></li>
	                    <li><a href="logoff.php"><i class="icon-off"></i> Sair</a></li>
					</ul>
				</li>
			</ul>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active">
                        <a href="home.php"><i class="icon-white icon-home"></i>Home</a>
                    </li>
%%MODELO_MENU%%
                </ul>
            </div><!--/.nav-collapse -->
		</div>
    </div>    
</div>
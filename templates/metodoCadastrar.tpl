	/**
	 * Cadastrar %%NOME_CLASSE%%
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::form%%NOME_CLASSE%%($post);
		
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaForm%%NOME_CLASSE%%($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = mb_convert_encoding($v ?? "", 'UTF-8', 'ISO-8859-1');
		// cria objeto para grava-lo no BD
		%%MONTA_OBJETO%%
		%%MONTA_OBJETOBD%%
		if(!$o%%NOME_CLASSE%%BD->cadastrar($o%%NOME_CLASSE%%)){
			$this->msg = $o%%NOME_CLASSE%%BD->msg;
			return false;
		}

		return true;
	}
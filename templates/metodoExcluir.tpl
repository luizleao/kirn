	/**
	 * Excluir %%NOME_CLASSE%%
	 *
	 * @access public
%%DOC_LISTA_PK%%
	 * @return bool
	 */
	public function excluir(%%LISTA_PK%%){		
		%%MONTA_OBJETOBD%%		
		if(!$o%%NOME_CLASSE%%BD->excluir(%%LISTA_PK%%)){
			$this->msg = $o%%NOME_CLASSE%%BD->msg;
			return false;	
		}		
		return true;		
	}
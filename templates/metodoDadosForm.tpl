	static function form%%NOME_CLASSE%%($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		%%ATRIBUICAO%%
	
		return $post;		
	}
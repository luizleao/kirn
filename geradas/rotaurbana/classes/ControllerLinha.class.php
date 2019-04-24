<?php
class ControllerLinha extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Linha
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formLinha($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormLinha($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oUsuario = new Usuario($usuario_id);
		$oCidade = new Cidade($cidade_id);
		$oLinha = new Linha($root);
		$oLinha = new Linha($id,$codigo,$emAvaliacao,$nome,$oUsuario,$sincronizacaoCodigo,$tipo,$comentario,$completa,$faltaCadastrarPontosPesquisa,$url,$oCidade,$tipoDeRota,$itinerarioTotalEncoding,$lastUpdate,$semob,$oLinha);
		$oLinhaBD = new LinhaBD();
		if(!$oLinhaBD->cadastrar($oLinha)){
			$this->msg = $oLinhaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Linha
	 *
	 * @access public
	 * @param Linha $oLinha
	 * @return bool
	 */
	public function alterar($oLinha = NULL){
		if($oLinha == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formLinha(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormLinha($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oUsuario = new Usuario($usuario_id);
			$oCidade = new Cidade($cidade_id);
			$oLinha = new Linha($root);
			$oLinha = new Linha($id,$codigo,$emAvaliacao,$nome,$oUsuario,$sincronizacaoCodigo,$tipo,$comentario,$completa,$faltaCadastrarPontosPesquisa,$url,$oCidade,$tipoDeRota,$itinerarioTotalEncoding,$lastUpdate,$semob,$oLinha);
		}		
		$oLinhaBD = new LinhaBD();
		if(!$oLinhaBD->alterar($oLinha)){
			$this->msg = $oLinhaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Linha
	 *
	 * @access public
	 * @param integer $idLinha
	 * @return bool
	 */
	public function excluir($idLinha){		
		$oLinhaBD = new LinhaBD();		
		if(!$oLinhaBD->excluir($idLinha)){
			$this->msg = $oLinhaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Linha
	 *
	 * @access public
	 * @param integer $id
	 * @return Linha
	 */
	public function get($id){
		$oLinhaBD = new LinhaBD();
		if($oLinhaBD->msg != ''){
			$this->msg = $oLinhaBD->msg;
			return false;
		}
		if(!$obj = $oLinhaBD->get($id)){
		    $this->msg = $oLinhaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Linha
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Linha[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oLinhaBD = new LinhaBD();
			$aux = $oLinhaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oLinhaBD->msg != ''){
				$this->msg = $oLinhaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Linha
	 *
	 * @access public
	 * @param string $valor
	 * @return Linha
	 */
	public function consultar($valor){
		$oLinhaBD = new LinhaBD();	
		return $oLinhaBD->consultar($valor);
	}

	/**
	 * Total de registros de Linha
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oLinhaBD = new LinhaBD();
		return $oLinhaBD->totalColecao();
	}

}
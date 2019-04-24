<?php
class ControllerContato extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Contato
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formContato($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormContato($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oContato = new Contato($id_tel,$numero,$ddd,$email);
		$oContatoBD = new ContatoBD();
		if(!$oContatoBD->cadastrar($oContato)){
			$this->msg = $oContatoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Contato
	 *
	 * @access public
	 * @param Contato $oContato
	 * @return bool
	 */
	public function alterar($oContato = NULL){
		if($oContato == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formContato(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormContato($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oContato = new Contato($id_tel,$numero,$ddd,$email);
		}		
		$oContatoBD = new ContatoBD();
		if(!$oContatoBD->alterar($oContato)){
			$this->msg = $oContatoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Contato
	 *
	 * @access public
	 * @param integer $idContato
	 * @return bool
	 */
	public function excluir($idContato){		
		$oContatoBD = new ContatoBD();		
		if(!$oContatoBD->excluir($idContato)){
			$this->msg = $oContatoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Contato
	 *
	 * @access public
	 * @param integer $id_tel
	 * @return Contato
	 */
	public function get($id_tel){
		$oContatoBD = new ContatoBD();
		if($oContatoBD->msg != ''){
			$this->msg = $oContatoBD->msg;
			return false;
		}
		if(!$obj = $oContatoBD->get($id_tel)){
		    $this->msg = $oContatoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Contato
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Contato[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oContatoBD = new ContatoBD();
			$aux = $oContatoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oContatoBD->msg != ''){
				$this->msg = $oContatoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Contato
	 *
	 * @access public
	 * @param string $valor
	 * @return Contato
	 */
	public function consultar($valor){
		$oContatoBD = new ContatoBD();	
		return $oContatoBD->consultar($valor);
	}

	/**
	 * Total de registros de Contato
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oContatoBD = new ContatoBD();
		return $oContatoBD->totalColecao();
	}

}
<?php
class ControllerCoordenada extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Coordenada
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCoordenada($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCoordenada($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTrechocomentario = new Trechocomentario($trechoComentario_id);
		$oCoordenada = new Coordenada($id,$latitude,$longitude,$oTrechocomentario);
		$oCoordenadaBD = new CoordenadaBD();
		if(!$oCoordenadaBD->cadastrar($oCoordenada)){
			$this->msg = $oCoordenadaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Coordenada
	 *
	 * @access public
	 * @param Coordenada $oCoordenada
	 * @return bool
	 */
	public function alterar($oCoordenada = NULL){
		if($oCoordenada == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCoordenada(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCoordenada($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTrechocomentario = new Trechocomentario($trechoComentario_id);
			$oCoordenada = new Coordenada($id,$latitude,$longitude,$oTrechocomentario);
		}		
		$oCoordenadaBD = new CoordenadaBD();
		if(!$oCoordenadaBD->alterar($oCoordenada)){
			$this->msg = $oCoordenadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Coordenada
	 *
	 * @access public
	 * @param integer $idCoordenada
	 * @return bool
	 */
	public function excluir($idCoordenada){		
		$oCoordenadaBD = new CoordenadaBD();		
		if(!$oCoordenadaBD->excluir($idCoordenada)){
			$this->msg = $oCoordenadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Coordenada
	 *
	 * @access public
	 * @param integer $id
	 * @return Coordenada
	 */
	public function get($id){
		$oCoordenadaBD = new CoordenadaBD();
		if($oCoordenadaBD->msg != ''){
			$this->msg = $oCoordenadaBD->msg;
			return false;
		}
		if(!$obj = $oCoordenadaBD->get($id)){
		    $this->msg = $oCoordenadaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Coordenada
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Coordenada[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCoordenadaBD = new CoordenadaBD();
			$aux = $oCoordenadaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCoordenadaBD->msg != ''){
				$this->msg = $oCoordenadaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Coordenada
	 *
	 * @access public
	 * @param string $valor
	 * @return Coordenada
	 */
	public function consultar($valor){
		$oCoordenadaBD = new CoordenadaBD();	
		return $oCoordenadaBD->consultar($valor);
	}

	/**
	 * Total de registros de Coordenada
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCoordenadaBD = new CoordenadaBD();
		return $oCoordenadaBD->totalColecao();
	}

}
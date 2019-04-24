<?php
class ControllerCidade extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Cidade
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formCidade($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormCidade($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oEstado = new Estado($estado_id);
		$oCidade = new Cidade($belongsTo_id);
		$oCidade = new Cidade($id,$latitude,$longitude,$nome,$oEstado,$oCidade,$sameAs,$latitudeDouble,$longitudeDouble);
		$oCidadeBD = new CidadeBD();
		if(!$oCidadeBD->cadastrar($oCidade)){
			$this->msg = $oCidadeBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Cidade
	 *
	 * @access public
	 * @param Cidade $oCidade
	 * @return bool
	 */
	public function alterar($oCidade = NULL){
		if($oCidade == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formCidade(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormCidade($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oEstado = new Estado($estado_id);
			$oCidade = new Cidade($belongsTo_id);
			$oCidade = new Cidade($id,$latitude,$longitude,$nome,$oEstado,$oCidade,$sameAs,$latitudeDouble,$longitudeDouble);
		}		
		$oCidadeBD = new CidadeBD();
		if(!$oCidadeBD->alterar($oCidade)){
			$this->msg = $oCidadeBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Cidade
	 *
	 * @access public
	 * @param integer $idCidade
	 * @return bool
	 */
	public function excluir($idCidade){		
		$oCidadeBD = new CidadeBD();		
		if(!$oCidadeBD->excluir($idCidade)){
			$this->msg = $oCidadeBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Cidade
	 *
	 * @access public
	 * @param integer $id
	 * @return Cidade
	 */
	public function get($id){
		$oCidadeBD = new CidadeBD();
		if($oCidadeBD->msg != ''){
			$this->msg = $oCidadeBD->msg;
			return false;
		}
		if(!$obj = $oCidadeBD->get($id)){
		    $this->msg = $oCidadeBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Cidade
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Cidade[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oCidadeBD = new CidadeBD();
			$aux = $oCidadeBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oCidadeBD->msg != ''){
				$this->msg = $oCidadeBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Cidade
	 *
	 * @access public
	 * @param string $valor
	 * @return Cidade
	 */
	public function consultar($valor){
		$oCidadeBD = new CidadeBD();	
		return $oCidadeBD->consultar($valor);
	}

	/**
	 * Total de registros de Cidade
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oCidadeBD = new CidadeBD();
		return $oCidadeBD->totalColecao();
	}

}
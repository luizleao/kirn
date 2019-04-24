<?php
class ControllerServico extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Servico
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formServico($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormServico($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oSla = new Sla($idSla);
		$oTipoServico = new TipoServico($idTipoServico);
		$oServico = new Servico($idServico,$oSla,$oTipoServico,$descricao,$valor,$status);
		$oServicoBD = new ServicoBD();
		if(!$oServicoBD->cadastrar($oServico)){
			$this->msg = $oServicoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Servico
	 *
	 * @access public
	 * @param Servico $oServico
	 * @return bool
	 */
	public function alterar($oServico = NULL){
		if($oServico == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formServico(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormServico($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oSla = new Sla($idSla);
			$oTipoServico = new TipoServico($idTipoServico);
			$oServico = new Servico($idServico,$oSla,$oTipoServico,$descricao,$valor,$status);
		}		
		$oServicoBD = new ServicoBD();
		if(!$oServicoBD->alterar($oServico)){
			$this->msg = $oServicoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Servico
	 *
	 * @access public
	 * @param integer $idServico
	 * @return bool
	 */
	public function excluir($idServico){		
		$oServicoBD = new ServicoBD();		
		if(!$oServicoBD->excluir($idServico)){
			$this->msg = $oServicoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Servico
	 *
	 * @access public
	 * @param integer $idServico
	 * @return Servico
	 */
	public function get($idServico){
		$oServicoBD = new ServicoBD();
		if($oServicoBD->msg != ''){
			$this->msg = $oServicoBD->msg;
			return false;
		}
		if(!$obj = $oServicoBD->get($idServico)){
		    $this->msg = $oServicoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Servico
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Servico[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oServicoBD = new ServicoBD();
			$aux = $oServicoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oServicoBD->msg != ''){
				$this->msg = $oServicoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Servico
	 *
	 * @access public
	 * @param string $valor
	 * @return Servico
	 */
	public function consultar($valor){
		$oServicoBD = new ServicoBD();	
		return $oServicoBD->consultar($valor);
	}

	/**
	 * Total de registros de Servico
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oServicoBD = new ServicoBD();
		return $oServicoBD->totalColecao();
	}

}
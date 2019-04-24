<?php
class ControllerInsumoTicket extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar InsumoTicket
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formInsumoTicket($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormInsumoTicket($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTicket = new Ticket($idTicket);
		$oInsumo = new Insumo($idInsumo);
		$oInsumoTicket = new InsumoTicket($oTicket,$oInsumo,$quantidade);
		$oInsumoTicketBD = new InsumoTicketBD();
		if(!$oInsumoTicketBD->cadastrar($oInsumoTicket)){
			$this->msg = $oInsumoTicketBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de InsumoTicket
	 *
	 * @access public
	 * @param InsumoTicket $oInsumoTicket
	 * @return bool
	 */
	public function alterar($oInsumoTicket = NULL){
		if($oInsumoTicket == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formInsumoTicket(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormInsumoTicket($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTicket = new Ticket($idTicket);
			$oInsumo = new Insumo($idInsumo);
			$oInsumoTicket = new InsumoTicket($oTicket,$oInsumo,$quantidade);
		}		
		$oInsumoTicketBD = new InsumoTicketBD();
		if(!$oInsumoTicketBD->alterar($oInsumoTicket)){
			$this->msg = $oInsumoTicketBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir InsumoTicket
	 *
	 * @access public
	 * @param integer $idInsumoTicket
	 * @return bool
	 */
	public function excluir($idInsumoTicket){		
		$oInsumoTicketBD = new InsumoTicketBD();		
		if(!$oInsumoTicketBD->excluir($idInsumoTicket)){
			$this->msg = $oInsumoTicketBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de InsumoTicket
	 *
	 * @access public
	 * @param integer $idTicket
	 * @param integer $idInsumo
	 * @return InsumoTicket
	 */
	public function get($idTicket,$idInsumo){
		$oInsumoTicketBD = new InsumoTicketBD();
		if($oInsumoTicketBD->msg != ''){
			$this->msg = $oInsumoTicketBD->msg;
			return false;
		}
		if(!$obj = $oInsumoTicketBD->get($idTicket,$idInsumo)){
		    $this->msg = $oInsumoTicketBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de InsumoTicket
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return InsumoTicket[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oInsumoTicketBD = new InsumoTicketBD();
			$aux = $oInsumoTicketBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oInsumoTicketBD->msg != ''){
				$this->msg = $oInsumoTicketBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de InsumoTicket
	 *
	 * @access public
	 * @param string $valor
	 * @return InsumoTicket
	 */
	public function consultar($valor){
		$oInsumoTicketBD = new InsumoTicketBD();	
		return $oInsumoTicketBD->consultar($valor);
	}

	/**
	 * Total de registros de InsumoTicket
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oInsumoTicketBD = new InsumoTicketBD();
		return $oInsumoTicketBD->totalColecao();
	}

}
<?php
class ControllerPatrimonioTicket extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar PatrimonioTicket
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formPatrimonioTicket($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormPatrimonioTicket($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oTicket = new Ticket($idTicket);
		$oPatrimonioTicket = new PatrimonioTicket($idPatrimonioTicket,$oTicket,$tombamento,$status);
		$oPatrimonioTicketBD = new PatrimonioTicketBD();
		if(!$oPatrimonioTicketBD->cadastrar($oPatrimonioTicket)){
			$this->msg = $oPatrimonioTicketBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de PatrimonioTicket
	 *
	 * @access public
	 * @param PatrimonioTicket $oPatrimonioTicket
	 * @return bool
	 */
	public function alterar($oPatrimonioTicket = NULL){
		if($oPatrimonioTicket == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formPatrimonioTicket(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormPatrimonioTicket($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oTicket = new Ticket($idTicket);
			$oPatrimonioTicket = new PatrimonioTicket($idPatrimonioTicket,$oTicket,$tombamento,$status);
		}		
		$oPatrimonioTicketBD = new PatrimonioTicketBD();
		if(!$oPatrimonioTicketBD->alterar($oPatrimonioTicket)){
			$this->msg = $oPatrimonioTicketBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir PatrimonioTicket
	 *
	 * @access public
	 * @param integer $idPatrimonioTicket
	 * @return bool
	 */
	public function excluir($idPatrimonioTicket){		
		$oPatrimonioTicketBD = new PatrimonioTicketBD();		
		if(!$oPatrimonioTicketBD->excluir($idPatrimonioTicket)){
			$this->msg = $oPatrimonioTicketBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de PatrimonioTicket
	 *
	 * @access public
	 * @param integer $idPatrimonioTicket
	 * @return PatrimonioTicket
	 */
	public function get($idPatrimonioTicket){
		$oPatrimonioTicketBD = new PatrimonioTicketBD();
		if($oPatrimonioTicketBD->msg != ''){
			$this->msg = $oPatrimonioTicketBD->msg;
			return false;
		}
		if(!$obj = $oPatrimonioTicketBD->get($idPatrimonioTicket)){
		    $this->msg = $oPatrimonioTicketBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de PatrimonioTicket
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return PatrimonioTicket[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oPatrimonioTicketBD = new PatrimonioTicketBD();
			$aux = $oPatrimonioTicketBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oPatrimonioTicketBD->msg != ''){
				$this->msg = $oPatrimonioTicketBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de PatrimonioTicket
	 *
	 * @access public
	 * @param string $valor
	 * @return PatrimonioTicket
	 */
	public function consultar($valor){
		$oPatrimonioTicketBD = new PatrimonioTicketBD();	
		return $oPatrimonioTicketBD->consultar($valor);
	}

	/**
	 * Total de registros de PatrimonioTicket
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oPatrimonioTicketBD = new PatrimonioTicketBD();
		return $oPatrimonioTicketBD->totalColecao();
	}

}
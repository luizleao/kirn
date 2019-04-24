<?php
class ControllerTicket extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Ticket
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formTicket($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormTicket($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oServico = new Servico($idServico);
		$oTicket = new Ticket($idTicket,$oServico,$cd_servidor_solicitante,$cd_servidor_recebimento,$numero,$descricao,$dataHoraAbertura,$flagAprovado,$flagAtendido,$flagExecutado,$status);
		$oTicketBD = new TicketBD();
		if(!$oTicketBD->cadastrar($oTicket)){
			$this->msg = $oTicketBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Ticket
	 *
	 * @access public
	 * @param Ticket $oTicket
	 * @return bool
	 */
	public function alterar($oTicket = NULL){
		if($oTicket == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formTicket(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormTicket($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oServico = new Servico($idServico);
			$oTicket = new Ticket($idTicket,$oServico,$cd_servidor_solicitante,$cd_servidor_recebimento,$numero,$descricao,$dataHoraAbertura,$flagAprovado,$flagAtendido,$flagExecutado,$status);
		}		
		$oTicketBD = new TicketBD();
		if(!$oTicketBD->alterar($oTicket)){
			$this->msg = $oTicketBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Ticket
	 *
	 * @access public
	 * @param integer $idTicket
	 * @return bool
	 */
	public function excluir($idTicket){		
		$oTicketBD = new TicketBD();		
		if(!$oTicketBD->excluir($idTicket)){
			$this->msg = $oTicketBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Ticket
	 *
	 * @access public
	 * @param integer $idTicket
	 * @return Ticket
	 */
	public function get($idTicket){
		$oTicketBD = new TicketBD();
		if($oTicketBD->msg != ''){
			$this->msg = $oTicketBD->msg;
			return false;
		}
		if(!$obj = $oTicketBD->get($idTicket)){
		    $this->msg = $oTicketBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Ticket
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Ticket[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oTicketBD = new TicketBD();
			$aux = $oTicketBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oTicketBD->msg != ''){
				$this->msg = $oTicketBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Ticket
	 *
	 * @access public
	 * @param string $valor
	 * @return Ticket
	 */
	public function consultar($valor){
		$oTicketBD = new TicketBD();	
		return $oTicketBD->consultar($valor);
	}

	/**
	 * Total de registros de Ticket
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oTicketBD = new TicketBD();
		return $oTicketBD->totalColecao();
	}

}
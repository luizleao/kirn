<?php
class ControllerBgdPontoTracadoTrajeto extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdPontoTracadoTrajeto
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdPontoTracadoTrajeto($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdPontoTracadoTrajeto($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdLinha = new BgdLinha($fk_bgd_linha);
		$oBgdPontoTracadoTrajeto = new BgdPontoTracadoTrajeto($id,$latitude,$longitude,$posicao,$tipo,$oBgdLinha);
		$oBgdPontoTracadoTrajetoBD = new BgdPontoTracadoTrajetoBD();
		if(!$oBgdPontoTracadoTrajetoBD->cadastrar($oBgdPontoTracadoTrajeto)){
			$this->msg = $oBgdPontoTracadoTrajetoBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdPontoTracadoTrajeto
	 *
	 * @access public
	 * @param BgdPontoTracadoTrajeto $oBgdPontoTracadoTrajeto
	 * @return bool
	 */
	public function alterar($oBgdPontoTracadoTrajeto = NULL){
		if($oBgdPontoTracadoTrajeto == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdPontoTracadoTrajeto(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdPontoTracadoTrajeto($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdLinha = new BgdLinha($fk_bgd_linha);
			$oBgdPontoTracadoTrajeto = new BgdPontoTracadoTrajeto($id,$latitude,$longitude,$posicao,$tipo,$oBgdLinha);
		}		
		$oBgdPontoTracadoTrajetoBD = new BgdPontoTracadoTrajetoBD();
		if(!$oBgdPontoTracadoTrajetoBD->alterar($oBgdPontoTracadoTrajeto)){
			$this->msg = $oBgdPontoTracadoTrajetoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdPontoTracadoTrajeto
	 *
	 * @access public
	 * @param integer $idBgdPontoTracadoTrajeto
	 * @return bool
	 */
	public function excluir($idBgdPontoTracadoTrajeto){		
		$oBgdPontoTracadoTrajetoBD = new BgdPontoTracadoTrajetoBD();		
		if(!$oBgdPontoTracadoTrajetoBD->excluir($idBgdPontoTracadoTrajeto)){
			$this->msg = $oBgdPontoTracadoTrajetoBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdPontoTracadoTrajeto
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdPontoTracadoTrajeto
	 */
	public function get($id){
		$oBgdPontoTracadoTrajetoBD = new BgdPontoTracadoTrajetoBD();
		if($oBgdPontoTracadoTrajetoBD->msg != ''){
			$this->msg = $oBgdPontoTracadoTrajetoBD->msg;
			return false;
		}
		if(!$obj = $oBgdPontoTracadoTrajetoBD->get($id)){
		    $this->msg = $oBgdPontoTracadoTrajetoBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdPontoTracadoTrajeto
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdPontoTracadoTrajeto[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdPontoTracadoTrajetoBD = new BgdPontoTracadoTrajetoBD();
			$aux = $oBgdPontoTracadoTrajetoBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdPontoTracadoTrajetoBD->msg != ''){
				$this->msg = $oBgdPontoTracadoTrajetoBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdPontoTracadoTrajeto
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdPontoTracadoTrajeto
	 */
	public function consultar($valor){
		$oBgdPontoTracadoTrajetoBD = new BgdPontoTracadoTrajetoBD();	
		return $oBgdPontoTracadoTrajetoBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdPontoTracadoTrajeto
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdPontoTracadoTrajetoBD = new BgdPontoTracadoTrajetoBD();
		return $oBgdPontoTracadoTrajetoBD->totalColecao();
	}

}
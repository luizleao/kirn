<?php
class ControllerBgdDistanciaRotaSelecionada extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar BgdDistanciaRotaSelecionada
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formBgdDistanciaRotaSelecionada($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormBgdDistanciaRotaSelecionada($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oBgdCidade = new BgdCidade($fk_bgd_cidade);
		$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
		$oBgdLinha = new BgdLinha($fk_bgd_linha);
		$oBgdDistanciaRotaSelecionada = new BgdDistanciaRotaSelecionada($id,$data_captura,$distancia,$oBgdCidade,$oBgdCidade,$oBgdLinha,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		$oBgdDistanciaRotaSelecionadaBD = new BgdDistanciaRotaSelecionadaBD();
		if(!$oBgdDistanciaRotaSelecionadaBD->cadastrar($oBgdDistanciaRotaSelecionada)){
			$this->msg = $oBgdDistanciaRotaSelecionadaBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de BgdDistanciaRotaSelecionada
	 *
	 * @access public
	 * @param BgdDistanciaRotaSelecionada $oBgdDistanciaRotaSelecionada
	 * @return bool
	 */
	public function alterar($oBgdDistanciaRotaSelecionada = NULL){
		if($oBgdDistanciaRotaSelecionada == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formBgdDistanciaRotaSelecionada(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormBgdDistanciaRotaSelecionada($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oBgdCidade = new BgdCidade($fk_bgd_cidade);
			$oBgdCidade = new BgdCidade($fk_bgd_cidade_prox_usuario);
			$oBgdLinha = new BgdLinha($fk_bgd_linha);
			$oBgdDistanciaRotaSelecionada = new BgdDistanciaRotaSelecionada($id,$data_captura,$distancia,$oBgdCidade,$oBgdCidade,$oBgdLinha,$lat_proxma_usuario,$lng_proxma_usuario,$fonte);
		}		
		$oBgdDistanciaRotaSelecionadaBD = new BgdDistanciaRotaSelecionadaBD();
		if(!$oBgdDistanciaRotaSelecionadaBD->alterar($oBgdDistanciaRotaSelecionada)){
			$this->msg = $oBgdDistanciaRotaSelecionadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir BgdDistanciaRotaSelecionada
	 *
	 * @access public
	 * @param integer $idBgdDistanciaRotaSelecionada
	 * @return bool
	 */
	public function excluir($idBgdDistanciaRotaSelecionada){		
		$oBgdDistanciaRotaSelecionadaBD = new BgdDistanciaRotaSelecionadaBD();		
		if(!$oBgdDistanciaRotaSelecionadaBD->excluir($idBgdDistanciaRotaSelecionada)){
			$this->msg = $oBgdDistanciaRotaSelecionadaBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de BgdDistanciaRotaSelecionada
	 *
	 * @access public
	 * @param integer $id
	 * @return BgdDistanciaRotaSelecionada
	 */
	public function get($id){
		$oBgdDistanciaRotaSelecionadaBD = new BgdDistanciaRotaSelecionadaBD();
		if($oBgdDistanciaRotaSelecionadaBD->msg != ''){
			$this->msg = $oBgdDistanciaRotaSelecionadaBD->msg;
			return false;
		}
		if(!$obj = $oBgdDistanciaRotaSelecionadaBD->get($id)){
		    $this->msg = $oBgdDistanciaRotaSelecionadaBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de BgdDistanciaRotaSelecionada
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return BgdDistanciaRotaSelecionada[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oBgdDistanciaRotaSelecionadaBD = new BgdDistanciaRotaSelecionadaBD();
			$aux = $oBgdDistanciaRotaSelecionadaBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oBgdDistanciaRotaSelecionadaBD->msg != ''){
				$this->msg = $oBgdDistanciaRotaSelecionadaBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de BgdDistanciaRotaSelecionada
	 *
	 * @access public
	 * @param string $valor
	 * @return BgdDistanciaRotaSelecionada
	 */
	public function consultar($valor){
		$oBgdDistanciaRotaSelecionadaBD = new BgdDistanciaRotaSelecionadaBD();	
		return $oBgdDistanciaRotaSelecionadaBD->consultar($valor);
	}

	/**
	 * Total de registros de BgdDistanciaRotaSelecionada
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oBgdDistanciaRotaSelecionadaBD = new BgdDistanciaRotaSelecionadaBD();
		return $oBgdDistanciaRotaSelecionadaBD->totalColecao();
	}

}
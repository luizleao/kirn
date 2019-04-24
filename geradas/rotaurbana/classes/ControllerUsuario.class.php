<?php
class ControllerUsuario extends Controller{
	
	public $msg;
	
	function __construct(){
		parent::__construct();
    }
    
	/**
	 * Cadastrar Usuario
	 *
	 * @access public
	 * @param $post
	 * @return bool
	 */
	public function cadastrar($post = NULL){
		// recebe dados do formulario
		$post = DadosFormulario::formUsuario($post);
		
		$_SESSION["post"] = $post;
		// valida dados do formulario
		$oValidador = new ValidadorFormulario();
		if(!$oValidador->validaFormUsuario($post)){
			$this->msg = $oValidador->msg;
			return false;
		}
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) $$i = utf8_encode($v);
		// cria objeto para grava-lo no BD
		$oUsuario = new Usuario($id,$email,$login,$nome,$roles,$senha,$tos,$numlogins,$numrotasvisu,$paradascriadas,$paradaseditadas,$rotascriadas,$rotaseditadas,$totalpontos,$nivel,$insig1,$insig2,$insig3,$insig4);
		$oUsuarioBD = new UsuarioBD();
		if(!$oUsuarioBD->cadastrar($oUsuario)){
			$this->msg = $oUsuarioBD->msg;
			return false;
		}
		unset($_SESSION["post"]);
		return true;
	}

	/**
	 * Alterar dados de Usuario
	 *
	 * @access public
	 * @param Usuario $oUsuario
	 * @return bool
	 */
	public function alterar($oUsuario = NULL){
		if($oUsuario == NULL){
			// recebe dados do formulario
			$post = DadosFormulario::formUsuario(NULL, 2);		
			// valida dados do formulario
			$oValidador = new ValidadorFormulario();
			if(!$oValidador->validaFormUsuario($post,2)){
				$this->msg = $oValidador->msg;
				return false;
			}
			// cria variaveis para validacao com as chaves do array
			foreach($post as $i => $v) $$i = utf8_encode($v);
			// cria objeto para grava-lo no BD
			$oUsuario = new Usuario($id,$email,$login,$nome,$roles,$senha,$tos,$numlogins,$numrotasvisu,$paradascriadas,$paradaseditadas,$rotascriadas,$rotaseditadas,$totalpontos,$nivel,$insig1,$insig2,$insig3,$insig4);
		}		
		$oUsuarioBD = new UsuarioBD();
		if(!$oUsuarioBD->alterar($oUsuario)){
			$this->msg = $oUsuarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Excluir Usuario
	 *
	 * @access public
	 * @param integer $idUsuario
	 * @return bool
	 */
	public function excluir($idUsuario){		
		$oUsuarioBD = new UsuarioBD();		
		if(!$oUsuarioBD->excluir($idUsuario)){
			$this->msg = $oUsuarioBD->msg;
			return false;	
		}		
		return true;		
	}

	/**
	 * Selecionar registro de Usuario
	 *
	 * @access public
	 * @param integer $id
	 * @return Usuario
	 */
	public function get($id){
		$oUsuarioBD = new UsuarioBD();
		if($oUsuarioBD->msg != ''){
			$this->msg = $oUsuarioBD->msg;
			return false;
		}
		if(!$obj = $oUsuarioBD->get($id)){
		    $this->msg = $oUsuarioBD->msg;
		    return false;
		}
		return $obj;
	}

	/**
	 * Carregar Colecao de dados de Usuario
	 *
	 * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @param integer $pagina Numero da Pagina 
	 * @return Usuario[]
	 */
	public function getAll($aFiltro = NULL, $aOrdenacao = NULL, $pagina=NULL){
		try{		
			$oUsuarioBD = new UsuarioBD();
			$aux = $oUsuarioBD->getAll($aFiltro, $aOrdenacao, $this->config['producao']['qtdRegPag'], $pagina);
			
			if($oUsuarioBD->msg != ''){
				$this->msg = $oUsuarioBD->msg;
				return false;
			}
			return $aux; 
		} catch(Exception $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Consultar registros de Usuario
	 *
	 * @access public
	 * @param string $valor
	 * @return Usuario
	 */
	public function consultar($valor){
		$oUsuarioBD = new UsuarioBD();	
		return $oUsuarioBD->consultar($valor);
	}

	/**
	 * Total de registros de Usuario
	 *
	 * @access public
	 * @return number
	 */
	public function totalColecao(){
		$oUsuarioBD = new UsuarioBD();
		return $oUsuarioBD->totalColecao();
	}

}
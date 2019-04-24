<?php
class SessionIndicadorBDBase {
    public $oConexao;
    public $msg;

    function __construct(Conexao $oConexao){
        try{
            $this->oConexao = $oConexao;
        } 
        catch (PDOException $e){
            $this->msg = $e->getMessage();
        }
    }
    
	/**
	 * Cadastrar instância da classe SessionIndicador
	 * 
	 * @param SessionIndicador $oSessionIndicador
	 * @return integer|boolean
	 */	
    function cadastrar($oSessionIndicador){
		$reg = SessionIndicadorMAP::objToRs($oSessionIndicador);
		$aCampo = array_keys($reg);
		$sql = "
				insert into session_indicador(
					".implode(',', $aCampo)."
				)
				values(
					:".implode(", :", $aCampo).")";

		foreach($reg as $cv=>$vl)
			$regTemp[":$cv"] = ($vl=='') ? NULL : $vl;

		try{
			$this->oConexao->executePrepare($sql, $regTemp);
			if($this->oConexao->msg != ""){
				$this->msg = $this->oConexao->msg;
				return false;
			}
			return true;
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	/**
	 * Alterar instância da classe SessionIndicador
	 * 
	 * @param SessionIndicador $oSessionIndicador
	 * @return boolean
	 */	
	function alterar($oSessionIndicador){
    	$reg = SessionIndicadorMAP::objToRs($oSessionIndicador);
        $sql = "
                update 
                    session_indicador 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "indicadores_id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    indicadores_id = {$reg['indicadores_id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "indicadores_id") continue;
            $regTemp[":$cv"] = ($vl=='') ? NULL : $vl;
        }
        try{
            $this->oConexao->executePrepare($sql, $regTemp);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
	}
	
	/**
	 * Excluir instância da classe SessionIndicador
	 * 
	 * @param integer $indicadores_id
	 * @return boolean
	 */
	function excluir($indicadores_id){
        $sql = "
                delete from
                    session_indicador 
                where
                    indicadores_id = $indicadores_id";

        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
	}
	
	/**
	 * Retorna instância da classe SessionIndicador
	 * 
	 * @param integer $indicadores_id
	 * @return SessionIndicador|boolean
	 */
	function get($indicadores_id){
        $sql = "
                select 
					".SessionIndicadorMAP::dataToSelect()." 
                from
					session_indicador 
				left join session 
					on (session_indicador.session_id = session.id) 
                where
					session_indicador.indicadores_id = $indicadores_id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return SessionIndicadorMAP::rsToObj($oReg);
            } else {
                $this->msg = "Nenhum registro encontrado!";
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
	}
	
	/**
	 * Retorna a lista de registros da tabela SessionIndicador
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return SessionIndicador[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".SessionIndicadorMAP::dataToSelect()." 
				from
					session_indicador 
				left join session 
					on (session_indicador.session_id = session.id)";
        
        if(count($aFiltro)>0){
            $sql .= " where ";
            $sql .= implode(" and ", $aFiltro);
        }
        
        if(count($aOrdenacao)>0){
            $sql .= " order by ";
            $sql .= implode(",", $aOrdenacao);
        }
        
        $sql .= ($pagina != NULL) ? "
        		limit ".$qtd*($pagina-1).", $qtd" : "";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = SessionIndicadorMAP::rsToObj($oReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

	/**
	 * Consultar instâncias da classe SessionIndicador
	 * 
	 * @param string $valor
	 * @return SessionIndicador[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".SessionIndicadorMAP::dataToSelect()." 
				from
					session_indicador 
				left join session 
					on (session_indicador.session_id = session.id)
                where
					".SessionIndicadorMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = SessionIndicadorMAP::rsToObj($oReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
    	catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

	/**
	 * Retorna o total de instâncias da classe SessionIndicador
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from session_indicador";
        try{
            $this->oConexao->execute($sql);
            $oReg = $this->oConexao->fetchRow();
            return (int) $oReg[0];
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }
}
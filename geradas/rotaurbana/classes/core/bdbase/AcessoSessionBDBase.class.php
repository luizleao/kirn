<?php
class AcessoSessionBDBase {
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
	 * Cadastrar instância da classe AcessoSession
	 * 
	 * @param AcessoSession $oAcessoSession
	 * @return integer|boolean
	 */	
    function cadastrar($oAcessoSession){
		$reg = AcessoSessionMAP::objToRs($oAcessoSession);
		$aCampo = array_keys($reg);
		$sql = "
				insert into acesso_session(
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
	 * Alterar instância da classe AcessoSession
	 * 
	 * @param AcessoSession $oAcessoSession
	 * @return boolean
	 */	
	function alterar($oAcessoSession){
    	$reg = AcessoSessionMAP::objToRs($oAcessoSession);
        $sql = "
                update 
                    acesso_session 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "sessions_id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    sessions_id = {$reg['sessions_id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "sessions_id") continue;
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
	 * Excluir instância da classe AcessoSession
	 * 
	 * @param integer $sessions_id
	 * @return boolean
	 */
	function excluir($sessions_id){
        $sql = "
                delete from
                    acesso_session 
                where
                    sessions_id = $sessions_id";

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
	 * Retorna instância da classe AcessoSession
	 * 
	 * @param integer $sessions_id
	 * @return AcessoSession|boolean
	 */
	function get($sessions_id){
        $sql = "
                select 
					".AcessoSessionMAP::dataToSelect()." 
                from
					acesso_session 
				left join acesso 
					on (acesso_session.acesso_id = acesso.id) 
                where
					acesso_session.sessions_id = $sessions_id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return AcessoSessionMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela AcessoSession
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return AcessoSession[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".AcessoSessionMAP::dataToSelect()." 
				from
					acesso_session 
				left join acesso 
					on (acesso_session.acesso_id = acesso.id)";
        
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
                    $aObj[] = AcessoSessionMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe AcessoSession
	 * 
	 * @param string $valor
	 * @return AcessoSession[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".AcessoSessionMAP::dataToSelect()." 
				from
					acesso_session 
				left join acesso 
					on (acesso_session.acesso_id = acesso.id)
                where
					".AcessoSessionMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = AcessoSessionMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe AcessoSession
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from acesso_session";
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
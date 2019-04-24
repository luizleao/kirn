<?php
class REGISTROACESSOBDBase {
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
	 * Cadastrar instância da classe REGISTROACESSO
	 * 
	 * @param REGISTROACESSO $oREGISTROACESSO
	 * @return integer|boolean
	 */	
    function cadastrar($oREGISTROACESSO){
		$reg = REGISTROACESSOMAP::objToRs($oREGISTROACESSO);
		$aCampo = array_keys($reg);
		$sql = "
				insert into REGISTRO_ACESSO(
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
			return $this->oConexao->lastID();
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	/**
	 * Alterar instância da classe REGISTROACESSO
	 * 
	 * @param REGISTROACESSO $oREGISTROACESSO
	 * @return boolean
	 */	
	function alterar($oREGISTROACESSO){
    	$reg = REGISTROACESSOMAP::objToRs($oREGISTROACESSO);
        $sql = "
                update 
                    REGISTRO_ACESSO 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    id = {$reg['id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "id") continue;
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
	 * Excluir instância da classe REGISTROACESSO
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    REGISTRO_ACESSO 
                where
                    id = $id";

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
	 * Retorna instância da classe REGISTROACESSO
	 * 
	 * @param integer $id
	 * @return REGISTROACESSO|boolean
	 */
	function get($id){
        $sql = "
                select 
					".REGISTROACESSOMAP::dataToSelect()." 
                from
					REGISTRO_ACESSO 
				left join PESSOA 
					on (REGISTRO_ACESSO.PESSOA_id = PESSOA.id)
				left join PERFIL_ACESSO 
					on (REGISTRO_ACESSO.PERFIL_ACESSO_id = PERFIL_ACESSO.id) 
                where
					REGISTRO_ACESSO.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return REGISTROACESSOMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela REGISTROACESSO
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return REGISTROACESSO[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".REGISTROACESSOMAP::dataToSelect()." 
				from
					REGISTRO_ACESSO 
				left join PESSOA 
					on (REGISTRO_ACESSO.PESSOA_id = PESSOA.id)
				left join PERFIL_ACESSO 
					on (REGISTRO_ACESSO.PERFIL_ACESSO_id = PERFIL_ACESSO.id)";
        
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
                    $aObj[] = REGISTROACESSOMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe REGISTROACESSO
	 * 
	 * @param string $valor
	 * @return REGISTROACESSO[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".REGISTROACESSOMAP::dataToSelect()." 
				from
					REGISTRO_ACESSO 
				left join PESSOA 
					on (REGISTRO_ACESSO.PESSOA_id = PESSOA.id)
				left join PERFIL_ACESSO 
					on (REGISTRO_ACESSO.PERFIL_ACESSO_id = PERFIL_ACESSO.id)
                where
					".REGISTROACESSOMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = REGISTROACESSOMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe REGISTROACESSO
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from REGISTRO_ACESSO";
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
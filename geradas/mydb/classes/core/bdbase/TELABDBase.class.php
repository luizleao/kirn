<?php
class TELABDBase {
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
	 * Cadastrar instância da classe TELA
	 * 
	 * @param TELA $oTELA
	 * @return integer|boolean
	 */	
    function cadastrar($oTELA){
		$reg = TELAMAP::objToRs($oTELA);
		$aCampo = array_keys($reg);
		$sql = "
				insert into TELA(
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
	 * Alterar instância da classe TELA
	 * 
	 * @param TELA $oTELA
	 * @return boolean
	 */	
	function alterar($oTELA){
    	$reg = TELAMAP::objToRs($oTELA);
        $sql = "
                update 
                    TELA 
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
	 * Excluir instância da classe TELA
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    TELA 
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
	 * Retorna instância da classe TELA
	 * 
	 * @param integer $id
	 * @return TELA|boolean
	 */
	function get($id){
        $sql = "
                select 
					".TELAMAP::dataToSelect()." 
                from
					TELA 
                where
					TELA.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return TELAMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela TELA
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return TELA[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".TELAMAP::dataToSelect()." 
				from
					TELA";
        
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
                    $aObj[] = TELAMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe TELA
	 * 
	 * @param string $valor
	 * @return TELA[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".TELAMAP::dataToSelect()." 
				from
					TELA
                where
					".TELAMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = TELAMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe TELA
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from TELA";
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
<?php
class JOGADORBDBase {
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
	 * Cadastrar instância da classe JOGADOR
	 * 
	 * @param JOGADOR $oJOGADOR
	 * @return integer|boolean
	 */	
    function cadastrar($oJOGADOR){
		$reg = JOGADORMAP::objToRs($oJOGADOR);
		$aCampo = array_keys($reg);
		$sql = "
				insert into JOGADOR(
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
	 * Alterar instância da classe JOGADOR
	 * 
	 * @param JOGADOR $oJOGADOR
	 * @return boolean
	 */	
	function alterar($oJOGADOR){
    	$reg = JOGADORMAP::objToRs($oJOGADOR);
        $sql = "
                update 
                    JOGADOR 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "cpf") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    cpf = {$reg['cpf']}";

        foreach($reg as $cv=>$vl){
            if($cv == "cpf") continue;
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
	 * Excluir instância da classe JOGADOR
	 * 
	 * @param integer $cpf
	 * @return boolean
	 */
	function excluir($cpf){
        $sql = "
                delete from
                    JOGADOR 
                where
                    cpf = $cpf";

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
	 * Retorna instância da classe JOGADOR
	 * 
	 * @param integer $cpf
	 * @return JOGADOR|boolean
	 */
	function get($cpf){
        $sql = "
                select 
					".JOGADORMAP::dataToSelect()." 
                from
					JOGADOR 
				left join TIME 
					on (JOGADOR.TIME_id = TIME.id) 
                where
					JOGADOR.cpf = $cpf";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return JOGADORMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela JOGADOR
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return JOGADOR[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".JOGADORMAP::dataToSelect()." 
				from
					JOGADOR 
				left join TIME 
					on (JOGADOR.TIME_id = TIME.id)";
        
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
                    $aObj[] = JOGADORMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe JOGADOR
	 * 
	 * @param string $valor
	 * @return JOGADOR[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".JOGADORMAP::dataToSelect()." 
				from
					JOGADOR 
				left join TIME 
					on (JOGADOR.TIME_id = TIME.id)
                where
					".JOGADORMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = JOGADORMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe JOGADOR
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from JOGADOR";
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
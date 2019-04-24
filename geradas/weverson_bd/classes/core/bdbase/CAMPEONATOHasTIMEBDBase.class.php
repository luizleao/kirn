<?php
class CAMPEONATOHasTIMEBDBase {
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
	 * Cadastrar instância da classe CAMPEONATOHasTIME
	 * 
	 * @param CAMPEONATOHasTIME $oCAMPEONATOHasTIME
	 * @return integer|boolean
	 */	
    function cadastrar($oCAMPEONATOHasTIME){
		$reg = CAMPEONATOHasTIMEMAP::objToRs($oCAMPEONATOHasTIME);
		$aCampo = array_keys($reg);
		$sql = "
				insert into CAMPEONATO_has_TIME(
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
	 * Alterar instância da classe CAMPEONATOHasTIME
	 * 
	 * @param CAMPEONATOHasTIME $oCAMPEONATOHasTIME
	 * @return boolean
	 */	
	function alterar($oCAMPEONATOHasTIME){
    	$reg = CAMPEONATOHasTIMEMAP::objToRs($oCAMPEONATOHasTIME);
        $sql = "
                update 
                    CAMPEONATO_has_TIME 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "CAMPEONATO_id" || $cv == "TIME_id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    CAMPEONATO_id = {$reg['CAMPEONATO_id']} 
					and TIME_id = {$reg['TIME_id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "CAMPEONATO_id" || $cv == "TIME_id") continue;
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
	 * Excluir instância da classe CAMPEONATOHasTIME
	 * 
	 * @param integer $CAMPEONATO_id,$TIME_id
	 * @return boolean
	 */
	function excluir($CAMPEONATO_id,$TIME_id){
        $sql = "
                delete from
                    CAMPEONATO_has_TIME 
                where
                    CAMPEONATO_id = $CAMPEONATO_id 
					and TIME_id = $TIME_id";

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
	 * Retorna instância da classe CAMPEONATOHasTIME
	 * 
	 * @param integer $CAMPEONATO_id,$TIME_id
	 * @return CAMPEONATOHasTIME|boolean
	 */
	function get($CAMPEONATO_id,$TIME_id){
        $sql = "
                select 
					".CAMPEONATOHasTIMEMAP::dataToSelect()." 
                from
					CAMPEONATO_has_TIME 
				left join CAMPEONATO 
					on (CAMPEONATO_has_TIME.CAMPEONATO_id = CAMPEONATO.id)
				left join TIME 
					on (CAMPEONATO_has_TIME.TIME_id = TIME.id) 
                where
					CAMPEONATO_has_TIME.CAMPEONATO_id = $CAMPEONATO_id 
					and CAMPEONATO_has_TIME.TIME_id = $TIME_id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return CAMPEONATOHasTIMEMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela CAMPEONATOHasTIME
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return CAMPEONATOHasTIME[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".CAMPEONATOHasTIMEMAP::dataToSelect()." 
				from
					CAMPEONATO_has_TIME 
				left join CAMPEONATO 
					on (CAMPEONATO_has_TIME.CAMPEONATO_id = CAMPEONATO.id)
				left join TIME 
					on (CAMPEONATO_has_TIME.TIME_id = TIME.id)";
        
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
                    $aObj[] = CAMPEONATOHasTIMEMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe CAMPEONATOHasTIME
	 * 
	 * @param string $valor
	 * @return CAMPEONATOHasTIME[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".CAMPEONATOHasTIMEMAP::dataToSelect()." 
				from
					CAMPEONATO_has_TIME 
				left join CAMPEONATO 
					on (CAMPEONATO_has_TIME.CAMPEONATO_id = CAMPEONATO.id)
				left join TIME 
					on (CAMPEONATO_has_TIME.TIME_id = TIME.id)
                where
					".CAMPEONATOHasTIMEMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = CAMPEONATOHasTIMEMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe CAMPEONATOHasTIME
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from CAMPEONATO_has_TIME";
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
<?php
class PatrimonioTicketBDBase {
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
	 * Cadastrar instância da classe PatrimonioTicket
	 * 
	 * @param PatrimonioTicket $oPatrimonioTicket
	 * @return integer|boolean
	 */	
    function cadastrar($oPatrimonioTicket){
		$reg = PatrimonioTicketMAP::objToRs($oPatrimonioTicket);
		$aCampo = array_keys($reg);
		$sql = "
				insert into PatrimonioTicket(
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
	 * Alterar instância da classe PatrimonioTicket
	 * 
	 * @param PatrimonioTicket $oPatrimonioTicket
	 * @return boolean
	 */	
	function alterar($oPatrimonioTicket){
    	$reg = PatrimonioTicketMAP::objToRs($oPatrimonioTicket);
        $sql = "
                update 
                    PatrimonioTicket 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idPatrimonioTicket") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idPatrimonioTicket = {$reg['idPatrimonioTicket']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idPatrimonioTicket") continue;
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
	 * Excluir instância da classe PatrimonioTicket
	 * 
	 * @param integer $idPatrimonioTicket
	 * @return boolean
	 */
	function excluir($idPatrimonioTicket){
        $sql = "
                delete from
                    PatrimonioTicket 
                where
                    idPatrimonioTicket = $idPatrimonioTicket";

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
	 * Retorna instância da classe PatrimonioTicket
	 * 
	 * @param integer $idPatrimonioTicket
	 * @return PatrimonioTicket|boolean
	 */
	function get($idPatrimonioTicket){
        $sql = "
                select 
					".PatrimonioTicketMAP::dataToSelect()." 
                from
					PatrimonioTicket 
				left join Ticket 
					on (PatrimonioTicket.idTicket = Ticket.idTicket) 
                where
					PatrimonioTicket.idPatrimonioTicket = $idPatrimonioTicket";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return PatrimonioTicketMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela PatrimonioTicket
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return PatrimonioTicket[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".PatrimonioTicketMAP::dataToSelect()." 
				from
					PatrimonioTicket 
				left join Ticket 
					on (PatrimonioTicket.idTicket = Ticket.idTicket)";
        
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
                    $aObj[] = PatrimonioTicketMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe PatrimonioTicket
	 * 
	 * @param string $valor
	 * @return PatrimonioTicket[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".PatrimonioTicketMAP::dataToSelect()." 
				from
					PatrimonioTicket 
				left join Ticket 
					on (PatrimonioTicket.idTicket = Ticket.idTicket)
                where
					".PatrimonioTicketMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = PatrimonioTicketMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe PatrimonioTicket
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from PatrimonioTicket";
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
<?php
class InsumoTicketBDBase {
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
	 * Cadastrar instância da classe InsumoTicket
	 * 
	 * @param InsumoTicket $oInsumoTicket
	 * @return integer|boolean
	 */	
    function cadastrar($oInsumoTicket){
		$reg = InsumoTicketMAP::objToRs($oInsumoTicket);
		$aCampo = array_keys($reg);
		$sql = "
				insert into InsumoTicket(
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
	 * Alterar instância da classe InsumoTicket
	 * 
	 * @param InsumoTicket $oInsumoTicket
	 * @return boolean
	 */	
	function alterar($oInsumoTicket){
    	$reg = InsumoTicketMAP::objToRs($oInsumoTicket);
        $sql = "
                update 
                    InsumoTicket 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idTicket" || $cv == "idInsumo") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idTicket = {$reg['idTicket']} 
					and idInsumo = {$reg['idInsumo']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idTicket" || $cv == "idInsumo") continue;
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
	 * Excluir instância da classe InsumoTicket
	 * 
	 * @param integer $idTicket,$idInsumo
	 * @return boolean
	 */
	function excluir($idTicket,$idInsumo){
        $sql = "
                delete from
                    InsumoTicket 
                where
                    idTicket = $idTicket 
					and idInsumo = $idInsumo";

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
	 * Retorna instância da classe InsumoTicket
	 * 
	 * @param integer $idTicket,$idInsumo
	 * @return InsumoTicket|boolean
	 */
	function get($idTicket,$idInsumo){
        $sql = "
                select 
					".InsumoTicketMAP::dataToSelect()." 
                from
					InsumoTicket 
				left join Ticket 
					on (InsumoTicket.idTicket = Ticket.idTicket)
				left join Insumo 
					on (InsumoTicket.idInsumo = Insumo.idInsumo) 
                where
					InsumoTicket.idTicket = $idTicket 
					and InsumoTicket.idInsumo = $idInsumo";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return InsumoTicketMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela InsumoTicket
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return InsumoTicket[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".InsumoTicketMAP::dataToSelect()." 
				from
					InsumoTicket 
				left join Ticket 
					on (InsumoTicket.idTicket = Ticket.idTicket)
				left join Insumo 
					on (InsumoTicket.idInsumo = Insumo.idInsumo)";
        
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
                    $aObj[] = InsumoTicketMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe InsumoTicket
	 * 
	 * @param string $valor
	 * @return InsumoTicket[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".InsumoTicketMAP::dataToSelect()." 
				from
					InsumoTicket 
				left join Ticket 
					on (InsumoTicket.idTicket = Ticket.idTicket)
				left join Insumo 
					on (InsumoTicket.idInsumo = Insumo.idInsumo)
                where
					".InsumoTicketMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = InsumoTicketMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe InsumoTicket
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from InsumoTicket";
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
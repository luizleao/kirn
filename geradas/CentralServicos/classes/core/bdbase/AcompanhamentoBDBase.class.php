<?php
class AcompanhamentoBDBase {
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
	 * Cadastrar instância da classe Acompanhamento
	 * 
	 * @param Acompanhamento $oAcompanhamento
	 * @return integer|boolean
	 */	
    function cadastrar($oAcompanhamento){
		$reg = AcompanhamentoMAP::objToRs($oAcompanhamento);
		$aCampo = array_keys($reg);
		$sql = "
				insert into Acompanhamento(
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
	 * Alterar instância da classe Acompanhamento
	 * 
	 * @param Acompanhamento $oAcompanhamento
	 * @return boolean
	 */	
	function alterar($oAcompanhamento){
    	$reg = AcompanhamentoMAP::objToRs($oAcompanhamento);
        $sql = "
                update 
                    Acompanhamento 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idAcompanhamento") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idAcompanhamento = {$reg['idAcompanhamento']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idAcompanhamento") continue;
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
	 * Excluir instância da classe Acompanhamento
	 * 
	 * @param integer $idAcompanhamento
	 * @return boolean
	 */
	function excluir($idAcompanhamento){
        $sql = "
                delete from
                    Acompanhamento 
                where
                    idAcompanhamento = $idAcompanhamento";

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
	 * Retorna instância da classe Acompanhamento
	 * 
	 * @param integer $idAcompanhamento
	 * @return Acompanhamento|boolean
	 */
	function get($idAcompanhamento){
        $sql = "
                select 
					".AcompanhamentoMAP::dataToSelect()." 
                from
					Acompanhamento 
				left join Ticket 
					on (Acompanhamento.idTicket = Ticket.idTicket) 
                where
					Acompanhamento.idAcompanhamento = $idAcompanhamento";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return AcompanhamentoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Acompanhamento
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Acompanhamento[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".AcompanhamentoMAP::dataToSelect()." 
				from
					Acompanhamento 
				left join Ticket 
					on (Acompanhamento.idTicket = Ticket.idTicket)";
        
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
                    $aObj[] = AcompanhamentoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Acompanhamento
	 * 
	 * @param string $valor
	 * @return Acompanhamento[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".AcompanhamentoMAP::dataToSelect()." 
				from
					Acompanhamento 
				left join Ticket 
					on (Acompanhamento.idTicket = Ticket.idTicket)
                where
					".AcompanhamentoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = AcompanhamentoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Acompanhamento
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from Acompanhamento";
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
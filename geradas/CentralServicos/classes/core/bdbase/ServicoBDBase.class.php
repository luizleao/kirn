<?php
class ServicoBDBase {
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
	 * Cadastrar instância da classe Servico
	 * 
	 * @param Servico $oServico
	 * @return integer|boolean
	 */	
    function cadastrar($oServico){
		$reg = ServicoMAP::objToRs($oServico);
		$aCampo = array_keys($reg);
		$sql = "
				insert into Servico(
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
	 * Alterar instância da classe Servico
	 * 
	 * @param Servico $oServico
	 * @return boolean
	 */	
	function alterar($oServico){
    	$reg = ServicoMAP::objToRs($oServico);
        $sql = "
                update 
                    Servico 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idServico") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idServico = {$reg['idServico']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idServico") continue;
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
	 * Excluir instância da classe Servico
	 * 
	 * @param integer $idServico
	 * @return boolean
	 */
	function excluir($idServico){
        $sql = "
                delete from
                    Servico 
                where
                    idServico = $idServico";

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
	 * Retorna instância da classe Servico
	 * 
	 * @param integer $idServico
	 * @return Servico|boolean
	 */
	function get($idServico){
        $sql = "
                select 
					".ServicoMAP::dataToSelect()." 
                from
					Servico 
				left join Sla 
					on (Servico.idSla = Sla.idSla)
				left join TipoServico 
					on (Servico.idTipoServico = TipoServico.idTipoServico) 
                where
					Servico.idServico = $idServico";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return ServicoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Servico
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Servico[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".ServicoMAP::dataToSelect()." 
				from
					Servico 
				left join Sla 
					on (Servico.idSla = Sla.idSla)
				left join TipoServico 
					on (Servico.idTipoServico = TipoServico.idTipoServico)";
        
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
                    $aObj[] = ServicoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Servico
	 * 
	 * @param string $valor
	 * @return Servico[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".ServicoMAP::dataToSelect()." 
				from
					Servico 
				left join Sla 
					on (Servico.idSla = Sla.idSla)
				left join TipoServico 
					on (Servico.idTipoServico = TipoServico.idTipoServico)
                where
					".ServicoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = ServicoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Servico
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from Servico";
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
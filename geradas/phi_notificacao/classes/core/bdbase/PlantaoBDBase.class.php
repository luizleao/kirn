<?php
class PlantaoBDBase {
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
	 * Cadastrar instância da classe Plantao
	 * 
	 * @param Plantao $oPlantao
	 * @return integer|boolean
	 */	
    function cadastrar($oPlantao){
		$reg = PlantaoMAP::objToRs($oPlantao);
		$aCampo = array_keys($reg);
		$sql = "
				insert into plantao(
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
	 * Alterar instância da classe Plantao
	 * 
	 * @param Plantao $oPlantao
	 * @return boolean
	 */	
	function alterar($oPlantao){
    	$reg = PlantaoMAP::objToRs($oPlantao);
        $sql = "
                update 
                    plantao 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "p_id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    p_id = {$reg['p_id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "p_id") continue;
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
	 * Excluir instância da classe Plantao
	 * 
	 * @param integer $p_id
	 * @return boolean
	 */
	function excluir($p_id){
        $sql = "
                delete from
                    plantao 
                where
                    p_id = $p_id";

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
	 * Retorna instância da classe Plantao
	 * 
	 * @param integer $p_id
	 * @return Plantao|boolean
	 */
	function get($p_id){
        $sql = "
                select 
					".PlantaoMAP::dataToSelect()." 
                from
					plantao 
				left join usuario 
					on (plantao.p_usuario_id = usuario.id)
				left join sensor 
					on (plantao.p_id_sensor = sensor.id_sensor) 
                where
					plantao.p_id = $p_id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return PlantaoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Plantao
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Plantao[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".PlantaoMAP::dataToSelect()." 
				from
					plantao 
				left join usuario 
					on (plantao.p_usuario_id = usuario.id)
				left join sensor 
					on (plantao.p_id_sensor = sensor.id_sensor)";
        
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
                    $aObj[] = PlantaoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Plantao
	 * 
	 * @param string $valor
	 * @return Plantao[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".PlantaoMAP::dataToSelect()." 
				from
					plantao 
				left join usuario 
					on (plantao.p_usuario_id = usuario.id)
				left join sensor 
					on (plantao.p_id_sensor = sensor.id_sensor)
                where
					".PlantaoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = PlantaoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Plantao
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from plantao";
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
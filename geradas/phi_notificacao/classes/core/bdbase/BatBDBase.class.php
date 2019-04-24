<?php
class BatBDBase {
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
	 * Cadastrar instância da classe Bat
	 * 
	 * @param Bat $oBat
	 * @return integer|boolean
	 */	
    function cadastrar($oBat){
		$reg = BatMAP::objToRs($oBat);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bat(
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
	 * Alterar instância da classe Bat
	 * 
	 * @param Bat $oBat
	 * @return boolean
	 */	
	function alterar($oBat){
    	$reg = BatMAP::objToRs($oBat);
        $sql = "
                update 
                    bat 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "id_bat") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    id_bat = {$reg['id_bat']}";

        foreach($reg as $cv=>$vl){
            if($cv == "id_bat") continue;
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
	 * Excluir instância da classe Bat
	 * 
	 * @param integer $id_bat
	 * @return boolean
	 */
	function excluir($id_bat){
        $sql = "
                delete from
                    bat 
                where
                    id_bat = $id_bat";

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
	 * Retorna instância da classe Bat
	 * 
	 * @param integer $id_bat
	 * @return Bat|boolean
	 */
	function get($id_bat){
        $sql = "
                select 
					".BatMAP::dataToSelect()." 
                from
					bat 
				left join sensor 
					on (bat.locasens = sensor.id_sensor)
				left join usuario 
					on (bat.pessoa = usuario.id) 
                where
					bat.id_bat = $id_bat";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BatMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Bat
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Bat[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BatMAP::dataToSelect()." 
				from
					bat 
				left join sensor 
					on (bat.locasens = sensor.id_sensor)
				left join usuario 
					on (bat.pessoa = usuario.id)";
        
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
                    $aObj[] = BatMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Bat
	 * 
	 * @param string $valor
	 * @return Bat[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BatMAP::dataToSelect()." 
				from
					bat 
				left join sensor 
					on (bat.locasens = sensor.id_sensor)
				left join usuario 
					on (bat.pessoa = usuario.id)
                where
					".BatMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BatMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Bat
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bat";
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
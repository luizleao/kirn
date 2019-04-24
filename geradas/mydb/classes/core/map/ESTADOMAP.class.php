<?php
class ESTADOMAP {
	static function getMetaData() {
		return ['ESTADO' => ['id', 
						'nome', 
						'PAIS_id', 
						'uf'], 
				'PAIS' => [						'id', 
						'nome', 
						'sigla']];
	}

	static function dataToSelect() {
        foreach(self::getMetaData() as $tabela => $aCampo){
            foreach($aCampo as $sCampo){
                $aux[] = "$tabela.$sCampo as $tabela"."_$sCampo";
            }
        }
        
        return implode(",\n", $aux);
    }
    
    static function filterLike($valor) {
        foreach(self::getMetaData() as $tabela => $aCampo){
            foreach($aCampo as $sCampo){
                $aux[] = "$tabela.$sCampo like '$valor'";
            }
        }
        
        return implode("\nor ", $aux);
    }

	static function objToRs($oESTADO){
		$reg['id'] = $oESTADO->id;
		$reg['nome'] = $oESTADO->nome;
		$oPAIS = $oESTADO->oPAIS;
		$reg['PAIS_id'] = $oPAIS->id;
		$reg['uf'] = $oESTADO->uf;
		return $reg;		   
	}

	static function objToRsInsert($oESTADO){
		$reg['nome'] = $oESTADO->nome;
		$oPAIS = $oESTADO->oPAIS;
		$reg['PAIS_id'] = $oPAIS->id;
		$reg['uf'] = $oESTADO->uf;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oESTADO = new ESTADO();
		$oESTADO->id = $reg['ESTADO_id'];
		$oESTADO->nome = $reg['ESTADO_nome'];

		$oPAIS = new PAIS();
		$oPAIS->id = $reg['PAIS_id'];
		$oPAIS->nome = $reg['PAIS_nome'];
		$oPAIS->sigla = $reg['PAIS_sigla'];
		$oESTADO->oPAIS = $oPAIS;
		$oESTADO->uf = $reg['ESTADO_uf'];
		return $oESTADO;		   
	}
}

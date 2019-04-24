<?php
class PAISMAP {
	static function getMetaData() {
		return ['PAIS' => ['id', 
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

	static function objToRs($oPAIS){
		$reg['id'] = $oPAIS->id;
		$reg['nome'] = $oPAIS->nome;
		$reg['sigla'] = $oPAIS->sigla;
		return $reg;		   
	}

	static function objToRsInsert($oPAIS){
		$reg['nome'] = $oPAIS->nome;
		$reg['sigla'] = $oPAIS->sigla;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPAIS = new PAIS();
		$oPAIS->id = $reg['PAIS_id'];
		$oPAIS->nome = $reg['PAIS_nome'];
		$oPAIS->sigla = $reg['PAIS_sigla'];
		return $oPAIS;		   
	}
}

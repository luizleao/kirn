<?php
class ConsultasnatelainicialandroidMAP {
	static function getMetaData() {
		return ['consultasnatelainicialandroid' => ['id', 
						'contador', 
						'idAndroid']];
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

	static function objToRs($oConsultasnatelainicialandroid){
		$reg['id'] = $oConsultasnatelainicialandroid->id;
		$reg['contador'] = $oConsultasnatelainicialandroid->contador;
		$reg['idAndroid'] = $oConsultasnatelainicialandroid->idAndroid;
		return $reg;		   
	}

	static function objToRsInsert($oConsultasnatelainicialandroid){
		$reg['contador'] = $oConsultasnatelainicialandroid->contador;
		$reg['idAndroid'] = $oConsultasnatelainicialandroid->idAndroid;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oConsultasnatelainicialandroid = new Consultasnatelainicialandroid();
		$oConsultasnatelainicialandroid->id = $reg['consultasnatelainicialandroid_id'];
		$oConsultasnatelainicialandroid->contador = $reg['consultasnatelainicialandroid_contador'];
		$oConsultasnatelainicialandroid->idAndroid = $reg['consultasnatelainicialandroid_idAndroid'];
		return $oConsultasnatelainicialandroid;		   
	}
}

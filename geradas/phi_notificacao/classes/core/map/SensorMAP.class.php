<?php
class SensorMAP {
	static function getMetaData() {
		return ['sensor' => ['id_sensor', 
						'localizacao', 
						'descricao']];
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

	static function objToRs($oSensor){
		$reg['id_sensor'] = $oSensor->id_sensor;
		$reg['localizacao'] = $oSensor->localizacao;
		$reg['descricao'] = $oSensor->descricao;
		return $reg;		   
	}

	static function objToRsInsert($oSensor){
		$reg['localizacao'] = $oSensor->localizacao;
		$reg['descricao'] = $oSensor->descricao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oSensor = new Sensor();
		$oSensor->id_sensor = $reg['sensor_id_sensor'];
		$oSensor->localizacao = $reg['sensor_localizacao'];
		$oSensor->descricao = $reg['sensor_descricao'];
		return $oSensor;		   
	}
}

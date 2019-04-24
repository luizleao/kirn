<?php
class BatMAP {
	static function getMetaData() {
		return ['bat' => ['id_bat', 
						'locasens', 
						'pessoa', 
						'descricao', 
						'data', 
						'raiva'], 
				'sensor' => [						'id_sensor', 
						'localizacao', 
						'descricao'], 
				'usuario' => [						'id', 
						'nome', 
						'status', 
						'id_contato']];
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

	static function objToRs($oBat){
		$reg['id_bat'] = $oBat->id_bat;
		$oSensor = $oBat->oSensor;
		$reg['locasens'] = $oSensor->id_sensor;
		$oUsuario = $oBat->oUsuario;
		$reg['pessoa'] = $oUsuario->id;
		$reg['descricao'] = $oBat->descricao;
		$reg['data'] = $oBat->data;
		$reg['raiva'] = $oBat->raiva;
		return $reg;		   
	}

	static function objToRsInsert($oBat){
		$oSensor = $oBat->oSensor;
		$reg['locasens'] = $oSensor->id_sensor;
		$oUsuario = $oBat->oUsuario;
		$reg['pessoa'] = $oUsuario->id;
		$reg['descricao'] = $oBat->descricao;
		$reg['data'] = $oBat->data;
		$reg['raiva'] = $oBat->raiva;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBat = new Bat();
		$oBat->id_bat = $reg['bat_id_bat'];

		$oSensor = new Sensor();
		$oSensor->id_sensor = $reg['sensor_id_sensor'];
		$oSensor->localizacao = $reg['sensor_localizacao'];
		$oSensor->descricao = $reg['sensor_descricao'];
		$oBat->oSensor = $oSensor;

		$oUsuario = new Usuario();
		$oUsuario->id = $reg['usuario_id'];
		$oUsuario->nome = $reg['usuario_nome'];
		$oUsuario->status = $reg['usuario_status'];
		$oBat->oUsuario = $oUsuario;
		$oBat->descricao = $reg['bat_descricao'];
		$oBat->data = $reg['bat_data'];
		$oBat->raiva = $reg['bat_raiva'];
		return $oBat;		   
	}
}

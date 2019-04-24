<?php
class PlantaoMAP {
	static function getMetaData() {
		return ['plantao' => ['p_id', 
						'p_usuario_id', 
						'p_id_sensor', 
						'datai', 
						'dataf'], 
				'usuario' => [						'id', 
						'nome', 
						'status', 
						'id_contato'], 
				'sensor' => [						'id_sensor', 
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

	static function objToRs($oPlantao){
		$reg['p_id'] = $oPlantao->p_id;
		$oUsuario = $oPlantao->oUsuario;
		$reg['p_usuario_id'] = $oUsuario->id;
		$oSensor = $oPlantao->oSensor;
		$reg['p_id_sensor'] = $oSensor->id_sensor;
		$reg['datai'] = $oPlantao->datai;
		$reg['dataf'] = $oPlantao->dataf;
		return $reg;		   
	}

	static function objToRsInsert($oPlantao){
		$oUsuario = $oPlantao->oUsuario;
		$reg['p_usuario_id'] = $oUsuario->id;
		$oSensor = $oPlantao->oSensor;
		$reg['p_id_sensor'] = $oSensor->id_sensor;
		$reg['datai'] = $oPlantao->datai;
		$reg['dataf'] = $oPlantao->dataf;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPlantao = new Plantao();
		$oPlantao->p_id = $reg['plantao_p_id'];

		$oUsuario = new Usuario();
		$oUsuario->id = $reg['usuario_id'];
		$oUsuario->nome = $reg['usuario_nome'];
		$oUsuario->status = $reg['usuario_status'];
		$oPlantao->oUsuario = $oUsuario;

		$oSensor = new Sensor();
		$oSensor->id_sensor = $reg['sensor_id_sensor'];
		$oSensor->localizacao = $reg['sensor_localizacao'];
		$oSensor->descricao = $reg['sensor_descricao'];
		$oPlantao->oSensor = $oSensor;
		$oPlantao->datai = $reg['plantao_datai'];
		$oPlantao->dataf = $reg['plantao_dataf'];
		return $oPlantao;		   
	}
}

<?php
class LogVoicerMAP {
	static function getMetaData() {
		return ['log_voicer' => ['id', 
						'compreendido', 
						'idUsuario', 
						'menuAtual', 
						'momento', 
						'resultado']];
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

	static function objToRs($oLogVoicer){
		$reg['id'] = $oLogVoicer->id;
		$reg['compreendido'] = $oLogVoicer->compreendido;
		$reg['idUsuario'] = $oLogVoicer->idUsuario;
		$reg['menuAtual'] = $oLogVoicer->menuAtual;
		$reg['momento'] = $oLogVoicer->momento;
		$reg['resultado'] = $oLogVoicer->resultado;
		return $reg;		   
	}

	static function objToRsInsert($oLogVoicer){
		$reg['compreendido'] = $oLogVoicer->compreendido;
		$reg['idUsuario'] = $oLogVoicer->idUsuario;
		$reg['menuAtual'] = $oLogVoicer->menuAtual;
		$reg['momento'] = $oLogVoicer->momento;
		$reg['resultado'] = $oLogVoicer->resultado;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oLogVoicer = new LogVoicer();
		$oLogVoicer->id = $reg['log_voicer_id'];
		$oLogVoicer->compreendido = $reg['log_voicer_compreendido'];
		$oLogVoicer->idUsuario = $reg['log_voicer_idUsuario'];
		$oLogVoicer->menuAtual = $reg['log_voicer_menuAtual'];
		$oLogVoicer->momento = $reg['log_voicer_momento'];
		$oLogVoicer->resultado = $reg['log_voicer_resultado'];
		return $oLogVoicer;		   
	}
}

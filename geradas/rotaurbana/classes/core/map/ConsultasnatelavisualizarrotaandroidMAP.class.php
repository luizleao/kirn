<?php
class ConsultasnatelavisualizarrotaandroidMAP {
	static function getMetaData() {
		return ['consultasnatelavisualizarrotaandroid' => ['id', 
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

	static function objToRs($oConsultasnatelavisualizarrotaandroid){
		$reg['id'] = $oConsultasnatelavisualizarrotaandroid->id;
		$reg['contador'] = $oConsultasnatelavisualizarrotaandroid->contador;
		$reg['idAndroid'] = $oConsultasnatelavisualizarrotaandroid->idAndroid;
		return $reg;		   
	}

	static function objToRsInsert($oConsultasnatelavisualizarrotaandroid){
		$reg['contador'] = $oConsultasnatelavisualizarrotaandroid->contador;
		$reg['idAndroid'] = $oConsultasnatelavisualizarrotaandroid->idAndroid;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oConsultasnatelavisualizarrotaandroid = new Consultasnatelavisualizarrotaandroid();
		$oConsultasnatelavisualizarrotaandroid->id = $reg['consultasnatelavisualizarrotaandroid_id'];
		$oConsultasnatelavisualizarrotaandroid->contador = $reg['consultasnatelavisualizarrotaandroid_contador'];
		$oConsultasnatelavisualizarrotaandroid->idAndroid = $reg['consultasnatelavisualizarrotaandroid_idAndroid'];
		return $oConsultasnatelavisualizarrotaandroid;		   
	}
}

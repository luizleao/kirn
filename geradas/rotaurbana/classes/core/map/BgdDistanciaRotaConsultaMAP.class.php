<?php
class BgdDistanciaRotaConsultaMAP {
	static function getMetaData() {
		return ['bgd_distancia_rota_consulta' => ['id', 
						'data_captura', 
						'distancia', 
						'fk_bgd_cidade', 
						'fk_bgd_linha', 
						'fonte'], 
				'bgd_cidade' => [						'id', 
						'nome'], 
				'bgd_linha' => [						'id', 
						'codigo', 
						'comentario', 
						'nome']];
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

	static function objToRs($oBgdDistanciaRotaConsulta){
		$reg['id'] = $oBgdDistanciaRotaConsulta->id;
		$reg['data_captura'] = $oBgdDistanciaRotaConsulta->data_captura;
		$reg['distancia'] = $oBgdDistanciaRotaConsulta->distancia;
		$oBgdCidade = $oBgdDistanciaRotaConsulta->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdDistanciaRotaConsulta->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$reg['fonte'] = $oBgdDistanciaRotaConsulta->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdDistanciaRotaConsulta){
		$reg['data_captura'] = $oBgdDistanciaRotaConsulta->data_captura;
		$reg['distancia'] = $oBgdDistanciaRotaConsulta->distancia;
		$oBgdCidade = $oBgdDistanciaRotaConsulta->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdDistanciaRotaConsulta->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$reg['fonte'] = $oBgdDistanciaRotaConsulta->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdDistanciaRotaConsulta = new BgdDistanciaRotaConsulta();
		$oBgdDistanciaRotaConsulta->id = $reg['bgd_distancia_rota_consulta_id'];
		$oBgdDistanciaRotaConsulta->data_captura = $reg['bgd_distancia_rota_consulta_data_captura'];
		$oBgdDistanciaRotaConsulta->distancia = $reg['bgd_distancia_rota_consulta_distancia'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdDistanciaRotaConsulta->oBgdCidade = $oBgdCidade;

		$oBgdLinha = new BgdLinha();
		$oBgdLinha->id = $reg['bgd_linha_id'];
		$oBgdLinha->codigo = $reg['bgd_linha_codigo'];
		$oBgdLinha->comentario = $reg['bgd_linha_comentario'];
		$oBgdLinha->nome = $reg['bgd_linha_nome'];
		$oBgdDistanciaRotaConsulta->oBgdLinha = $oBgdLinha;
		$oBgdDistanciaRotaConsulta->fonte = $reg['bgd_distancia_rota_consulta_fonte'];
		return $oBgdDistanciaRotaConsulta;		   
	}
}

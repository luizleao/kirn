<?php
class BgdDistanciaRotaSelecionadaMAP {
	static function getMetaData() {
		return ['bgd_distancia_rota_selecionada' => ['id', 
						'data_captura', 
						'distancia', 
						'fk_bgd_cidade', 
						'fk_bgd_cidade_prox_usuario', 
						'fk_bgd_linha', 
						'lat_proxma_usuario', 
						'lng_proxma_usuario', 
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

	static function objToRs($oBgdDistanciaRotaSelecionada){
		$reg['id'] = $oBgdDistanciaRotaSelecionada->id;
		$reg['data_captura'] = $oBgdDistanciaRotaSelecionada->data_captura;
		$reg['distancia'] = $oBgdDistanciaRotaSelecionada->distancia;
		$oBgdCidade = $oBgdDistanciaRotaSelecionada->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdDistanciaRotaSelecionada->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdDistanciaRotaSelecionada->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$reg['lat_proxma_usuario'] = $oBgdDistanciaRotaSelecionada->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdDistanciaRotaSelecionada->lng_proxma_usuario;
		$reg['fonte'] = $oBgdDistanciaRotaSelecionada->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdDistanciaRotaSelecionada){
		$reg['data_captura'] = $oBgdDistanciaRotaSelecionada->data_captura;
		$reg['distancia'] = $oBgdDistanciaRotaSelecionada->distancia;
		$oBgdCidade = $oBgdDistanciaRotaSelecionada->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdDistanciaRotaSelecionada->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdDistanciaRotaSelecionada->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$reg['lat_proxma_usuario'] = $oBgdDistanciaRotaSelecionada->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdDistanciaRotaSelecionada->lng_proxma_usuario;
		$reg['fonte'] = $oBgdDistanciaRotaSelecionada->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdDistanciaRotaSelecionada = new BgdDistanciaRotaSelecionada();
		$oBgdDistanciaRotaSelecionada->id = $reg['bgd_distancia_rota_selecionada_id'];
		$oBgdDistanciaRotaSelecionada->data_captura = $reg['bgd_distancia_rota_selecionada_data_captura'];
		$oBgdDistanciaRotaSelecionada->distancia = $reg['bgd_distancia_rota_selecionada_distancia'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdDistanciaRotaSelecionada->oBgdCidade = $oBgdCidade;

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdDistanciaRotaSelecionada->oBgdCidade = $oBgdCidade;

		$oBgdLinha = new BgdLinha();
		$oBgdLinha->id = $reg['bgd_linha_id'];
		$oBgdLinha->codigo = $reg['bgd_linha_codigo'];
		$oBgdLinha->comentario = $reg['bgd_linha_comentario'];
		$oBgdLinha->nome = $reg['bgd_linha_nome'];
		$oBgdDistanciaRotaSelecionada->oBgdLinha = $oBgdLinha;
		$oBgdDistanciaRotaSelecionada->lat_proxma_usuario = $reg['bgd_distancia_rota_selecionada_lat_proxma_usuario'];
		$oBgdDistanciaRotaSelecionada->lng_proxma_usuario = $reg['bgd_distancia_rota_selecionada_lng_proxma_usuario'];
		$oBgdDistanciaRotaSelecionada->fonte = $reg['bgd_distancia_rota_selecionada_fonte'];
		return $oBgdDistanciaRotaSelecionada;		   
	}
}

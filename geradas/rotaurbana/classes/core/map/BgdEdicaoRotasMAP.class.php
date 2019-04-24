<?php
class BgdEdicaoRotasMAP {
	static function getMetaData() {
		return ['bgd_edicao_rotas' => ['id', 
						'codigoLinha', 
						'comentarioLinha', 
						'data_captura', 
						'nomeLinhas', 
						'fk_bgd_cidade', 
						'fk_bgd_cidade_prox_usuario', 
						'fk_bgd_linha', 
						'fk_bgd_usuario', 
						'lat_proxma_usuario', 
						'lng_proxma_usuario', 
						'fonte'], 
				'bgd_cidade' => [						'id', 
						'nome'], 
				'bgd_linha' => [						'id', 
						'codigo', 
						'comentario', 
						'nome'], 
				'bgd_usuario' => [						'id', 
						'email', 
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

	static function objToRs($oBgdEdicaoRotas){
		$reg['id'] = $oBgdEdicaoRotas->id;
		$reg['codigoLinha'] = $oBgdEdicaoRotas->codigoLinha;
		$reg['comentarioLinha'] = $oBgdEdicaoRotas->comentarioLinha;
		$reg['data_captura'] = $oBgdEdicaoRotas->data_captura;
		$reg['nomeLinhas'] = $oBgdEdicaoRotas->nomeLinhas;
		$oBgdCidade = $oBgdEdicaoRotas->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdEdicaoRotas->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdEdicaoRotas->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$oBgdUsuario = $oBgdEdicaoRotas->oBgdUsuario;
		$reg['fk_bgd_usuario'] = $oBgdUsuario->id;
		$reg['lat_proxma_usuario'] = $oBgdEdicaoRotas->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdEdicaoRotas->lng_proxma_usuario;
		$reg['fonte'] = $oBgdEdicaoRotas->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdEdicaoRotas){
		$reg['codigoLinha'] = $oBgdEdicaoRotas->codigoLinha;
		$reg['comentarioLinha'] = $oBgdEdicaoRotas->comentarioLinha;
		$reg['data_captura'] = $oBgdEdicaoRotas->data_captura;
		$reg['nomeLinhas'] = $oBgdEdicaoRotas->nomeLinhas;
		$oBgdCidade = $oBgdEdicaoRotas->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdEdicaoRotas->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdEdicaoRotas->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$oBgdUsuario = $oBgdEdicaoRotas->oBgdUsuario;
		$reg['fk_bgd_usuario'] = $oBgdUsuario->id;
		$reg['lat_proxma_usuario'] = $oBgdEdicaoRotas->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdEdicaoRotas->lng_proxma_usuario;
		$reg['fonte'] = $oBgdEdicaoRotas->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdEdicaoRotas = new BgdEdicaoRotas();
		$oBgdEdicaoRotas->id = $reg['bgd_edicao_rotas_id'];
		$oBgdEdicaoRotas->codigoLinha = $reg['bgd_edicao_rotas_codigoLinha'];
		$oBgdEdicaoRotas->comentarioLinha = $reg['bgd_edicao_rotas_comentarioLinha'];
		$oBgdEdicaoRotas->data_captura = $reg['bgd_edicao_rotas_data_captura'];
		$oBgdEdicaoRotas->nomeLinhas = $reg['bgd_edicao_rotas_nomeLinhas'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdEdicaoRotas->oBgdCidade = $oBgdCidade;

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdEdicaoRotas->oBgdCidade = $oBgdCidade;

		$oBgdLinha = new BgdLinha();
		$oBgdLinha->id = $reg['bgd_linha_id'];
		$oBgdLinha->codigo = $reg['bgd_linha_codigo'];
		$oBgdLinha->comentario = $reg['bgd_linha_comentario'];
		$oBgdLinha->nome = $reg['bgd_linha_nome'];
		$oBgdEdicaoRotas->oBgdLinha = $oBgdLinha;

		$oBgdUsuario = new BgdUsuario();
		$oBgdUsuario->id = $reg['bgd_usuario_id'];
		$oBgdUsuario->email = $reg['bgd_usuario_email'];
		$oBgdUsuario->nome = $reg['bgd_usuario_nome'];
		$oBgdEdicaoRotas->oBgdUsuario = $oBgdUsuario;
		$oBgdEdicaoRotas->lat_proxma_usuario = $reg['bgd_edicao_rotas_lat_proxma_usuario'];
		$oBgdEdicaoRotas->lng_proxma_usuario = $reg['bgd_edicao_rotas_lng_proxma_usuario'];
		$oBgdEdicaoRotas->fonte = $reg['bgd_edicao_rotas_fonte'];
		return $oBgdEdicaoRotas;		   
	}
}

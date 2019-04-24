<?php
class PrestadorMAP {
	static function getMetaData() {
		return ['Prestador' => ['idPrestador', 
						'idNaturezaContratual', 
						'nome', 
						'numeroContrato', 
						'nomePreposto', 
						'contatoPreposto', 
						'usuario', 
						'senha', 
						'email', 
						'status'], 
				'NaturezaContratual' => [						'idNaturezaContratual', 
						'descricao', 
						'status']];
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

	static function objToRs($oPrestador){
		$reg['idPrestador'] = $oPrestador->idPrestador;
		$oNaturezaContratual = $oPrestador->oNaturezaContratual;
		$reg['idNaturezaContratual'] = $oNaturezaContratual->idNaturezaContratual;
		$reg['nome'] = $oPrestador->nome;
		$reg['numeroContrato'] = $oPrestador->numeroContrato;
		$reg['nomePreposto'] = $oPrestador->nomePreposto;
		$reg['contatoPreposto'] = $oPrestador->contatoPreposto;
		$reg['usuario'] = $oPrestador->usuario;
		$reg['senha'] = $oPrestador->senha;
		$reg['email'] = $oPrestador->email;
		$reg['status'] = $oPrestador->status;
		return $reg;		   
	}

	static function objToRsInsert($oPrestador){
		$oNaturezaContratual = $oPrestador->oNaturezaContratual;
		$reg['idNaturezaContratual'] = $oNaturezaContratual->idNaturezaContratual;
		$reg['nome'] = $oPrestador->nome;
		$reg['numeroContrato'] = $oPrestador->numeroContrato;
		$reg['nomePreposto'] = $oPrestador->nomePreposto;
		$reg['contatoPreposto'] = $oPrestador->contatoPreposto;
		$reg['usuario'] = $oPrestador->usuario;
		$reg['senha'] = $oPrestador->senha;
		$reg['email'] = $oPrestador->email;
		$reg['status'] = $oPrestador->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPrestador = new Prestador();
		$oPrestador->idPrestador = $reg['Prestador_idPrestador'];

		$oNaturezaContratual = new NaturezaContratual();
		$oNaturezaContratual->idNaturezaContratual = $reg['NaturezaContratual_idNaturezaContratual'];
		$oNaturezaContratual->descricao = $reg['NaturezaContratual_descricao'];
		$oNaturezaContratual->status = $reg['NaturezaContratual_status'];
		$oPrestador->oNaturezaContratual = $oNaturezaContratual;
		$oPrestador->nome = $reg['Prestador_nome'];
		$oPrestador->numeroContrato = $reg['Prestador_numeroContrato'];
		$oPrestador->nomePreposto = $reg['Prestador_nomePreposto'];
		$oPrestador->contatoPreposto = $reg['Prestador_contatoPreposto'];
		$oPrestador->usuario = $reg['Prestador_usuario'];
		$oPrestador->senha = $reg['Prestador_senha'];
		$oPrestador->email = $reg['Prestador_email'];
		$oPrestador->status = $reg['Prestador_status'];
		return $oPrestador;		   
	}
}

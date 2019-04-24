<?php
class ServicoMAP {
	static function getMetaData() {
		return ['Servico' => ['idServico', 
						'idSla', 
						'idTipoServico', 
						'descricao', 
						'valor', 
						'status'], 
				'Sla' => [						'idSla', 
						'descricao', 
						'status'], 
				'TipoServico' => [						'idTipoServico', 
						'idNaturezaContratual', 
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

	static function objToRs($oServico){
		$reg['idServico'] = $oServico->idServico;
		$oSla = $oServico->oSla;
		$reg['idSla'] = $oSla->idSla;
		$oTipoServico = $oServico->oTipoServico;
		$reg['idTipoServico'] = $oTipoServico->idTipoServico;
		$reg['descricao'] = $oServico->descricao;
		$reg['valor'] = $oServico->valor;
		$reg['status'] = $oServico->status;
		return $reg;		   
	}

	static function objToRsInsert($oServico){
		$oSla = $oServico->oSla;
		$reg['idSla'] = $oSla->idSla;
		$oTipoServico = $oServico->oTipoServico;
		$reg['idTipoServico'] = $oTipoServico->idTipoServico;
		$reg['descricao'] = $oServico->descricao;
		$reg['valor'] = $oServico->valor;
		$reg['status'] = $oServico->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oServico = new Servico();
		$oServico->idServico = $reg['Servico_idServico'];

		$oSla = new Sla();
		$oSla->idSla = $reg['Sla_idSla'];
		$oSla->descricao = $reg['Sla_descricao'];
		$oSla->status = $reg['Sla_status'];
		$oServico->oSla = $oSla;

		$oTipoServico = new TipoServico();
		$oTipoServico->idTipoServico = $reg['TipoServico_idTipoServico'];
		$oTipoServico->descricao = $reg['TipoServico_descricao'];
		$oTipoServico->status = $reg['TipoServico_status'];
		$oServico->oTipoServico = $oTipoServico;
		$oServico->descricao = $reg['Servico_descricao'];
		$oServico->valor = $reg['Servico_valor'];
		$oServico->status = $reg['Servico_status'];
		return $oServico;		   
	}
}

<?php
class AcompanhamentoMAP {
	static function getMetaData() {
		return ['Acompanhamento' => ['idAcompanhamento', 
						'idTicket', 
						'descricao', 
						'dataHora', 
						'usuario', 
						'status'], 
				'Ticket' => [						'idTicket', 
						'idServico', 
						'cd_servidor_solicitante', 
						'cd_servidor_recebimento', 
						'numero', 
						'descricao', 
						'dataHoraAbertura', 
						'flagAprovado', 
						'flagAtendido', 
						'flagExecutado', 
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

	static function objToRs($oAcompanhamento){
		$reg['idAcompanhamento'] = $oAcompanhamento->idAcompanhamento;
		$oTicket = $oAcompanhamento->oTicket;
		$reg['idTicket'] = $oTicket->idTicket;
		$reg['descricao'] = $oAcompanhamento->descricao;
		$reg['dataHora'] = $oAcompanhamento->dataHora;
		$reg['usuario'] = $oAcompanhamento->usuario;
		$reg['status'] = $oAcompanhamento->status;
		return $reg;		   
	}

	static function objToRsInsert($oAcompanhamento){
		$oTicket = $oAcompanhamento->oTicket;
		$reg['idTicket'] = $oTicket->idTicket;
		$reg['descricao'] = $oAcompanhamento->descricao;
		$reg['dataHora'] = $oAcompanhamento->dataHora;
		$reg['usuario'] = $oAcompanhamento->usuario;
		$reg['status'] = $oAcompanhamento->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAcompanhamento = new Acompanhamento();
		$oAcompanhamento->idAcompanhamento = $reg['Acompanhamento_idAcompanhamento'];

		$oTicket = new Ticket();
		$oTicket->idTicket = $reg['Ticket_idTicket'];
		$oTicket->cd_servidor_solicitante = $reg['Ticket_cd_servidor_solicitante'];
		$oTicket->cd_servidor_recebimento = $reg['Ticket_cd_servidor_recebimento'];
		$oTicket->numero = $reg['Ticket_numero'];
		$oTicket->descricao = $reg['Ticket_descricao'];
		$oTicket->dataHoraAbertura = $reg['Ticket_dataHoraAbertura'];
		$oTicket->flagAprovado = $reg['Ticket_flagAprovado'];
		$oTicket->flagAtendido = $reg['Ticket_flagAtendido'];
		$oTicket->flagExecutado = $reg['Ticket_flagExecutado'];
		$oTicket->status = $reg['Ticket_status'];
		$oAcompanhamento->oTicket = $oTicket;
		$oAcompanhamento->descricao = $reg['Acompanhamento_descricao'];
		$oAcompanhamento->dataHora = $reg['Acompanhamento_dataHora'];
		$oAcompanhamento->usuario = $reg['Acompanhamento_usuario'];
		$oAcompanhamento->status = $reg['Acompanhamento_status'];
		return $oAcompanhamento;		   
	}
}

<?php
class TicketMAP {
	static function getMetaData() {
		return ['Ticket' => ['idTicket', 
						'idServico', 
						'cd_servidor_solicitante', 
						'cd_servidor_recebimento', 
						'numero', 
						'descricao', 
						'dataHoraAbertura', 
						'flagAprovado', 
						'flagAtendido', 
						'flagExecutado', 
						'status'], 
				'Servico' => [						'idServico', 
						'idSla', 
						'idTipoServico', 
						'descricao', 
						'valor', 
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

	static function objToRs($oTicket){
		$reg['idTicket'] = $oTicket->idTicket;
		$oServico = $oTicket->oServico;
		$reg['idServico'] = $oServico->idServico;
		$reg['cd_servidor_solicitante'] = $oTicket->cd_servidor_solicitante;
		$reg['cd_servidor_recebimento'] = $oTicket->cd_servidor_recebimento;
		$reg['numero'] = $oTicket->numero;
		$reg['descricao'] = $oTicket->descricao;
		$reg['dataHoraAbertura'] = $oTicket->dataHoraAbertura;
		$reg['flagAprovado'] = $oTicket->flagAprovado;
		$reg['flagAtendido'] = $oTicket->flagAtendido;
		$reg['flagExecutado'] = $oTicket->flagExecutado;
		$reg['status'] = $oTicket->status;
		return $reg;		   
	}

	static function objToRsInsert($oTicket){
		$oServico = $oTicket->oServico;
		$reg['idServico'] = $oServico->idServico;
		$reg['cd_servidor_solicitante'] = $oTicket->cd_servidor_solicitante;
		$reg['cd_servidor_recebimento'] = $oTicket->cd_servidor_recebimento;
		$reg['numero'] = $oTicket->numero;
		$reg['descricao'] = $oTicket->descricao;
		$reg['dataHoraAbertura'] = $oTicket->dataHoraAbertura;
		$reg['flagAprovado'] = $oTicket->flagAprovado;
		$reg['flagAtendido'] = $oTicket->flagAtendido;
		$reg['flagExecutado'] = $oTicket->flagExecutado;
		$reg['status'] = $oTicket->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oTicket = new Ticket();
		$oTicket->idTicket = $reg['Ticket_idTicket'];

		$oServico = new Servico();
		$oServico->idServico = $reg['Servico_idServico'];
		$oServico->descricao = $reg['Servico_descricao'];
		$oServico->valor = $reg['Servico_valor'];
		$oServico->status = $reg['Servico_status'];
		$oTicket->oServico = $oServico;
		$oTicket->cd_servidor_solicitante = $reg['Ticket_cd_servidor_solicitante'];
		$oTicket->cd_servidor_recebimento = $reg['Ticket_cd_servidor_recebimento'];
		$oTicket->numero = $reg['Ticket_numero'];
		$oTicket->descricao = $reg['Ticket_descricao'];
		$oTicket->dataHoraAbertura = $reg['Ticket_dataHoraAbertura'];
		$oTicket->flagAprovado = $reg['Ticket_flagAprovado'];
		$oTicket->flagAtendido = $reg['Ticket_flagAtendido'];
		$oTicket->flagExecutado = $reg['Ticket_flagExecutado'];
		$oTicket->status = $reg['Ticket_status'];
		return $oTicket;		   
	}
}

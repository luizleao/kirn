<?php
class PatrimonioTicketMAP {
	static function getMetaData() {
		return ['PatrimonioTicket' => ['idPatrimonioTicket', 
						'idTicket', 
						'tombamento', 
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

	static function objToRs($oPatrimonioTicket){
		$reg['idPatrimonioTicket'] = $oPatrimonioTicket->idPatrimonioTicket;
		$oTicket = $oPatrimonioTicket->oTicket;
		$reg['idTicket'] = $oTicket->idTicket;
		$reg['tombamento'] = $oPatrimonioTicket->tombamento;
		$reg['status'] = $oPatrimonioTicket->status;
		return $reg;		   
	}

	static function objToRsInsert($oPatrimonioTicket){
		$oTicket = $oPatrimonioTicket->oTicket;
		$reg['idTicket'] = $oTicket->idTicket;
		$reg['tombamento'] = $oPatrimonioTicket->tombamento;
		$reg['status'] = $oPatrimonioTicket->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPatrimonioTicket = new PatrimonioTicket();
		$oPatrimonioTicket->idPatrimonioTicket = $reg['PatrimonioTicket_idPatrimonioTicket'];

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
		$oPatrimonioTicket->oTicket = $oTicket;
		$oPatrimonioTicket->tombamento = $reg['PatrimonioTicket_tombamento'];
		$oPatrimonioTicket->status = $reg['PatrimonioTicket_status'];
		return $oPatrimonioTicket;		   
	}
}

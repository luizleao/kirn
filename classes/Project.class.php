<?php
/**
 * Class Project | classes/Project.class.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.1.0 (23/05/2019)
 * @copyright   Copyright (c) 2019, Luiz
 */
/**
 * Classe Project
 * 
 * Auxilia na analise de indicadores do projeto gerado
 * 
 * @author Luiz Leão <luizleao@gmail.com>
 */
class Project {
	/**
     * Contagem de linhas do arquivo
     * 
     * @param resource $file
     * @return number
     */
    static function getLines($file){
        $f = fopen($file, 'rb');
        $lines = 0;
        
        while (!feof($f)) {
            $lines += substr_count(fread($f, 8192), "\n");
        }
        
        fclose($f);
        
        return $lines;
    }
    
    /**
     * Retorna todos arquivos de um diretorio, recursivamente
     * 
     * @param string $path
     * @return string[]
     */
    static function getAllFileDir($path){
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $files = [];
        
        foreach ($rii as $file) {
            if ($file->isDir()) continue;
            $files[] = $file->getPathname();
        }
        
        return $files;
    }
    
    static function getTotalLineProject($path){
        $aFile = Project::getAllFileDir($path);
        $count = 0;
        
        foreach($aFile as $file){
            // return mime type ala mimetype extension
            $finfo = finfo_open(FILEINFO_MIME);
            //check to see if the mime-type starts with 'text'
            if(substr(finfo_file($finfo, $file), 0, 4) == 'text')
                $count += Project::getLines($file);
        }
        
        
        return $count;
    }
    
    /**
     * Retorna info do projeto
     * 
     * 
     * @param string $xml
     * @return SimpleXMLElement
     */
    static function getInfoProject($xml){
        $xml    = join(file($xml),"");
        $aBanco = simplexml_load_string($xml);
        
        return $aBanco;
    }
    /**
     * Calcula atraves de APF o esforco de desenvolvimento da aplicacao gerada
     * 
     * @param string $xml
     * @return int
     */
    static function getTotalPFProject($xml){
        $xml    = join(file($xml),"");
        $aBanco = simplexml_load_string($xml);
        $aCountTable = [];
        $totalPF = 0;
        
        foreach($aBanco as $aTabela){
            foreach($aTabela as $oCampo){
                if((string)$aTabela["type"] == 'N:M')
                    continue;
                
                $aCountTable[(string)$aTabela["name"]] += 1;
            }
        }
        
        //Util::trace($aCountTable);
        foreach($aCountTable as $count){
            //ALI_Baixa = 1 * 7 {1-50 campos}
            //ALI_Media = 1 * 10 {>50 campos}
            $totalPF += (($count <=50) ? 7 : 10);

            //AIE = 0
            
            //SE_Baixa = 2 (Edit, Del) * 4 {1-19 campos}
            //SE_Media = 2 (Edit, Del) * 5 {>19 Campos}
            $totalPF += 2 * (($count <=19) ? 4 : 5);
            
            
            //CE_Baixa = 3 (Adm, Info, Buscar) * 3 {1-19 campos}
            //CE_Media = 3 (Adm, Info, Buscar) * 4 {>19 Campos}
            $totalPF += 3 * (($count <=19) ? 4 : 5);
            
            //EE_Baixa = 1 (Cad) * 3 {1-15 Campos}
            //EE_Media = 1 (Cad) * 4 {>15 Campos}
            $totalPF += (($count <=15) ? 3 : 4);
        }
        
        //CE_Baixa = 3 (alterarSenha, login, sair) *  3 {1-19 campos}
        $totalPF += 9;
        
        //Valor do Fator de Ajuste (VFA)
        //Caracteristicas Gerais de Sistema (CGS)
        //CGS1 - Comunicação de dados
        //CGS2 - Processamento distribuído
        //CGS3 - Performance
        //CGS4 - Utilização de Equipamento
        //CGS5 - Volume de transações
        //CGS6 - Entrada de dados on-line
        //CGS7 - Eficiência do Usuário Final
        //CGS8 - Atualização On-Line
        //CGS9 - Processamento complexo
        //CGS10 - Reutilização de código
        //CGS11 - Facilidade de Implantação
        //CGS12 - Facilidade Operacional
        //CGS13 - Múltiplos Locais
        //CGS14 - Facilidade de mudanças
        
        //$cgs = [1,1,1,1,1,1,1,1,1,1,1,1,1,1];
        
        //VFA = (Σc * 0,01) + 0,65
        //$vfa = (array_sum($cgs)*0.01) + 0.65;
        
        //Util::trace($aCountTable, true);
        return $totalPF; // * $vfa;
    }
}
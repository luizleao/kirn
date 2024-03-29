<?php

/**
 * Class IConexao | classes/IConexao.class.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Interface de conexão
 *
 * Interface de implementação de classes de conexão para qualquer SGBD
 *
 * @author Luiz Leão <luizleao@gmail.com>
 */
interface IConexao
{

    /**
     * Executa uma instrução SQL do SGBD
     *
     * @param string $sql
     *            Instrução SQL
     */
    function execute($sql);

    /**
     * Retorna a lista de tabelas de database
     */
    function getAllTabelas();

    /**
     * Returna a lista de databases do servidor
     *
     * @return string[]
     */
    function databases();

    /**
     * Retorna a lista de colunas de uma tabela
     *
     * @param string $tabela
     *            Tabela do BD selecionada
     */
    function getAllColunasTabela($tabela);

    /**
     * Retorna os dados da chaves estrangeiras da coluna
     *
     * @param string $bd
     *            Bando de Dados Selecionado
     * @param string $tabela
     *            Tabela selecionada
     * @param string $coluna
     *            Coluna selecionada
     */
    function dadosForeignKeyColuna($bd, $tabela, $coluna);
}


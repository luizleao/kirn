/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package br.com.kirn.controllers;

import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.List;

/**
 *
 * @author luizleao
 */
public class Controller{
    private String msg;
    private Connection conexao;

    public Connection getConexao() {
        return conexao;
    }

    public void setConexao(Connection conexao) {
        this.conexao = conexao;
    }

    public Controller() {
        
    }
    
    /**
     * Gera o XML que contém as meta-informações do banco de dados
     *
     * @param string sgbd Tipo de SGBD
     * @param string host Endereço do servidor
     * @param string usuario Usuário do banco
     * @param string senha Senha do Usuário
     * @param string bd Banco de dados selecionado
     * @return boolean
     */
//    public boolean gerarXML(String sgbd, String host, String usuario, String senha, String bd) throws IOException{
        
  //  }
}

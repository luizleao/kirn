/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package br.com.kirn.dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author luizleao
 */
public class ConnectionMysql {
    public static Connection getConnection() throws SQLException {
        try {
             Class.forName("com.mysql.jdbc.Driver");
             return DriverManager.getConnection("jdbc:mysql://localhost/academico", "root", "root");
             //return DriverManager.getConnection("jdbc:jtds:sqlserver://172.16.107.88:1433/dbSudamSicas", "usersicas", "qwerty@12345$");
        }
        
        catch(SQLException e){
             e.printStackTrace();
             return null;
        } 
        catch (ClassNotFoundException e) {
             throw new SQLException(e.getMessage());  
         }
    }
}

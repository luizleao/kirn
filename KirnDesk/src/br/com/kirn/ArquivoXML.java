package br.com.kirn;

import java.io.File;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.transform.OutputKeys;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;

/**
 *
 * @author luiz.leao
 */
public class ArquivoXML {
    public static void main(String[] args) {
        //System.out.println("Inicio");

        DocumentBuilderFactory documentFactory = DocumentBuilderFactory.newInstance();
        DocumentBuilder dBuilder;
        try {
            dBuilder = documentFactory.newDocumentBuilder();
            Document doc = dBuilder.newDocument();
            // Cria o elemento raiz do nosso XML
            Element rootElement = doc.createElementNS("", "database");
            rootElement.setAttribute("name", "dbSudamSicas");
            rootElement.setAttribute("dbms", "sqlserver");
            rootElement.setAttribute("host", "172.16.107.88");
            rootElement.setAttribute("user", "sa");
            rootElement.setAttribute("passwd", "cgti*2013");
            
            // Adiciona um elemento ao documento
            doc.appendChild(rootElement);

            // Adiciona o primeiro elemento filho ao elemento raiz
            Node tableNode = addTable(doc, "Comentario", "", "Normal");
            rootElement.appendChild(tableNode);

            Node columnNode = addColunm(doc, "idComentario", "int(10) unsigned", "true", "true", "true", "", "");
            tableNode.appendChild(columnNode);
            
            columnNode = addColunm(doc, "idComentario", "int(10) unsigned", "true", "true", "true", "", "");
            tableNode.appendChild(columnNode);
            
            columnNode = addColunm(doc, "idComentario", "int(10) unsigned", "true", "true", "true", "", "");
            tableNode.appendChild(columnNode);
            
            columnNode = addColunm(doc, "idComentario", "int(10) unsigned", "true", "true", "true", "", "");
            tableNode.appendChild(columnNode);
            
            //Cria os objetos que fazem referências à console e ao arquivo
            TransformerFactory transformerFactory = TransformerFactory.newInstance();
            Transformer transformer = transformerFactory.newTransformer();

            transformer.setOutputProperty(OutputKeys.INDENT, "yes");
            DOMSource source = new DOMSource(doc);

           // StreamResult console = new StreamResult(System.out);
            StreamResult file = new StreamResult(new File("../imgs/blog.xml"));

            //faz a transformação dos dados para arquivo e para a console!
            //transformer.transform(source, console);
            transformer.transform(source, file);
            //System.out.println("Fim");

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    // Criamos todos os atributos como String
    // para facilitar a escrita no XML
    private static Node addTable(Document doc, String name, String schema, String type) {
        Element table = doc.createElement("table");

        // Associa a matrícula como atributo
        table.setAttribute("name", name);
        table.setAttribute("schema", schema);
        table.setAttribute("type", type);

        return table;
    }
    
    // Criamos todos os atributos como String
    // para facilitar a escrita no XML
    private static Node addColunm(Document doc, String name, String type, String nullo, String pk, String ai, String fkTable, String fkColumn) {
        //<column name="cd_pessoa" type="int" null="NO" pk="false" ai="false" fkTable="sicas_pessoa" fkColumn="cd_pessoa"/>
        Element column = doc.createElement("column");

        // Associa a matrícula como atributo
        column.setAttribute("name", name);
        column.setAttribute("type", type);
        column.setAttribute("null", nullo);
        column.setAttribute("pk", pk);
        column.setAttribute("ai", ai);
        column.setAttribute("fkTable", fkTable);
        column.setAttribute("fkColumn", fkColumn);

        return column;
    }

    // Realiza a criação dos elementos texto
    private static Node getEmployeeElements(Document doc, Element elemento, String nome, String valor) {
        Element node = doc.createElement(nome);
        node.appendChild(doc.createTextNode(valor));
        return node;
    }
}

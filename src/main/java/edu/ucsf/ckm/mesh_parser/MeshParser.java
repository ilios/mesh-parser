package edu.ucsf.ckm.mesh_parser;

import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;

import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;

import org.xml.sax.XMLReader;

public class MeshParser {

    protected XMLReader xmlParser;
    protected MeshXMLHandler xmlHandler;

    protected MeshParser (String meshXMLFile, String mysqlHost, String databaseName,
                          String username, String password)
            throws Exception {
        SAXParserFactory factory = SAXParserFactory.newInstance();
        SAXParser parser = factory.newSAXParser();
        File f = new File(meshXMLFile);

        this.xmlParser = parser.getXMLReader();

        Connection c = null;
        if (mysqlHost != null) {
            c = this.creationJDBCConnection(mysqlHost, username, password, databaseName);
        }
        this.xmlHandler = new MeshXMLHandler(c);
        
        parser.parse(f, this.xmlHandler);
    }
    
    protected Connection creationJDBCConnection (String mysqlHost, String username,
                                                 String password, String databaseName)
            throws Exception {
        String url = "jdbc:mysql://" + mysqlHost + "/" + databaseName;

        Class.forName("com.mysql.jdbc.Driver").newInstance();

        return DriverManager.getConnection(url, username, password);
    }

    
    /**
     * Expected usage:
     *      java MeshParser _meshFile_ _dbHost_ _dbName_ _dbUserName_ _dbUserPassword_
     */
    static public void main (String[] args)
            throws Exception {
        new MeshParser(args[0], args[1], args[2], args[3], args[4]);
    }

}

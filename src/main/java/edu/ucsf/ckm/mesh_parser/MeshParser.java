package edu.ucsf.ckm.mesh_parser;

import java.io.*;
import java.sql.Connection;
import java.sql.DriverManager;

import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;

import org.xml.sax.XMLReader;

public class MeshParser {

    protected XMLReader xmlParser;
    protected MeshXMLHandler xmlHandler;

    protected MeshParser (String meshXMLFile, String outputFileName)
            throws Exception {
        SAXParserFactory factory = SAXParserFactory.newInstance();
        SAXParser parser = factory.newSAXParser();
        File f = new File(meshXMLFile);
        BufferedWriter out = new BufferedWriter(new FileWriter(outputFileName));

        this.xmlParser = parser.getXMLReader();

        this.xmlHandler = new MeshXMLHandler(out);

        parser.parse(f, this.xmlHandler);
        
        out.flush();
        out.close();
    }

    /**
     * Expected usage:
     *      java MeshParser _meshFile_ _outputFileName_
     */
    static public void main (String[] args)
            throws Exception {
        new MeshParser(args[0], args[1]);
    }

}

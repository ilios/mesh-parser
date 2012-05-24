package edu.ucsf.ckm.mesh_parser;

import java.sql.Connection;
import java.sql.Statement;
import java.util.Date;
import java.util.Stack;
import java.util.logging.Logger;

import edu.ucsf.ckm.mesh_parser.model.Concept;
import edu.ucsf.ckm.mesh_parser.model.Descriptor;
import edu.ucsf.ckm.mesh_parser.model.Qualifier;
import edu.ucsf.ckm.mesh_parser.model.SemanticType;
import edu.ucsf.ckm.mesh_parser.model.Term;

import org.xml.sax.Attributes;
import org.xml.sax.SAXException;
import org.xml.sax.helpers.DefaultHandler;

/*
 * This assumes that we're going to be getting valid MeSH XML; there's no schmancy plan-b's should
 *  we encounter different structures than anticipated. (Not the end of the world of course - just
 *  drop the unfinished table data)
 * 
 * (Yes - package level protection)
 */
class MeshXMLHandler
        extends DefaultHandler
        implements MeshXMLConstants {

    static protected final Logger LOGGER = Logger.getLogger("edu.ucsf.ckm.mesh_parser");
    
    
    protected Connection dbConnection;


    // alternatively we could have kept elements as bit masks and the current location as
    //      a compilation operation on those masks
    protected Stack<String> elementStack;
    protected StringBuilder currentStringBuffer;
    
    
    protected Descriptor currentDescriptor;

    protected Concept currentConcept;
    protected SemanticType currentSemanticType;
    protected Term currentTerm;
    protected Qualifier currentQualifier;
    
    MeshXMLHandler (Connection c)
            throws Exception {
        this.dbConnection = c;
        
        if (c != null) {
            this.dbConnection.setAutoCommit(false);
        }

        this.elementStack = new Stack<String>();
        this.currentStringBuffer = new StringBuilder();
        
        this.currentDescriptor = null;
    }
    
	/*
	 * general game plan here:
	 * 	look for descriptor record open and close. on close, write schleck to the db. care about
	 * 	 the following sub-elements:
	 * 			descriptorUI +
	 * 			descriptorName
	 * 				string +
	 * 			annotation +
	 * 			previousIndexingList
	 * 				previousIndexing +
	 * 			treeNumberList
	 * 				treeNumber +
	 * 			conceptList
	 * 				concept +
	 * 					conceptUI +
	 * 					conceptName
	 * 						string +
	 * 					conceptUMLSUI
	 * 					scopeNote +
	 * 					semanticTypeList
	 * 						semanticType +
	 * 							semtanticTypeUI +
	 * 							semanticTypeName +
	 * 					termList
	 * 						term
	 * 							termUI +
	 * 							string +
	 * 
	 */
    
    /**
     * @Override
     */
    public void startDocument () {
        String msg = "Parse consumption starting at " + (new Date()).toString();
        
        LOGGER.info(msg);
        
        System.out.println(msg);
    }
    
    /**
     * @Override
     */
    public void endDocument () {
        try {
            String msg = null;
            
            this.dbConnection.close();
            
            msg = "Parse consumption finished at " + (new Date()).toString();
            LOGGER.info(msg);
            System.out.println(msg);
        }
        catch (Exception e) {
            LOGGER.severe("Exception caught on attempting to close db connection: " + e);
        }
    }
	
    /**
     * @Override
     */
    public void characters (char[] ch, int start, int length)
            throws SAXException {
        this.currentStringBuffer.append(ch, start, length);
    }
    
    /**
     * @Override
     */
    public void startElement (String uri, String localName, String qName, Attributes atts) {
        String elementName = qName;

        this.elementStack.push(elementName);
        
        if (elementName.equals(DESCRIPTOR_RECORD)) {
            assert (this.currentDescriptor == null)
                                    : "Encountered descriptor inside already open descriptor";
            
            this.currentDescriptor = new Descriptor();
        }
        else if (elementName.equals(QUALIFIER_REFERRED_TO) && (this.elementStack.size() == 5)) {
            assert (this.currentQualifier == null)
                                    : "Encountered qualifier inside already open qualifier";
            
            this.currentQualifier = new Qualifier();
        }
        else if (elementName.equals(CONCEPT)) {
            String str = null;
            
            assert (this.currentConcept == null)
                                    : "Encountered concept inside already open concept";
            
            this.currentConcept = new Concept();
            
            for (int i = 0; i < atts.getLength(); i++) {
                str = atts.getLocalName(i);
                
                if (str.equals(PREFERRED_CONCEPT)) {
                    str = atts.getValue(i);
                    
                    this.currentConcept.setPreferred(str.equals("Y"));
                    
                    break;
                }
            }
        }
        else if (elementName.equals(SEMANTIC_TYPE)) {
            assert (this.currentSemanticType == null)
                                    : "Encountered semantic type inside already open semantic type";
            
            this.currentSemanticType = new SemanticType();
        }
        else if (elementName.equals(TERM)) {
            String str = null;
            
            assert (this.currentTerm == null) : "Encountered term inside already open term";
            
            this.currentTerm = new Term();
            
            for (int i = 0; i < atts.getLength(); i++) {
                str = atts.getLocalName(i);
                
                if (str.equals(CONCEPT_PREFERRED_TERM)) {
                    str = atts.getValue(i);
                    
                    this.currentTerm.setConceptPreferred(str.equals("Y"));
                }
                else if (str.equals(PERMUTED_TERM)) {
                    str = atts.getValue(i);
                    
                    this.currentTerm.setPermuted(str.equals("Y"));
                }
                else if (str.equals(PRINT_FLAG)) {
                    str = atts.getValue(i);
                    
                    this.currentTerm.setPrint(str.equals("Y"));
                }
                else if (str.equals(RECORD_PREFERRED_TERM)) {
                    str = atts.getValue(i);
                    
                    this.currentTerm.setRecordPreferred(str.equals("Y"));
                }
                else if (str.equals(LEXICAL_TAG)) {
                    this.currentTerm.setLexicalTag(str = atts.getValue(i));
                }
            }
        }
    }

    /**
     * @Override
     */
    public void endElement (String uri, String localName, String qName) {
        String popped = this.elementStack.pop();
        int stackSize = this.elementStack.size();
        String elementName = qName;
     
        if (! popped.equals(elementName)) {
            LOGGER.severe("Popped unmatching ending element ([" + popped + "] != [" + elementName
                          + "])");
            
            return;
        }
        
        if (elementName.equals(DESCRIPTOR_RECORD)) {
            this.digestAndWriteDescriptorToDB(this.currentDescriptor);
            
            this.currentDescriptor = null;
        }
        else if (elementName.equals(DESCRIPTOR_UI) && (stackSize == 2)) {
            this.currentDescriptor.setUniqueId(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(STRING)) {
            String peeked = this.elementStack.peek();
            
            if (peeked.equals(CONCEPT_NAME) && (stackSize == 5)) {
                this.currentConcept.setName(this.dumpAndCleanBuffer());
            }
            else if (peeked.equals(DESCRIPTOR_NAME) && (stackSize == 3)) {
                this.currentDescriptor.setName(this.dumpAndCleanBuffer());
            }
            else if (peeked.equals(TERM) && (stackSize == 6)) {
                this.currentTerm.setName(this.dumpAndCleanBuffer());
            }
            else if (peeked.equals(QUALIFIER_NAME) && (stackSize == 6)) {
                this.currentQualifier.setName(this.dumpAndCleanBuffer());
            }
        }
        else if (elementName.equals(ANNOTATION)) {
            this.currentDescriptor.setAnnotation(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(PREVIOUS_INDEXING)) {
            this.currentDescriptor.addPreviousIndexing(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(TREE_NUMBER)) {
            this.currentDescriptor.addTreeNumber(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(QUALIFIER_REFERRED_TO) && (stackSize == 4)) {
            this.currentDescriptor.addQualifier(this.currentQualifier);
            
            this.currentQualifier = null;
        }
        else if (elementName.equals(QUALIFIER_UI) && (stackSize == 5)) {
            this.currentQualifier.setUniqueId(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(CONCEPT)) {
            this.currentDescriptor.addConcept(this.currentConcept);
            
            this.currentConcept = null;
        }
        else if (elementName.equals(CONCEPT_UI) && (stackSize == 4)) {
            this.currentConcept.setUniqueId(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(CONCEPT_UMLS_UI) && (stackSize == 4)) {
            this.currentConcept.setConceptUMLSUI(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(CASN1Name)) {
            this.currentConcept.setCASN1Name(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(REGISTRY_NUMBER)) {
            this.currentConcept.setRegistryNumber(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(SCOPE_NOTE) && (stackSize == 4)) {
            this.currentConcept.setScopeNote(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(SEMANTIC_TYPE)) {
            this.currentConcept.addSemanticType(this.currentSemanticType);
            
            this.currentSemanticType = null;
        }
        else if (elementName.equals(SEMANTIC_TYPE_UI)) {
            this.currentSemanticType.setUniqueId(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(SEMANTIC_TYPE_NAME)) {
            this.currentSemanticType.setName(this.dumpAndCleanBuffer());
        }
        else if (elementName.equals(TERM)) {
            this.currentConcept.addTerm(this.currentTerm);
            
            this.currentTerm = null;
        }
        else if (elementName.equals(TERM_UI) && (stackSize == 6)) {
            this.currentTerm.setUniqueId(this.dumpAndCleanBuffer());
        }
        
        if (this.currentStringBuffer.length() > 0) {
            this.currentStringBuffer = null;
            
            this.currentStringBuffer = new StringBuilder();
        }
    }

    protected String dumpAndCleanBuffer () {
        String rhett = this.currentStringBuffer.toString();
        
        this.currentStringBuffer = null;
        this.currentStringBuffer = new StringBuilder();
        
        return rhett.trim();
    }
    
    protected void digestAndWriteDescriptorToDB (Descriptor descriptor) {
        StringBuilder sqlStatements = new StringBuilder();
        
        try {
            Statement statement = this.dbConnection.createStatement();
            String sql = null;
            
           // mesh_descriptor
            sql = this.startingInsertSQLForTable("mesh_descriptor") + descriptor.getUniqueId()
                    + "', '" + this.escapedString(descriptor.getName()) + "', ";
            
            if (descriptor.getAnnotation() != null) {
                sql += "'" + this.escapedString(descriptor.getAnnotation()) + "'";
            }
            else {
                sql += "NULL";
            }
            
            sql += ")";
            
            this.executeStatementUpdate(statement, sql, sqlStatements);
            
           // mesh_previous_indexing
            for (String previousIndexing : descriptor.getPreviousIndexings()) {
                sql = this.startingInsertSQLForTable("mesh_previous_indexing")
                        + descriptor.getUniqueId() + "', '" + this.escapedString(previousIndexing)
                        + "')";
            
                this.executeStatementUpdate(statement, sql, sqlStatements);
            }
            
           // mesh_tree_x_descriptor
            for (String treeNumber : descriptor.getTreeNumbers()) {
                sql = this.startingInsertSQLForTable("mesh_tree_x_descriptor") + treeNumber
                        + "', '" + descriptor.getUniqueId() + "')";
            
                this.executeStatementUpdate(statement, sql, sqlStatements);
            }
            
            // mesh_qualifier
            // mesh_descriptor_x_qualifier
             for (Qualifier qualifier : descriptor.getAllowableQualifiers()) {
                 sql = this.startingInsertSQLForTable("mesh_qualifier") + qualifier.getUniqueId()
                             + "', '" + this.escapedString(qualifier.getName()) + "')";
                 
                 this.executeStatementUpdate(statement, sql, sqlStatements);
                 
                 
                 sql = this.startingInsertSQLForTable("mesh_descriptor_x_qualifier")
                             + descriptor.getUniqueId() + "', '" + qualifier.getUniqueId() + "')";
                 
                 this.executeStatementUpdate(statement, sql, sqlStatements);
             }
            
            for (Concept concept : descriptor.getConcepts()) {
               // mesh_concept
                sql = this.startingInsertSQLForTable("mesh_concept") + concept.getUniqueId()
                        + "', '" + this.escapedString(concept.getName()) + "', '"
                        + concept.getConceptUMLSUI() + "', " + (concept.isPreferred() ? 1 : 0)
                        + ", ";
                
                if (concept.getScopeNote() != null) {
                    sql += "'" + this.escapedString(concept.getScopeNote()) + "'";
                }
                else {
                    sql += "NULL";
                }
                sql += ", ";
                
                if (concept.getCASN1Name() != null) {
                    sql += "'" + this.escapedString(concept.getCASN1Name()) + "'";
                }
                else {
                    sql += "NULL";
                }
                sql += ", ";
                
                if (concept.getRegistryNumber() != null) {
                    sql += "'" + this.escapedString(concept.getRegistryNumber()) + "'";
                }
                else {
                    sql += "NULL";
                }
                
                sql += ")";

                this.executeStatementUpdate(statement, sql, sqlStatements);
                
               // mesh_term
               // mesh_concept_x_term
                for (Term term : concept.getTerms()) {
                    sql = this.startingInsertSQLForTable("mesh_term") + term.getUniqueId()
                            + "', '" + this.escapedString(term.getName()) + "', ";
                    
                    if (term.getLexicalTag() != null) {
                        sql += "'" + term.getLexicalTag() + "'";
                    }
                    else {
                        sql += "NULL";
                    }
                    
                    sql += this.appendingSQLForBoolean(term.isConceptPreferred());
                    sql += this.appendingSQLForBoolean(term.isRecordPreferred());
                    sql += this.appendingSQLForBoolean(term.isPermuted());
                    sql += this.appendingSQLForBoolean(term.isPrint());
                    
                    sql += ")";
                    
                    this.executeStatementUpdate(statement, sql, sqlStatements);
                    
                    
                    sql = this.startingInsertSQLForTable("mesh_concept_x_term")
                                + concept.getUniqueId() + "', '" + term.getUniqueId() + "')";
                    
                    this.executeStatementUpdate(statement, sql, sqlStatements);
                }
                
               // mesh_semantic_type
               // mesh_concept_x_semantic_type
                for (SemanticType type : concept.getSemanticTypes()) {
                    sql = this.startingInsertSQLForTable("mesh_semantic_type") + type.getUniqueId()
                                + "', '" + this.escapedString(type.getName()) + "')";
                    
                    this.executeStatementUpdate(statement, sql, sqlStatements);
                    
                    
                    sql = this.startingInsertSQLForTable("mesh_concept_x_semantic_type")
                                + concept.getUniqueId() + "', '" + type.getUniqueId() + "')";
                    
                    this.executeStatementUpdate(statement, sql, sqlStatements);
                }
                
                
               // mesh_descriptor_x_concept
                sql = this.startingInsertSQLForTable("mesh_descriptor_x_concept")
                        + concept.getUniqueId() + "', '" + descriptor.getUniqueId() + "')";
                
                this.executeStatementUpdate(statement, sql, sqlStatements);
            }
            
            this.dbConnection.commit();
            
            LOGGER.info(". wrote tables for descriptor:" + descriptor.getUniqueId() + " - "
                         + descriptor.getName());
        }
        catch (Exception e) {
            LOGGER.severe("!! FAILED TO INSERT DESCRIPTOR: " + descriptor.getUniqueId());
            
            System.out.println("Failed to insert for [" + descriptor.getUniqueId() + "]\n"
                              + sqlStatements.toString() + "\n--------");

            try {
                this.dbConnection.rollback();
            }
            catch (Exception ee) {}
        }
    }
    
    protected String escapedString (String str) {
        return str.replaceAll("'", "\\\\'");
    }
    
    protected String startingInsertSQLForTable (String tableName) {
        return "INSERT IGNORE INTO " + tableName + " VALUES ('";
    }
    
    protected String appendingSQLForBoolean (boolean flag) {
        return ", " + (flag ? 1 : 0);
    }
    
    // this is here to have a simple point to turn on and off the db writing
    protected void executeStatementUpdate (Statement statement, String sql, StringBuilder sb)
            throws Exception {
//        System.out.println(sql + ";");
        
        if (sb.length() > 0) {
            sb.append('\n');
        }
        sb.append(sql).append(';');
        
        statement.executeUpdate(sql);
    }
    
}

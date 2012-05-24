package edu.ucsf.ckm.mesh_parser.model;

public class Term
        extends AbstractMeshModel {

    // todo find out what these are supposed to connote
    
    protected boolean conceptPreferred;
    protected boolean recordPreferred;

    protected boolean permuted;
    
    protected String lexicalTag;        // legal content?
    
    protected boolean print;
    
    public Term () {
        super();
        
        this.conceptPreferred = false;
        this.recordPreferred = false;
        
        this.permuted = false;
        
        this.print = false;
        
        this.lexicalTag = null;
    }
    
    public boolean isConceptPreferred () {
        return this.conceptPreferred;
    }
    
    public void setConceptPreferred (boolean flag) {
        this.conceptPreferred = flag;
    }
    
    public boolean isRecordPreferred () {
        return this.recordPreferred;
    }
    
    public void setRecordPreferred (boolean flag) {
        this.recordPreferred = flag;
    }
    
    public boolean isPermuted () {
        return this.permuted;
    }

    public void setPermuted (boolean flag) {
        this.permuted = flag;
    }
    
    public String getLexicalTag () {
        return this.lexicalTag;
    }

    public void setLexicalTag (String str) {
        this.lexicalTag = str;
    }
    
    public boolean isPrint () {
        return this.print;
    }
    
    public void setPrint (boolean flag) {
        this.print = flag;
    }
    
}

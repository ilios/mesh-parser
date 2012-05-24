package edu.ucsf.ckm.mesh_parser.model;

import java.util.ArrayList;
import java.util.List;

public class Concept
        extends AbstractMeshModel {

    protected boolean preferred;

    protected String conceptUMLSUI;

    protected String scopeNote;
    
    protected String casn1Name;
    
    protected String registryNumber;

    protected ArrayList<SemanticType> semanticTypeList;

    protected ArrayList<Term> termList;

    public Concept () {
        super();
        
        this.preferred = false;
        
        this.semanticTypeList = new ArrayList<SemanticType>();
        this.termList = new ArrayList<Term>();
    }
    
    public boolean isPreferred () {
        return this.preferred;
    }
    
    public void setPreferred (boolean flag) {
        this.preferred = flag;
    }

    public String getConceptUMLSUI () {
        return this.conceptUMLSUI;
    }
    
    public void setConceptUMLSUI (String str) {
        this.conceptUMLSUI = str;
    }
    
    public String getScopeNote () {
        return this.scopeNote;
    }
    
    public void setScopeNote (String str) {
        this.scopeNote = str;
    }
    
    public String getCASN1Name () {
        return this.casn1Name;
    }
    
    public void setCASN1Name (String str) {
        this.casn1Name = str;
    }
    
    public String getRegistryNumber () {
        return this.registryNumber;
    }
    
    public void setRegistryNumber (String str) {
        this.registryNumber = str;
    }

    public void addSemanticType (SemanticType st) {
        this.semanticTypeList.add(st);
    }
    
    public void addTerm (Term term) {
        this.termList.add(term);
    }
    
    public List<SemanticType> getSemanticTypes () {
        return this.semanticTypeList;
    }
    
    public List<Term> getTerms () {
        return this.termList;
    }

    public String toString (String indent) {
        String rhett = "name: " + this.name + "\n\t" + indent;
        SemanticType semanticType = null;
        Term term = null;
        
        rhett += "uid: " + this.uniqueId + (this.preferred ? " (PREFERRED)" : "") + "\n\t" + indent;
        rhett += "umls uid: " + this.conceptUMLSUI + "\n\t" + indent;
        rhett += "scope note: [" + this.scopeNote + "]\n\t" + indent;
        
        rhett += "semantic types:";
        for (int i = 0; i < this.semanticTypeList.size(); i++) {
            semanticType = this.semanticTypeList.get(i);
            
            rhett += "\n\t\t" + indent + i + ": " + semanticType.getUniqueId() + " - "
                            + semanticType.getName();
        }
        
        rhett += "\n\t" + indent + "terms:";
        for (int i = 0; i < this.termList.size(); i++) {
            term = this.termList.get(i);
            
            rhett += "\n\t\t" + indent + i + ": " + term.getUniqueId() + " - " + term.getName();
            rhett += "\n\t\t\t" + indent + "cPref:" + term.isConceptPreferred() + " rPref:";
            rhett += term.isRecordPreferred() + " perm:" + term.isPermuted() + " print:";
            rhett += term.isPrint() + " lexTag:[" + term.getLexicalTag() + "]";
        }
        
        return rhett;
    }
    
    /**
     * @Override
     */
    public String toString () {
        return this.toString("");
    }
}

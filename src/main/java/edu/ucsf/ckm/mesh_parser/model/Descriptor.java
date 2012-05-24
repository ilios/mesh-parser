package edu.ucsf.ckm.mesh_parser.model;

import java.util.ArrayList;
import java.util.List;

public class Descriptor
        extends AbstractMeshModel {

    protected String annotation;
    
    protected ArrayList<Qualifier> allowableQualifiers;
    
    protected ArrayList<String> previousIndexingList;
    
    protected ArrayList<String> treeNumberList;
    
    protected ArrayList<Concept> conceptList;
    
    public Descriptor () {
        super();
        
        this.allowableQualifiers = new ArrayList<Qualifier>();
        
        this.previousIndexingList = new ArrayList<String>(3);
        this.treeNumberList = new ArrayList<String>(3);
        this.conceptList = new ArrayList<Concept>(3);
    }

    public String getAnnotation () {
        return this.annotation;
    }
    
    public void setAnnotation (String annotationString) {
        this.annotation = annotationString;
    }
    
    public void addQualifier (Qualifier qualifier) {
        this.allowableQualifiers.add(qualifier);
    }
    
    public void addPreviousIndexing (String str) {
        this.previousIndexingList.add(str);
    }
    
    public void addTreeNumber (String str) {
        this.treeNumberList.add(str);
    }
    
    public void addConcept (Concept concept) {
        this.conceptList.add(concept);
    }
    
    public List<Qualifier> getAllowableQualifiers () {
        return this.allowableQualifiers;
    }
    
    public List<String> getPreviousIndexings () {
        return this.previousIndexingList;
    }
    
    public List<String> getTreeNumbers () {
        return this.treeNumberList;
    }
    
    public List<Concept> getConcepts () {
        return this.conceptList;
    }
    
    /**
     * @Override
     */
    public String toString () {
        String rhett = "Descriptor name: " + this.name + "\n\tuid: " + this.uniqueId;
        
        rhett += "\n\tannotation: " + this.annotation;
        
        rhett += "\n\tprevious indexings:";
        for (int i = 0; i < this.previousIndexingList.size(); i++) {
            rhett += "\n\t\t" + i + ": " + this.previousIndexingList.get(i);
        }
        
        rhett += "\n\ttree numbers:";
        for (int i = 0; i < this.treeNumberList.size(); i++) {
            rhett += "\n\t\t" + i + ": " + this.treeNumberList.get(i);
        }
        
        rhett += "\n\tconcepts:";
        for (int i = 0; i < this.conceptList.size(); i++) {
            rhett += "\n\t\t" + i + ": " + this.conceptList.get(i).toString("\t\t");
        }
        
        return rhett;
    }
    
}

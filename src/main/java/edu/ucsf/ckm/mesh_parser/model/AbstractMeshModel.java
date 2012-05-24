package edu.ucsf.ckm.mesh_parser.model;

public abstract class AbstractMeshModel {

    protected String uniqueId;
    protected String name;
    
    public String getUniqueId () {
        return this.uniqueId;
    }
    
    public void setUniqueId (String uid) {
        this.uniqueId = uid;
    }
    
    public String getName () {
        return this.name;
    }
    
    public void setName (String aName) {
        this.name = aName;
    }

}

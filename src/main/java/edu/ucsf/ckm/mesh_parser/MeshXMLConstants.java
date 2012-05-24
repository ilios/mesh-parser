package edu.ucsf.ckm.mesh_parser;

/*
 * Ya ya - interface usage for constant definition has fallen out of favour in recent years..
 *  Nonsense.
 */
public interface MeshXMLConstants {

    //
    // Element names
    //
    
    static public final String ANNOTATION = "Annotation";
    
    static public final String CASN1Name = "CASN1Name";
    static public final String CONCEPT = "Concept";
    static public final String CONCEPT_LIST = "ConceptList";
    static public final String CONCEPT_NAME = "ConceptName";
    static public final String CONCEPT_UI = "ConceptUI";
    static public final String CONCEPT_UMLS_UI = "ConceptUMLSUI";
    
    static public final String DESCRIPTOR_NAME = "DescriptorName";
    static public final String DESCRIPTOR_RECORD = "DescriptorRecord";
    static public final String DESCRIPTOR_UI = "DescriptorUI";
    
    static public final String PREVIOUS_INDEXING = "PreviousIndexing";
    static public final String PREVIOUS_INDEXING_LIST = "PreviousIndexingList";

    static public final String QUALIFIER_NAME = "QualifierName";
    static public final String QUALIFIER_REFERRED_TO = "QualifierReferredTo";
    static public final String QUALIFIER_UI = "QualifierUI";

    static public final String REGISTRY_NUMBER = "RegistryNumber";

    static public final String SEMANTIC_TYPE = "SemanticType";
    static public final String SEMANTIC_TYPE_LIST = "SemanticTypeList";
    static public final String SEMANTIC_TYPE_NAME = "SemanticTypeName";
    static public final String SEMANTIC_TYPE_UI = "SemanticTypeUI";
    static public final String SCOPE_NOTE = "ScopeNote";
    static public final String STRING = "String";
    
    static public final String TERM = "Term";
    static public final String TERM_LIST = "TermList";
    static public final String TERM_UI = "TermUI";
    static public final String TREE_NUMBER = "TreeNumber";
    static public final String TREE_NUMBER_LIST = "TreeNumberList";
    
    
    //
    // Attribute names
    //
    
    // Concept tag
    static public final String PREFERRED_CONCEPT = "PreferredConceptYN";
    
    // Term tag
    static public final String CONCEPT_PREFERRED_TERM = "ConceptPreferredTermYN";
    static public final String LEXICAL_TAG = "LexicalTag";
    static public final String PERMUTED_TERM = "IsPermutedTermYN";
    static public final String PRINT_FLAG = "PrintFlagYN";
    static public final String RECORD_PREFERRED_TERM = "RecordPreferredTermYN";
    
}

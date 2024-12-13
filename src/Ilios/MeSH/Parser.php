<?php

declare(strict_types=1);

namespace Ilios\MeSH;

use DateTime;
use DateTimeZone;
use DOMNode;
use Exception;
use Ilios\MeSH\Model\AllowableQualifier;
use Ilios\MeSH\Model\Concept;
use Ilios\MeSH\Model\ConceptRelation;
use Ilios\MeSH\Model\Descriptor;
use Ilios\MeSH\Model\DescriptorSet;
use Ilios\MeSH\Model\EntryCombination;
use Ilios\MeSH\Model\Reference;
use Ilios\MeSH\Model\Term;
use XMLReader;

/**
 * Class Parser
 * @package Ilios\MeSH
 * @link https://nlmpubs.nlm.nih.gov/projects/mesh/MESH_FILES/xmlmesh/DTD/2024/nlmdescriptorrecordset_20240101.dtd
 */
class Parser
{
    // Elements
    public const ABBREVIATION = 'Abbreviation';
    public const ALLOWABLE_QUALIFIER = 'AllowableQualifier';
    public const ANNOTATION = 'Annotation';
    public const CASN1_NAME = 'CASN1Name';
    public const CONCEPT = 'Concept';
    public const CONCEPT1_UI = 'Concept1UI';
    public const CONCEPT2_UI = 'Concept2UI';
    public const CONCEPT_NAME = 'ConceptName';
    public const CONCEPT_RELATION = 'ConceptRelation';
    public const CONCEPT_UI = 'ConceptUI';
    public const CONSIDER_ALSO = 'ConsiderAlso';
    public const DATE_CREATED = 'DateCreated';
    public const DATE_ESTABLISHED = 'DateEstablished';
    public const DATE_REVISED = 'DateRevised';
    public const DAY = 'Day';
    public const DESCRIPTOR_NAME = 'DescriptorName';
    public const DESCRIPTOR_RECORD = 'DescriptorRecord';
    public const DESCRIPTOR_RECORD_SET = 'DescriptorRecordSet';
    public const DESCRIPTOR_UI = 'DescriptorUI';
    public const ECIN = 'ECIN';
    public const ECOUT = 'ECOUT';
    public const ENTRY_COMBINATION = 'EntryCombination';
    public const ENTRY_VERSION = 'EntryVersion';
    public const HISTORY_NOTE = 'HistoryNote';
    public const MONTH = 'Month';
    public const NLM_CLASSIFICATION_NUMBER = 'NLMClassificationNumber';
    public const ONLINE_NOTE = 'OnlineNote';
    public const PHARMACOLOGICAL_ACTION = 'PharmacologicalAction';
    public const PREVIOUS_INDEXING = 'PreviousIndexing';
    public const PUBLIC_MESH_NOTE = 'PublicMeSHNote';
    public const QUALIFIER_NAME = 'QualifierName';
    public const QUALIFIER_REFERRED_TO = 'QualifierReferredTo';
    public const QUALIFIER_UI = 'QualifierUI';
    public const REGISTRY_NUMBER = 'RegistryNumber';
    public const RELATED_REGISTRY_NUMBER = 'RelatedRegistryNumber';
    public const SCOPE_NOTE = 'ScopeNote';
    public const SEE_RELATED_DESCRIPTOR = 'SeeRelatedDescriptor';
    public const SORT_VERSION = 'SortVersion';
    public const STRING = 'String';
    public const TERM = 'Term';
    public const TERM_NOTE = 'TermNote';
    public const TERM_UI = 'TermUI';
    public const THESAURUS_ID = 'ThesaurusID';
    public const TRANSLATORS_ENGLISH_SCOPE_NOTE = 'TranslatorsEnglishScopeNote';
    public const TRANSLATORS_SCOPE_NOTE = 'TranslatorsScopeNote';
    public const TREE_NUMBER = 'TreeNumber';
    public const YEAR = 'Year';

    // Attributes
    public const CONCEPT_PREFERRED_TERM_YN = 'ConceptPreferredTermYN';
    public const DESCRIPTOR_CLASS = 'DescriptorClass';
    public const IS_PERMUTED_TERM_YN = 'IsPermutedTermYN';
    public const LANGUAGE_CODE = 'LanguageCode';
    public const LEXICAL_TAG = 'LexicalTag';
    public const PREFERRED_CONCEPT_YN = 'PreferredConceptYN';
    public const RECORD_PREFERRED_TERM_YN = 'RecordPreferredTermYN';
    public const RELATION_NAME = 'RelationName';
    protected XMLReader $reader;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->reader = new XMLReader();
    }

    /**
     * Parses a given descriptors XML file into an object model.
     * @param string $uri A URI pointing at that file.
     * @return DescriptorSet The set of parsed descriptors.
     * @throws Exception
     */
    public function parse(string $uri): DescriptorSet
    {
        /* @var Concept $currentConcept */
        $currentConcept = null;
        /* @var AllowableQualifier $currentAllowableQualifier */
        $currentAllowableQualifier = null;
        /* @var ConceptRelation $currentConceptRelation */
        $currentConceptRelation = null;
        /* @var Descriptor $currentDescriptor */
        $currentDescriptor = null;
        /* @var EntryCombination $currentEntryCombination */
        $currentEntryCombination = null;
        /* @var Reference $currentDescriptorReference */
        $currentDescriptorReference = null;
        /* @var Reference $currentQualifierReference */
        $currentQualifierReference = null;
        /* @var Term $currentTerm */
        $currentTerm = null;

        $descriptors = new DescriptorSet();

        $reader = $this->reader;
        if (!@$reader->open($uri)) {
            throw new Exception('XML reader failed to open ' . $uri . '.');
        }

        // start reading the XML File.
        while ($reader->read()) {
            $nodeType = $reader->nodeType;
            if (XMLReader::ELEMENT === $nodeType) {
                switch ($reader->name) {
                    case self::ABBREVIATION:
                        $abbreviation = $this->getNodeContents($reader);
                        if ($currentTerm) {
                            $currentTerm->setAbbreviation($abbreviation);
                        } else {
                            $currentAllowableQualifier->setAbbreviation($abbreviation);
                        }
                        break;
                    case self::ALLOWABLE_QUALIFIER:
                        $currentAllowableQualifier = new AllowableQualifier();
                        break;
                    case self::ANNOTATION:
                        $annotation = $this->getNodeContents($reader);
                        $currentDescriptor->setAnnotation($annotation);
                        break;
                    case self::CASN1_NAME:
                        $casn1 = $this->getNodeContents($reader);
                        $currentConcept->setCasn1Name($casn1);
                        break;
                    case self::CONCEPT:
                        $currentConcept = new Concept();
                        $currentConcept->setPreferred('Y' === $reader->getAttribute(self::PREFERRED_CONCEPT_YN));
                        break;
                    case self::CONCEPT1_UI:
                        $ui = $this->getNodeContents($reader);
                        $currentConceptRelation->setConcept1Ui($ui);
                        break;
                    case self::CONCEPT2_UI:
                        $ui = $this->getNodeContents($reader);
                        $currentConceptRelation->setConcept2Ui($ui);
                        break;
                    case self::CONCEPT_NAME:
                        $name = $this->getStringNodeContents($reader->expand());
                        $currentConcept->setName($name);
                        break;
                    case self::CONCEPT_RELATION:
                        $currentConceptRelation = new ConceptRelation();
                        $name = $reader->getAttribute(self::RELATION_NAME);
                        if (isset($name)) {
                            $currentConceptRelation->setName($name);
                        }
                        break;
                    case self::CONCEPT_UI:
                        $ui = $this->getNodeContents($reader);
                        $currentConcept->setUi($ui);
                        break;
                    case self::CONSIDER_ALSO:
                        $also = $this->getNodeContents($reader);
                        $currentDescriptor->setConsiderAlso($also);
                        break;
                    case self::DATE_CREATED:
                        $date = $this->getDateFromNode($reader->expand());
                        if ($currentTerm) {
                            $currentTerm->setDateCreated($date);
                        } else {
                            $currentDescriptor->setDateCreated($date);
                        }
                        break;
                    case self::DATE_ESTABLISHED:
                        $date = $this->getDateFromNode($reader->expand());
                        $currentDescriptor->setDateEstablished($date);
                        break;
                    case self::DATE_REVISED:
                        $date = $this->getDateFromNode($reader->expand());
                        $currentDescriptor->setDateRevised($date);
                        break;
                    case self::DESCRIPTOR_NAME:
                        $name = $this->getStringNodeContents($reader->expand());
                        if ($currentDescriptorReference) {
                            $currentDescriptorReference->setName($name);
                        } else {
                            $currentDescriptor->setName($name);
                        }
                        break;
                    case self::DESCRIPTOR_RECORD:
                        $currentDescriptor = new Descriptor();
                        $descriptorClass = $reader->getAttribute(self::DESCRIPTOR_CLASS);
                        $currentDescriptor->setClass($descriptorClass);
                        break;
                    case self::DESCRIPTOR_RECORD_SET:
                        $langCode = $reader->getAttribute(self::LANGUAGE_CODE);
                        $descriptors->setLanguageCode($langCode);
                        break;
                    case self::DESCRIPTOR_UI:
                        $ui = $this->getNodeContents($reader);
                        if ($currentDescriptorReference) {
                            $currentDescriptorReference->setUi($ui);
                        } else {
                            $currentDescriptor->setUi($ui);
                        }
                        break;
                    case self::ECIN:
                    case self::ECOUT:
                        $currentDescriptorReference = new Reference();
                        $currentQualifierReference = new Reference();
                        break;
                    case self::ENTRY_COMBINATION:
                        $currentEntryCombination = new EntryCombination();
                        break;
                    case self::ENTRY_VERSION:
                        $version = $this->getNodeContents($reader);
                        $currentTerm->setEntryVersion($version);
                        break;
                    case self::HISTORY_NOTE:
                        $note = $this->getNodeContents($reader);
                        $currentDescriptor->setHistoryNote($note);
                        break;
                    case self::NLM_CLASSIFICATION_NUMBER:
                        $number = $this->getNodeContents($reader);
                        $currentDescriptor->setNlmClassificationNumber($number);
                        break;
                    case self::ONLINE_NOTE:
                        $note = $this->getNodeContents($reader);
                        $currentDescriptor->setOnlineNote($note);
                        break;
                    case self::PHARMACOLOGICAL_ACTION:
                    case self::SEE_RELATED_DESCRIPTOR:
                        $currentDescriptorReference = new Reference();
                        break;
                    case self::PREVIOUS_INDEXING:
                        $prev = $this->getNodeContents($reader);
                        $currentDescriptor->addPreviousIndexing($prev);
                        break;
                    case self::PUBLIC_MESH_NOTE:
                        $note = $this->getNodeContents($reader);
                        $currentDescriptor->setPublicMeshNote($note);
                        break;
                    case self::QUALIFIER_NAME:
                        $name = $this->getStringNodeContents($reader->expand());
                        $currentQualifierReference->setName($name);
                        break;
                    case self::QUALIFIER_REFERRED_TO:
                        $currentQualifierReference = new Reference();
                        break;
                    case self::QUALIFIER_UI:
                        $ui = $this->getNodeContents($reader);
                        $currentQualifierReference->setUi($ui);
                        break;
                    case self::REGISTRY_NUMBER:
                        $number = $this->getNodeContents($reader);
                        $currentConcept->addRegistryNumber($number);
                        break;
                    case self::RELATED_REGISTRY_NUMBER:
                        $number = $this->getNodeContents($reader);
                        $currentConcept->addRelatedRegistryNumber($number);
                        break;
                    case self::SCOPE_NOTE:
                        $note = $this->getNodeContents($reader);
                        $currentConcept->setScopeNote($note);
                        break;
                    case self::SORT_VERSION:
                        $version = $this->getNodeContents($reader);
                        $currentTerm->setSortVersion($version);
                        break;
                    case self::TERM:
                        $currentTerm = new Term();
                        $name = $this->getStringNodeContents($reader->expand());
                        $currentTerm->setName($name);
                        $currentTerm->setConceptPreferred(
                            'Y' === $reader->getAttribute(self::CONCEPT_PREFERRED_TERM_YN)
                        );
                        $currentTerm->setPermuted(
                            'Y' === $reader->getAttribute(self::IS_PERMUTED_TERM_YN)
                        );
                        $currentTerm->setRecordPreferred(
                            'Y' === $reader->getAttribute(self::RECORD_PREFERRED_TERM_YN)
                        );
                        $currentTerm->setLexicalTag($reader->getAttribute(self::LEXICAL_TAG));
                        break;
                    case self::TERM_NOTE:
                        $note = $this->getNodeContents($reader);
                        $currentTerm->setNote($note);
                        break;
                    case self::TERM_UI:
                        $ui = $this->getNodeContents($reader);
                        $currentTerm->setUi($ui);
                        break;
                    case self::THESAURUS_ID:
                        $id = $this->getNodeContents($reader);
                        $currentTerm->addThesaurusId($id);
                        break;
                    case self::TRANSLATORS_ENGLISH_SCOPE_NOTE:
                        $note = $this->getNodeContents($reader);
                        $currentConcept->setTranslatorsEnglishScopeNote($note);
                        break;
                    case self::TRANSLATORS_SCOPE_NOTE:
                        $note = $this->getNodeContents($reader);
                        $currentConcept->setTranslatorsScopeNote($note);
                        break;
                    case self::TREE_NUMBER:
                        $number = $this->getNodeContents($reader);
                        $currentDescriptor->addTreeNumber($number);
                        break;
                }
            } elseif (XMLReader::END_ELEMENT === $nodeType) {
                switch ($reader->name) {
                    case self::ALLOWABLE_QUALIFIER:
                        $currentAllowableQualifier->setQualifierReference($currentQualifierReference);
                        $currentDescriptor->addAllowableQualifier($currentAllowableQualifier);
                        $currentQualifierReference = null;
                        $currentAllowableQualifier = null;
                        break;
                    case self::CONCEPT:
                        $currentDescriptor->addConcept($currentConcept);
                        $currentConcept = null;
                        break;
                    case self::CONCEPT_RELATION:
                        $currentConcept->addConceptRelation($currentConceptRelation);
                        $currentConceptRelation = null;
                        break;
                    case self::DESCRIPTOR_RECORD:
                        $descriptors->addDescriptor($currentDescriptor);
                        $currentDescriptor = null;
                        break;
                    case self::ECIN:
                        $currentEntryCombination->setDescriptorIn($currentDescriptorReference);
                        $currentEntryCombination->setQualifierIn($currentQualifierReference);
                        $currentDescriptorReference = null;
                        $currentQualifierReference = null;
                        break;
                    case self::ECOUT:
                        $currentEntryCombination->setDescriptorOut($currentDescriptorReference);
                        $currentEntryCombination->setQualifierOut($currentQualifierReference);
                        $currentDescriptorReference = null;
                        $currentQualifierReference = null;
                        break;
                    case self::ENTRY_COMBINATION:
                        $currentDescriptor->addEntryCombination($currentEntryCombination);
                        $currentEntryCombination = null;
                        break;
                    case self::PHARMACOLOGICAL_ACTION:
                        $currentDescriptor->addPharmacologicalAction($currentDescriptorReference);
                        $currentDescriptorReference = null;
                        break;
                    case self::SEE_RELATED_DESCRIPTOR:
                        $currentDescriptor->addRelatedDescriptor($currentDescriptorReference);
                        $currentDescriptorReference = null;
                        break;
                    case self::TERM:
                        $currentConcept->addTerm($currentTerm);
                        $currentTerm = null;
                        break;
                }
            }
        }
        $reader->close();

        return $descriptors;
    }

    /**
     * @param DOMNode $node
     * @return DateTime
     * @throws Exception
     */
    protected function getDateFromNode(DOMNode $node): DateTime
    {
        $children = $node->childNodes;
        $ymd = [];
        foreach ($children as $child) {
            switch ($child->nodeName) {
                case self::YEAR:
                    $ymd['year'] = (int)$child->nodeValue;
                    break;
                case self::MONTH:
                    $ymd['month'] = (int)$child->nodeValue;
                    break;
                case self::DAY:
                    $ymd['day'] = (int)$child->nodeValue;
                    break;
            }
        }
        if (3 !== count($ymd)) {
            throw new Exception(
                sprintf('Could not retrieve Year/Month/Day info from node "%s".', $node->nodeName)
            );
        }
        $dt = new DateTime();
        $dt->setTimezone(new DateTimeZone('UTC'));
        $dt->setTime(0, 0);
        $dt->setDate($ymd['year'], $ymd['month'], $ymd['day']);

        return $dt;
    }

    /**
     * @param DOMNode $node
     * @return string
     * @throws Exception
     */
    protected function getStringNodeContents(DOMNode $node): string
    {
        $children = $node->childNodes;
        $contents = false;
        foreach ($children as $child) {
            if (self::STRING === $child->nodeName) {
                $contents = trim($child->nodeValue);
                break;
            }
        }
        if (false === $contents) {
            throw new Exception(
                sprintf('Node "%s" does not contain a child node of type "String".', $node->nodeName)
            );
        }

        return $contents;
    }

    /**
     * Wrapper around <code>XMLReader::readString()</code> that trims any
     * whitespace off of node contents.
     *
     * @param XMLReader $reader
     * @return string
     */
    protected function getNodeContents(XMLReader $reader): string
    {
        return trim($reader->readString());
    }
}

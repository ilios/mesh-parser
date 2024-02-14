<?php

declare(strict_types=1);

namespace Ilios\MeSH;

use Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class ParserTest
 *
 * @package Ilios\MeSH
 */
#[CoversClass(Parser::class)]
class ParserTest extends TestCase
{
    protected Parser $parser;

    protected function setUp(): void
    {
        $this->parser = new Parser();
    }

    protected function tearDown(): void
    {
        unset($this->parser);
    }

    public function testForInvalidInputUriFailure(): void
    {
        $uri = 'this/is/a/path/that/does/not/exist/desc.xml';
        try {
            $this->parser->parse($uri);
        } catch (Exception $e) {
            $this->assertSame("XML reader failed to open $uri.", $e->getMessage());
        }
    }

    public function testForIncompleteDateFailure(): void
    {
        $xml = <<<EOL
<?xml version="1.0"?>
<!DOCTYPE DescriptorRecordSet SYSTEM "https://www.nlm.nih.gov/databases/dtd/nlmdescriptorrecordset_20240101.dtd">
<DescriptorRecordSet LanguageCode="eng">
    <DescriptorRecord DescriptorClass="1">
        <DescriptorUI>D000000</DescriptorUI>
        <DescriptorName>
            <String>a descriptor</String>
        </DescriptorName>
        <DateCreated>
            <Year>2016</Year>
            <Month>12</Month>
        </DateCreated>
    </DescriptorRecord>
</DescriptorRecordSet>
EOL;
        try {
            /* @link http://php.net/manual/en/wrappers.data.php */
            $this->parser->parse('data://text/plain;base64,' . base64_encode($xml));
        } catch (Exception $e) {
            $this->assertSame('Could not retrieve Year/Month/Day info from node "DateCreated".', $e->getMessage());
        }
    }

    public function testForInvalidStringNodeFailure(): void
    {
        $xml = <<<EOL
<?xml version="1.0"?>
<!DOCTYPE DescriptorRecordSet SYSTEM "https://www.nlm.nih.gov/databases/dtd/nlmdescriptorrecordset_20240101.dtd">
<DescriptorRecordSet LanguageCode="eng">
    <DescriptorRecord DescriptorClass="1">
        <DescriptorUI>D000000</DescriptorUI>
        <AllowableQualifiersList>
            <AllowableQualifier>
                <QualifierReferredTo>
                    <QualifierUI>Q000001</QualifierUI>
                    <QualifierName>
                        this should be wrapped in a "String" element, but isn't.
                    </QualifierName>
                </QualifierReferredTo>
            </AllowableQualifier>
        </AllowableQualifiersList>
    </DescriptorRecord>
</DescriptorRecordSet>
EOL;
        try {
            $this->parser->parse('data://text/plain;base64,' . base64_encode($xml));
        } catch (Exception $e) {
            $this->assertSame('Node "QualifierName" does not contain a child node of type "String".', $e->getMessage());
        }
    }

    public function testParse(): void
    {
        $file = __DIR__ . '/desc.xml';
        $descriptorsSet = $this->parser->parse($file);

        $descriptors = $descriptorsSet->getDescriptors();
        $this->assertEquals('eng', $descriptorsSet->getLanguageCode());
        $this->assertEquals(1, count($descriptors));

        $descriptor = $descriptors[0];
        $this->assertEquals('a descriptor', $descriptor->getName());
        $this->assertEquals('D000000', $descriptor->getUi());
        $this->assertEquals('1', $descriptor->getClass());
        $this->assertEquals('2016/12/08', $descriptor->getDateCreated()->format('Y/m/d'));
        $this->assertEquals('2016/12/09', $descriptor->getDateRevised()->format('Y/m/d'));
        $this->assertEquals('2004/04/23', $descriptor->getDateEstablished()->format('Y/m/d'));

        $allowableQualifiers = $descriptor->getAllowableQualifiers();
        $this->assertEquals(2, count($allowableQualifiers));
        $this->assertEquals('Q000001', $allowableQualifiers[0]->getQualifierReference()->getUi());
        $this->assertEquals('a qualifier', $allowableQualifiers[0]->getQualifierReference()->getName());
        $this->assertEquals('TQ', $allowableQualifiers[0]->getAbbreviation());
        $this->assertEquals('Q000002', $allowableQualifiers[1]->getQualifierReference()->getUi());
        $this->assertEquals('another qualifier', $allowableQualifiers[1]->getQualifierReference()->getName());
        $this->assertEquals('TQ2', $allowableQualifiers[1]->getAbbreviation());
        $this->assertEquals('an annotation', $descriptor->getAnnotation());
        $this->assertEquals('a history note', $descriptor->getHistoryNote());
        $this->assertEquals('a nlm classification number', $descriptor->getNlmClassificationNumber());
        $this->assertEquals('an online note', $descriptor->getOnlineNote());
        $this->assertEquals('a public mesh note', $descriptor->getPublicMeshNote());

        $previousIndexing = $descriptor->getPreviousIndexing();
        $this->assertEquals(2, count($previousIndexing));
        $this->assertEquals('previously indexed as', $previousIndexing[0]);
        $this->assertEquals('also previously indexed as', $previousIndexing[1]);

        $entryCombinations = $descriptor->getEntryCombinations();
        $this->assertEquals(1, count($entryCombinations));
        $this->assertEquals('D000004', $entryCombinations[0]->getDescriptorIn()->getUi());
        $this->assertEquals('some descriptor', $entryCombinations[0]->getDescriptorIn()->getName());
        $this->assertEquals('Q000003', $entryCombinations[0]->getQualifierIn()->getUi());
        $this->assertEquals('some qualifier', $entryCombinations[0]->getQualifierIn()->getName());
        $this->assertEquals('D000005', $entryCombinations[0]->getDescriptorOut()->getUi());
        $this->assertEquals('and another descriptor', $entryCombinations[0]->getDescriptorOut()->getName());
        $this->assertEquals('Q000006', $entryCombinations[0]->getQualifierOut()->getUi());
        $this->assertEquals('some other qualifier', $entryCombinations[0]->getQualifierOut()->getName());

        $relatedDescriptors = $descriptor->getRelatedDescriptors();
        $this->assertEquals(2, count($relatedDescriptors));
        $this->assertEquals('D000002', $relatedDescriptors[0]->getUi());
        $this->assertEquals('another descriptor', $relatedDescriptors[0]->getName());
        $this->assertEquals('D000003', $relatedDescriptors[1]->getUi());
        $this->assertEquals('yet another descriptor', $relatedDescriptors[1]->getName());
        $this->assertEquals('other considerations', $descriptor->getConsiderAlso());

        $pharmActions = $descriptor->getPharmacologicalActions();
        $this->assertEquals(2, count($pharmActions));
        $this->assertEquals('D000002', $pharmActions[0]->getUi());
        $this->assertEquals('another descriptor', $pharmActions[0]->getName());
        $this->assertEquals('D000003', $pharmActions[1]->getUi());
        $this->assertEquals('yet another descriptor', $pharmActions[1]->getName());

        $treeNumbers = $descriptor->getTreeNumbers();
        $this->assertEquals(1, count($treeNumbers));
        $this->assertEquals('D00.000.000.000.001', $treeNumbers[0]);

        $concepts = $descriptor->getConcepts();
        $this->assertEquals(2, count($concepts));

        $concept = $concepts[0];
        $this->assertTrue($concept->isPreferred());
        $this->assertEquals('M0000001', $concept->getUi());
        $this->assertEquals('a casn1 name', $concept->getCasn1Name());
        $this->assertEquals('00000AAAAA', $concept->getRegistryNumber());
        $this->assertEquals('a scope note', $concept->getScopeNote());
        $this->assertEquals('something in English.', $concept->getTranslatorsEnglishScopeNote());
        $this->assertEquals('i got nothing', $concept->getTranslatorsScopeNote());

        $registryNumbers = $concept->getRelatedRegistryNumbers();
        $this->assertEquals(1, count($registryNumbers));
        $this->assertEquals('a related registry number', $registryNumbers[0]);

        $relations = $concept->getConceptRelations();
        $this->assertEquals(1, count($relations));
        $this->assertEquals('BRD', $relations[0]->getName());
        $this->assertEquals('M0000001', $relations[0]->getConcept1Ui());
        $this->assertEquals('M0000002', $relations[0]->getConcept2Ui());

        $terms = $concept->getTerms();
        $this->assertEquals(1, count($terms));
        $this->assertTrue($terms[0]->isConceptPreferred());
        $this->assertFalse($terms[0]->isPermuted());
        $this->assertEquals('NON', $terms[0]->getLexicalTag());
        $this->assertTrue($terms[0]->isRecordPreferred());
        $this->assertEquals('T000001', $terms[0]->getUi());
        $this->assertEquals('a term', $terms[0]->getName());
        $this->assertEquals('1999/01/01', $terms[0]->getDateCreated()->format('Y/m/d'));
        $this->assertEquals('IDK', $terms[0]->getAbbreviation());
        $this->assertEquals('lorem ipsum', $terms[0]->getSortVersion());
        $this->assertEquals('foo bar', $terms[0]->getEntryVersion());

        $thesaurusIds = $terms[0]->getThesaurusIds();
        $this->assertEquals(2, count($thesaurusIds));
        $this->assertEquals('a thesaurus id', $thesaurusIds[0]);
        $this->assertEquals('another thesaurus id', $thesaurusIds[1]);

        $concept = $concepts[1];
        $this->assertFalse($concept->isPreferred());
        $this->assertEquals('M0000002', $concept->getUi());
        $this->assertEquals('another concept', $concept->getName());
        $this->assertEquals('0', $concept->getRegistryNumber());

        $relations = $concept->getConceptRelations();
        $this->assertEquals(1, count($relations));
        $this->assertEquals('NRW', $relations[0]->getName());
        $this->assertEquals('M0000002', $relations[0]->getConcept1Ui());
        $this->assertEquals('M0000003', $relations[0]->getConcept2Ui());

        $terms = $concept->getTerms();
        $this->assertEquals(2, count($terms));
        $this->assertTrue($terms[0]->isConceptPreferred());
        $this->assertFalse($terms[0]->isPermuted());
        $this->assertEquals('ABB', $terms[0]->getLexicalTag());
        $this->assertFalse($terms[0]->isRecordPreferred());
        $this->assertEquals('T000002', $terms[0]->getUi());
        $this->assertEquals('another term', $terms[0]->getName());
        $this->assertEquals('1989/11/09', $terms[0]->getDateCreated()->format('Y/m/d'));
        $this->assertEquals('a term note', $terms[0]->getNote());

        $thesaurusIds = $terms[0]->getThesaurusIds();
        $this->assertEquals(1, count($thesaurusIds));
        $this->assertEquals('yet another thesaurus id', $thesaurusIds[0]);

        $this->assertFalse($terms[1]->isConceptPreferred());
        $this->assertTrue($terms[1]->isPermuted());
        $this->assertEquals('TRD', $terms[1]->getLexicalTag());
        $this->assertTrue($terms[1]->isRecordPreferred());
        $this->assertEquals('T000003', $terms[1]->getUi());
        $this->assertEquals('yet another term', $terms[1]->getName());
        $this->assertEquals('1999/11/10', $terms[1]->getDateCreated()->format('Y/m/d'));
        $this->assertNull($terms[1]->getNote());
        $this->assertEquals(0, count($terms[1]->getThesaurusIds()));
    }
}

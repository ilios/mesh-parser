<?php

namespace Ilios\MeSH;

/**
 * Class ParserTest
 * @package Ilios\MeSH
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->parser = new Parser();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        unset($this->parser);
    }

    /**
     * @covers \Ilios\MeSH\Parser::parse
     */
    public function testForInvalidInputUriFailure()
    {
        $uri = 'this/is/a/path/that/does/not/exist/desc.xml';
        try {
            $this->parser->parse($uri);
        } catch (\Exception $e) {
            $this->assertSame("XML reader failed to open ${uri}.", $e->getMessage());
        }
    }

    /**
     * @covers \Ilios\MeSH\Parser::parse
     */
    public function testForIncompleteDateFailure()
    {
        $xml =<<<EOL
<?xml version="1.0"?>
<!DOCTYPE DescriptorRecordSet SYSTEM "https://www.nlm.nih.gov/databases/dtd/nlmdescriptorrecordset_20170101.dtd">
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
        } catch (\Exception $e) {
            $this->assertSame('Could not retrieve Year/Month/Day info from node "DateCreated".', $e->getMessage());
        }
    }

    /**
     * @covers \Ilios\MeSH\Parser::parse
     */
    public function testForInvalidStringNodeFailure()
    {
        $xml =<<<EOL
<?xml version="1.0"?>
<!DOCTYPE DescriptorRecordSet SYSTEM "https://www.nlm.nih.gov/databases/dtd/nlmdescriptorrecordset_20170101.dtd">
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
        } catch (\Exception $e) {
            $this->assertSame('Node "QualifierName" does not contain a child node of type "String".', $e->getMessage());
        }
    }

    /**
     * @covers \Ilios\MeSH\Parser::parse
     */
    public function testParse()
    {
        $this->markTestIncomplete('To be implemented.');
    }
}

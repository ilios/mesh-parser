# MeSH Parser

This PHP code library provides tools for extracting [Medical Subject Headings](https://www.nlm.nih.gov/mesh/) 
(MeSH) descriptors and associated data from a given XML file into an object representation.

It expects its input to be provided in the 2016 version of the MeSH Descriptors XML format.

## Installation

Use composer to add this library to your project.

```bash
composer require ilios/mesh-parser
```

## Usage

Instantiate `\Ilios\MeSH\Parser()` and invoke its `parse()` method with an URI that points a a valid MeSH descriptors 
XML file as its sole argument.  
This method call will return an instance of  `\Ilios\MeSH\Model\DescriptorSet`; this is the top-level entry point into
object representation of the descriptors data model.  
Use getter methods on this object and its sub-components to traverse and process this model.

### Example

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// provide an URL or a local file path.
//$uri = 'ftp://nlmpubs.nlm.nih.gov/online/mesh/.xmlmesh/desc2016.xml';
$uri = __DIR__ . '/desc2016.xml';

// instantiate the parser and parse the input.
$parser = new \Ilios\MeSH\Parser();
$set = $parser->parse($uri);

// process parsed data, e.g.
$descriptor = $set->findDescriptorByUi('D000001');
echo "Descriptor ID (Name): {$descriptor->getUi()} ({$descriptor->getName()})\n";
$concepts = $descriptor->getConcepts();
foreach($concepts as $concept) {
    echo "- Concept ID (Name): {$concept->getUi()} ({$concept->getName()})\n";
    $terms = $concept->getTerms();
    foreach ($terms as $term) {
        // ...
    }
}
```

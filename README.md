# MeSH Parser

This PHP code library provides tools for extracting [Medical Subject Headings](https://www.nlm.nih.gov/mesh/) (MeSH) descriptors 
and associated data from a given XML file into an object representation.

It expects its input to be provided in the 2016 version of the MeSH Descriptors XML format.

## Installation

_TODO_

## Usage

_TODO_

## Example

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

## Legacy parser

_TODO_

# MeSH Parser

This PHP code library provides tools for extracting [Medical Subject Headings](https://www.nlm.nih.gov/mesh/meshhome.html) 
(MeSH) descriptors and associated data from a given XML file into an object representation.

It expects its input to be compliant with the 2024 or 2025 [MeSH DTDs](https://www.nlm.nih.gov/databases/download/mesh.html).

## Installation

Use composer to add this library to your project.

```bash
composer require ilios/mesh-parser
```

## Usage

Instantiate `\Ilios\MeSH\Parser` and invoke its `parse()` method with a URI that points at valid MeSH descriptors 
XML file.  
This method call will return an instance of  `\Ilios\MeSH\Model\DescriptorSet`; this is the entry point into
the object representation of the descriptors data model.  
Use getter methods on this object and its subcomponents to traverse and process this model.

### Example

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// provide a URL or a local file path.
//$uri = 'https://nlmpubs.nlm.nih.gov/projects/mesh/MESH_FILES/xmlmesh/desc2024.xml';
$uri = __DIR__ . '/desc2024.xml';

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

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use src\Services\{CsvDocumentLoader, BaseDocumentFilter, ConsoleDocumentRenderer, DocumentManager};

if ($argc != 4) {
    echo "Ambiguous number of parameters!\n";
    exit(1);
}

$loader = new CsvDocumentLoader();
$filter = new BaseDocumentFilter();
$renderer = new ConsoleDocumentRenderer();
$manager = new DocumentManager($loader, $filter, $renderer);

// A paraméterek megadása és a dokumentumok feldolgozása
$manager->processCSVDocuments($argv[1], (int)$argv[2], (float)$argv[3]);

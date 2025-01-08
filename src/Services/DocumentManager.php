<?php

namespace src\Services;

use src\Interfaces\{DocumentLoaderInterface, DocumentFilterInterface, DocumentRendererInterface};

class DocumentManager {
    private $loader;
    private $filter;
    private $renderer;

    public function __construct(DocumentLoaderInterface $loader, DocumentFilterInterface $filter, DocumentRendererInterface $renderer) {
        $this->loader = $loader; 
        $this->filter = $filter;
        $this->renderer = $renderer;
    }

    //Bővithető egyéb dokumentum tipusokkal
    public function processCSVDocuments(string $type, int $partnerId, float $threshold): void {
        $documents = $this->loader->loadCSVDocuments();
        $filteredDocuments = $this->filter->filterCSVDocuments($documents, $type, $partnerId, $threshold);
        $this->renderer->renderCSVDocuments($filteredDocuments);
    }
}
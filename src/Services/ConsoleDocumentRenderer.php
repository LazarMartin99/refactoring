<?php

namespace src\Services;

use src\Interfaces\DocumentRendererInterface;
use src\Models\Document;

class ConsoleDocumentRenderer implements DocumentRendererInterface {
    private const HEADERS = ['document_id', 'document_type', 'partner name', 'total'];

    public function renderCSVDocuments(array $documents): void {
        $this->printTableHeader(self::HEADERS);

        foreach ($documents as $document) {
            $total = $document->calculateTotal();
            $this->printTableRow($document, $total);
        }

        echo "\n";
    }

    private function printTableHeader(array $headers): void {
        foreach ($headers as $header) {
            echo str_pad($header, 20);
        }
        echo "\n";
        echo str_repeat('=', 80) . "\n";
    }

    private function printTableRow(Document $document, float $total): void {
        echo str_pad((string)$document->id, 20);
        echo str_pad($document->document_type, 20);
        echo str_pad($document->partner->name, 20);
        echo str_pad((string)$total, 20);
        echo "\n";
    }
}
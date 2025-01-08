<?php

namespace src\Services;

use src\Interfaces\DocumentFilterInterface;

class BaseDocumentFilter implements DocumentFilterInterface {
    public function filterCSVDocuments(array $documents, string $type, int $partnerId, float $threshold): array {
        return array_filter($documents, function($doc) use ($type, $partnerId, $threshold) {
            return $doc->document_type == $type && $doc->partner->id == $partnerId && $doc->calculateTotal() > $threshold;
        });
    }
}
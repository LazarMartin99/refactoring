<?php

namespace src\Interfaces;

interface DocumentFilterInterface {
    public function filterCSVDocuments(array $documents, string $type, int $partnerId, float $threshold): array;
}
<?php

namespace src\Services;

use src\Interfaces\DocumentLoaderInterface;
use src\Models\{Partner, Document, Item};

class CsvDocumentLoader implements DocumentLoaderInterface {
    private const DOCUMENT_LIST_FILE = __DIR__ . '/../../document_list.csv';

    public function loadCSVDocuments(): array {
        $documents = [];
        if (($handle = fopen(self::DOCUMENT_LIST_FILE, 'r')) !== false) {
            $row = 1;
            while (($data = fgetcsv($handle, null, ';')) !== false) {
                if ($row == 1) {
                    // Fejléc kihagyása
                } else {
                    $documents[] = $this->createDocumentFromData($data);
                }
                $row++;
            }
            fclose($handle);
        }
        return $documents;
    }

    private function createDocumentFromData(array $data): Document {
        $partnerData = json_decode($data[2], true);
        $partner = new Partner($partnerData['id'] ?? 0, $partnerData['name'] ?? 'Ismeretlen');
        $document = new Document((int)$data[0], $data[1], $partner);

        for ($i = 3; $i < count($data); $i++) {
            $itemsData = json_decode($data[$i], true);
            if (is_array($itemsData)) {
                foreach ($itemsData as $itemData) {
                    $item = new Item($itemData['unit_price'], $itemData['quantity']);
                    $document->addItem($item);
                }
            }
        }
        return $document;    
    }
}


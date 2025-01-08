<?php

namespace src\Models;

use src\Models\{Partner, Item};


class Document {
    public int $id;
    public string $document_type;
    public Partner $partner;
    public array $items = [];

    public function __construct(int $id, string $document_type, Partner $partner) {
        $this->id = $id;
        $this->document_type = $document_type;
        $this->partner = $partner;
    }

    public function addItem(Item $item): void {
        $this->items[] = $item;
    }

    public function calculateTotal(): float {
        return array_reduce($this->items, fn($carry, $item) => $carry + $item->getTotal(), 0);
    }
}
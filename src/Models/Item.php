<?php

namespace src\Models;
class Item {
    public float $unit_price;
    public int $quantity;

    public function __construct(float $unit_price, int $quantity) {
        $this->unit_price = $unit_price;
        $this->quantity = $quantity;
    }

    public function getTotal(): float {
        return $this->unit_price * $this->quantity;
    }
}
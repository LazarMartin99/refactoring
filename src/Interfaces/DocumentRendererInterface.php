<?php

namespace src\Interfaces;

interface DocumentRendererInterface {
    public function renderCSVDocuments(array $documents): void;
}
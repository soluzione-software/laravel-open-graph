<?php

namespace SoluzioneSoftware\Laravel\OpenGraph\Contracts;

use SoluzioneSoftware\Laravel\OpenGraph\Contracts\OpenGraphData as OpenGraphDataContract;

interface OpenGraphData
{
    /**
     * @return string
     */
    public function getTable();

    /**
     * @return string
     */
    public function getKeyName();

    public function get(string $url, string $locale): ?array;

    public function store(string $url, string $locale, array $data): OpenGraphDataContract;
}

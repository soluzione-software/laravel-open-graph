<?php

namespace SoluzioneSoftware\Laravel\OpenGraph\Facades;

use Illuminate\Support\Facades\Facade;
use SoluzioneSoftware\Laravel\OpenGraph\Contracts\OpenGraphData;
use SoluzioneSoftware\Laravel\OpenGraph\Manager;

/**
 * @method static array|null get(string $url, ?string $locale = null)
 * @method static array|null fetch(string $url, ?string $locale = null)
 * @method static null|array getOrFetch(string $url, ?string $locale = null)
 * @method static array|null fetchAndStore(string $url, ?string $locale = null)
 * @method static OpenGraphData store(string $url, string $locale, array $data)
 *
 * @see Manager
 */
class OpenGraph extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'open_graph.manager';
    }
}

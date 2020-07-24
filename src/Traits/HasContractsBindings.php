<?php

namespace SoluzioneSoftware\Laravel\OpenGraph\Traits;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use SoluzioneSoftware\Laravel\OpenGraph\Contracts\OpenGraphData;

trait HasContractsBindings
{
    /**
     * @return OpenGraphData
     * @throws BindingResolutionException
     */
    public static function resolveOpenGraphDataContract(): OpenGraphData
    {
        /** @var OpenGraphData $openGraphData */
        $openGraphData = Container::getInstance()->make(OpenGraphData::class);
        return $openGraphData;
    }
}

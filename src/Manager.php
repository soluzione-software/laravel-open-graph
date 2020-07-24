<?php

namespace SoluzioneSoftware\Laravel\OpenGraph;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\App;
use shweshi\OpenGraph\Exceptions\FetchException;
use shweshi\OpenGraph\Facades\OpenGraphFacade;
use SoluzioneSoftware\Laravel\OpenGraph\Contracts\OpenGraphData;
use SoluzioneSoftware\Laravel\OpenGraph\Traits\HasContractsBindings;

class Manager
{
    use HasContractsBindings;

    /**
     * @param  string  $url
     * @param  string|null  $locale
     * @return array|null
     * @throws BindingResolutionException
     */
    public function get(string $url, ?string $locale = null): ?array
    {
        return static::resolveOpenGraphDataContract()->get($url, $locale ?: App::getLocale());
    }

    public function fetch(string $url, ?string $locale = null): ?array
    {
        try {
            return OpenGraphFacade::fetch($url, false, $locale ?: App::getLocale());
        }
        catch (FetchException $exception){
            return null;
        }
    }

    /**
     * @param  string  $url
     * @param  string|null  $locale
     * @return array|null
     * @throws BindingResolutionException
     */
    public function getOrFetch(string $url, ?string $locale = null): ?array
    {
        return $this->get($url, $locale) ?: $this->fetchAndStore($url, $locale);
    }

    /**
     * @param  string  $url
     * @param  string|null  $locale
     * @return array|null
     * @throws BindingResolutionException
     */
    public function fetchAndStore(string $url, ?string $locale = null): ?array
    {
        $locale = $locale ?: App::getLocale();

        $data = $this->fetch($url, $locale);
        if ($data){
            $this->store($url, $locale, $data);
        }

        return $data;
    }

    /**
     * @param  string  $url
     * @param  string  $locale
     * @param  array  $data
     * @return OpenGraphData
     * @throws BindingResolutionException
     */
    public function store(string $url, string $locale, array $data): OpenGraphData
    {
        return static::resolveOpenGraphDataContract()->store($url, $locale, $data);
    }
}

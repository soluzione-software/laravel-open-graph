<?php

namespace SoluzioneSoftware\Laravel\OpenGraph\Models;

use Illuminate\Database\Eloquent\Model;
use SoluzioneSoftware\Laravel\OpenGraph\Contracts\OpenGraphData as OpenGraphDataContract;

/**
 * @property string url
 * @property string locale
 * @property array data
 */
class OpenGraphData extends Model implements OpenGraphDataContract
{
    protected $table = 'open_graph_data';

    protected $fillable = [
        'url',
        'url_hash',
        'locale',
        'data',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public function get(string $url, string $locale): ?array
    {
        /** @var OpenGraphData $data */
        $data = static::query()
            ->where('url_hash', md5($url))
            ->where('locale', $locale)
            ->first();

        return $data ? $data->data : null;
    }

    public function store(string $url, string $locale, array $data): OpenGraphDataContract
    {
        /** @var self $openGrpahData */
        $openGrpahData = static::query()->updateOrCreate(['url_hash' => md5($url), 'locale' => $locale], ['url' => $url, 'data' => $data]);
        return $openGrpahData;
    }
}

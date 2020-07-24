<?php

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SoluzioneSoftware\Laravel\OpenGraph\Traits\HasContractsBindings;

class CreateOpenGraphDataTable extends Migration
{
    use HasContractsBindings;

    /**
     * Run the migrations.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function up()
    {
        $openGraphData = static::resolveOpenGraphDataContract();
        $tableName = static::getTable();

        Schema::create($tableName, function (Blueprint $table) use ($openGraphData) {
            $table->bigIncrements($openGraphData->getKeyName());
            $table->timestamps();

            $table->text('url');
            $table->string('url_hash');
            $table->string('locale');
            $table->json('data');

            $table->unique(['url_hash', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function down()
    {
        Schema::dropIfExists(static::getTable());
    }

    /**
     * @return string
     * @throws BindingResolutionException
     */
    private static function getTable()
    {
        return static::resolveOpenGraphDataContract()->getTable();
    }
}

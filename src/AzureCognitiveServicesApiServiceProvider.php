<?php
namespace Kvaksrud\AzureCognitiveServices\Api;
use Illuminate\Support\ServiceProvider;

class AzureCognitiveServicesApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/azure-cognitive-services-api.php' => config_path('azure-cognitive-services-api.php')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/azure-cognitive-services-api.php', 'azure-cognitive-services-api'
        );
    }
}

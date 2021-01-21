<?php
namespace Kvaksrud\AzureCognitiveServices;
use Illuminate\Support\ServiceProvider;

class AzureCognitiveServicesProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/azure-cognitive-services.php' => config_path('azure-cognitive-services.php')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/azure-cognitive-services.php', 'laravel-azure-cognitive-services'
        );
    }
}

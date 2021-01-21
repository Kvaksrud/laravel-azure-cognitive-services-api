# Azure CS (Cognitive Services) Face package for Laravel

This packages makes it easy to use Azure's cognitive service, Face, in your Laravel project.

This currently supports
* Laravel 8.x
* Azure Cognitive Services
  * Computer Vision API (coming soon)
  * Face API

## Installation

Open CMD or PowerShell in your project folder and run the following commands to get started
 1. Install package with `composer require kvaksrud\laravel-azure-cognitive-services`
 2. Publish configuration with `php artisan vendor:publish --provider="--provider=Kvaksrud\AzureCognitiveServices\AzureCognitiveServiceProvider"`
 3. In the .env file add the following. Make sure to replace with your values.
```
AZURE_CS_FACE_ENDPOINT=https://yourfaceapp.cognitiveservices.azure.com/
AZURE_CS_FACE_KEY=yoursecretkey
```


<?php
use Kvaksrud\AzureCognitiveServices\Api\Client\AzureRegions;
use Kvaksrud\AzureCognitiveServices\Api\Controllers\AzureFaceController;

return [
    'face' => [
        'default_region' => AzureRegions::NORTH_EUROPE,
        'api_version' => AzureFaceController::API_VERSION_1_0
    ]
];

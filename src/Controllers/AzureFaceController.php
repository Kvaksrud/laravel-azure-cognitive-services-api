<?php

namespace Kvaksrud\AzureCognitiveServices\Api\Controllers;

use App\Http\Controllers\Controller;
use Kvaksrud\AzureCognitiveServices\Api\Services\Face;
use Kvaksrud\AzureCognitiveServices\Api\Client\AzureRegions;
use Kvaksrud\AzureCognitiveServices\Api\Client\AzureRestClient;
use Kvaksrud\AzureCognitiveServices\Api\Services\LargePersonGroup;

class AzureFaceController extends Controller
{
    // Global
    private $endpoint;
    private $key;
    private $client;

    const DETECTION_01 = 'detection_01';
    const DETECTION_02 = 'detection_02';
    const RECOGNITION_01 = 'recognition_01';
    const RECOGNITION_02 = 'recognition_02';
    const RECOGNITION_03 = 'recognition_03';
    const API_VERSION_1_0 = 'face/v1.0/';

    private $face;
    private $largePersonGroup;

    public function __construct()
    {
        $AzureEndpoint = new AzureRegions;
        $this->endpoint = env('AZURE_CS_FACE_ENDPOINT',$AzureEndpoint->getRegionEndpointBaseUri(config('azure-cognitive-services.face.default_region')));
        $this->key = env('AZURE_CS_FACE_KEY', null);
        $this->client = new AzureRestClient(['base_uri' => $this->endpoint.config('azure-cognitive-services.face.api_version', AzureFaceController::API_VERSION_1_0)], $this->key);
    }

    /**
     * Microsoft Azure Cognitive Service - Face API
     * @return Face
     */
    public function face(): Face
    {
        if($this->face === null)
            $this->face = new Face($this->client);
        return $this->face;
    }

    /**
     * Microsoft Azure Cognitive Service - Face API
     * @return LargePersonGroup
     */
    public function largePersonGroup(): LargePersonGroup
    {
        if($this->largePersonGroup === null)
            $this->largePersonGroup = new LargePersonGroup($this->client);
        return $this->largePersonGroup;
    }
}

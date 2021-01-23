<?php

namespace Kvaksrud\AzureCognitiveServices\Api\Services;

use Kvaksrud\AzureCognitiveServices\Api\Client\AzureRestResponse;
use Kvaksrud\AzureCognitiveServices\Api\Controllers\AzureFaceController;
use Kvaksrud\AzureCognitiveServices\Api\Client\AzureRestClient;
use Kvaksrud\AzureCognitiveServices\Api\Traits\FaceTraits;


class Face {

    use FaceTraits;

    private $client;

    public function __construct(AzureRestClient $azureRestClient)
    {
        $this->client = $azureRestClient;
    }

    public function detect(string $url, $returnFaceId = true, $detectionMethod = AzureFaceController::DETECTION_02, $recognitionModel = AzureFaceController::RECOGNITION_03, $faceIdTimeToLive = 86400): AzureRestResponse
    {

        $uri = 'detect?returnFaceId=true&recognitionModel='.$recognitionModel.'&detectionModel='.$detectionMethod.'&faceIdTimeToLive='.$faceIdTimeToLive;
        $options = [
            'body' => [
                'url' => $url
            ]
        ];

        $result = $this->client->request("post",$uri,$options);
        $this->detectedFaces = $result->getBody();
        return $result;
    }

    public function findSimilar()
    {

    }

    public function group()
    {

    }

    /**
     * Identify faces in images
     * @param string $largePersonGroupId
     * @param array $faceIds
     * @param int $maxNumOfCandidatesReturned
     * @param float $confidenceThreshold
     * @return AzureRestResponse
     */
    public function identify(string $largePersonGroupId, array $faceIds, $maxNumOfCandidatesReturned = 1, $confidenceThreshold = 0.5): AzureRestResponse
    {
        $uri = 'identify';
        $options = [
            'body'=> [
                'largePersonGroupId' => $largePersonGroupId,
                'faceIds' => $faceIds,
                'maxNumOfCandidatesReturned' => $maxNumOfCandidatesReturned,
                'confidenceThreshold' => $confidenceThreshold,
            ]
        ];

        $result = $this->client->request("post",$uri,$options);
        $this->detectedFaces = $result->getBody();
        return $result;
    }

    public function verify()
    {

    }
}

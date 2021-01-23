<?php

namespace Kvaksrud\AzureCognitiveServices\Api\Services;

use Kvaksrud\AzureCognitiveServices\Api\Client\AzureRestClient;
use Kvaksrud\AzureCognitiveServices\Api\Client\AzureRestResponse;
use Kvaksrud\AzureCognitiveServices\Api\Controllers\AzureFaceController;
use Kvaksrud\AzureCognitiveServices\Api\Objects\FaceObject;

class LargePersonGroupPerson
{

    private $client;

    public function __construct(AzureRestClient $azureRestClient)
    {
        $this->client = $azureRestClient;
    }


    /**
     * Add a face to a person in a large person group
     * @param string $imageUrl An URL to a image with the person in it
     * @param string $groupId The large person group's id
     * @param string $personId The person to add the face to
     * @param FaceObject $faceObject A face object from a previous detection
     * @param string|null $userData User data to put on the face entry
     * @param string $detectionModel Model used for detection
     * @return AzureRestResponse
     */
    public function addFace(string $imageUrl, string $groupId, string $personId, FaceObject $faceObject, string $userData = null, string $detectionModel = AzureFaceController::DETECTION_02): AzureRestResponse
    {
        $method = 'post';
        $uri = 'largepersongroups/'.$groupId.'/persons/'.$personId.'/persistedfaces?targetFace='.$faceObject->faceRectangle->left.','.$faceObject->faceRectangle->top.','.$faceObject->faceRectangle->width.','.$faceObject->faceRectangle->height.'&detectionModel='.$detectionModel;
        if($userData !== null)
            $uri .= '&userData='.urlencode($userData);
        $options = [
            'body' => [
                'url' => $imageUrl
            ]
        ];
        return $this->client->request($method,$uri,$options);
    }

    /**
     * Create a new person in a specified large person group
     * @param string $groupId The large person group's id
     * @param string $name Name of the created person, maximum length is 128
     * @param string|null $userData Optional user defined data for the person. Length should not exceed 16KB.
     * @return AzureRestResponse
     */
    public function create(string $groupId, string $name, string $userData = null): AzureRestResponse
    {
        $method = 'post';
        $options = [
            'body' => [
                'name' => $name,
                'userData' => $userData
            ]
        ];
        $uri = 'largepersongroups/'.$groupId.'/persons';
        return $this->client->request($method,$uri,$options);
    }

    public function delete()
    {
        $method = 'delete';
    }

    public function deleteFace()
    {
        $method = 'delete';
    }

    public function get(string $groupId,string $personId): AzureRestResponse
    {
        $method = 'get';
        $uri = 'largepersongroups/'.$groupId.'/persons/'.$personId;
        return $this->client->request($method,$uri);
    }

    public function getFace()
    {
        $method = 'get';
    }

    /**
     * Get a list of all persons registered to a large person group
     * @param string $largePersonGroupId
     * @param int $top
     * @param null $start
     * @return AzureRestResponse
     */
    public function list(string $largePersonGroupId, $top = 1000, $start = null): AzureRestResponse
    {
        $method = 'get';
        $uri = 'largepersongroups/'.$largePersonGroupId.'/persons?top='.$top;
        if(!is_null($start))
            $uri = $uri.'&start='.$start;
        return $this->client->request($method,$uri);
    }

    public function update()
    {
        $method = 'patch';
    }

    public function updateFace()
    {
        $method = 'patch';
    }

}

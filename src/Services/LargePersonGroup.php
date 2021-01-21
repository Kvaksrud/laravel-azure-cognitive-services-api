<?php

namespace Kvaksrud\AzureCognitiveServices\Services;

use Kvaksrud\AzureCognitiveServices\Http\Client\AzureRestClient;
use Kvaksrud\AzureCognitiveServices\Http\Client\AzureRestResponse;
use Kvaksrud\AzureCognitiveServices\Http\Controllers\AzureFaceController;

class LargePersonGroup
{

    private $client; // Azure Rest Client
    private $person;

    public function __construct(AzureRestClient $azureRestClient)
    {
        $this->client = $azureRestClient;
    }

    /**
     * Nested large person group person class as person to simplify structure
     * @return LargePersonGroupPerson
     */
    public function person(): LargePersonGroupPerson
    {
        if($this->person === null)
            $this->person = new LargePersonGroupPerson($this->client);
        return $this->person;
    }

    /**
     * Creates a large person group that person's can be added to for facial identification
     * @param string $groupId The large person group's id. Can be any string and is not incremented.
     * @param string $name The display name of the group
     * @param string|null $userData Optional max 16kb of data to attach to the group. For instance, a json array with correlation data.
     * @param string $recognitionModel The model to use for facial recognition
     * @return AzureRestResponse
     */
    public function create(string $groupId, string $name, string $userData = null, $recognitionModel = AzureFaceController::RECOGNITION_03): AzureRestResponse
    {
        $method = 'put';
        $options = [
            'body' => [
                'name' => $name,
                'userData' => $userData,
                'recognitionModel' => $recognitionModel
            ]
        ];
        $uri = 'largepersongroups/'.$groupId;
        return $this->client->request($method,$uri,$options);
    }

    /**
     * Delete a large person group and all data persisted in the group (included person's)
     * @param string $groupId The id of the group in the cognitive service
     * @return AzureRestResponse
     */
    public function delete(string $groupId): AzureRestResponse
    {
        $method = 'delete';
        $uri = 'largepersongroups/'.$groupId;
        return $this->client->request($method,$uri);
    }

    /**
     * Retrieve the information of a large person group, including its name, userData and recognitionModel.
     * @param string $groupId The large person group's id
     * @param string $returnRecognitionModel The recognition model used for face recognition
     * @return AzureRestResponse
     */
    public function get(string $groupId, $returnRecognitionModel = AzureFaceController::RECOGNITION_03): AzureRestResponse
    {
        $method = 'get';
        $uri = 'largepersongroups/'.$groupId.'?returnRecognitionModel='.($returnRecognitionModel ? 'true' : 'false');
        return $this->client->request($method,$uri);
    }

    /**
     * To check large person group training status completed or still ongoing
     * @param string $groupId The large person group's id
     * @return AzureRestResponse
     */
    public function getTrainingStatus(string $groupId): AzureRestResponse
    {
        $method = 'get';
        $uri = 'largepersongroups/'.$groupId.'/training';
        return $this->client->request($method,$uri);
    }

    /**
     * List all large person groups registered in Azure Face API
     * @param int $top
     * @param int|null $start
     * @param bool $returnRecognitionModel
     * @return AzureRestResponse
     */
    public function list(int $top = 1000, int $start = null, bool $returnRecognitionModel = false): AzureRestResponse
    {
        $method = 'get';
        $uri = 'largepersongroups?top='.$top.'&returnRecognitionModel='.($returnRecognitionModel ? 'true' : 'false');
        if(!is_null($start))
            $uri = $uri.'&start='.$start;
        return $this->client->request($method,$uri);
    }

    /**
     * Submit a large person group training task
     * @param string $groupId The large person group's id
     * @return AzureRestResponse
     */
    public function train(string $groupId): AzureRestResponse
    {
        $method = 'post';
        $uri = 'largepersongroups/'.$groupId.'/train';
        return $this->client->request($method,$uri);
    }

    /**
     * Update the name and userData of a large person group
     * @param string $groupId The large person group's id
     * @param string $name The display name of the group
     * @param string|null $userData Optional max 16kb of data to attach to the group. For instance, a json array with correlation data.
     * @return AzureRestResponse
     */
    public function update(string $groupId, string $name, string $userData = null): AzureRestResponse
    {
        $method = 'patch';
        $options = [
            'body' => [
                'name' => $name
            ]
        ];
        if($userData !== null){
            $options['body']['userData'] = $userData;
        }
        $uri = 'largepersongroups/'.$groupId;
        return $this->client->request($method,$uri,$options);
    }

}

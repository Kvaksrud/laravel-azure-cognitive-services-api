<?php

namespace Kvaksrud\AzureCognitiveServices\Api\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use GuzzleHttp\Psr7\Response;

class AzureRestResponse {

    private $object; // The client
    private $bodyContent; // Contents of the response from client
    private $hasError; // Boolean for error in response
    private $errorMessageClient; // Error from the client (raw)
    private $errorMessage; // Parsed error from the client (array)
    private $hasApiError; // Boolean for service errors
    private $hasEmptyBody; // Boolean for empty body check
    private $statusCode; // The status code (int) from the response

    public function __construct($responseObject)
    {
        $this->object = $responseObject;
        $this->hasError = false;
        $this->hasApiError = false;
        $this->hasEmptyBody = true;
        if($this->object instanceof Response) { // This is a legit response, no error code
            $this->hasError = false;
            $this->statusCode = $this->object->getStatusCode();
            $this->bodyContent = $this->object->getBody()->getContents() ?? null;
            if($this->bodyContent != '')
                $this->hasEmptyBody = false;
        } elseif ($this->object instanceof ClientException) { // Exception from the service, present the error data
            $this->hasError = true;
            $this->hasApiError = true;
            $this->errorMessageClient = $this->object->getMessage();
            $this->bodyContent = $this->object->getResponse()->getBody()->getContents(); // Get error message from service
            if($this->bodyContent != '') { // Set body
                $this->hasEmptyBody = false;
                $this->errorMessage = json_decode($this->bodyContent); // Decode json to array
            }
            $this->statusCode = $this->object->getCode();
        } elseif ($this->object instanceof ConnectException or $this->object instanceof TooManyRedirectsException) {
            // To-do, custom error response
            $this->hasError = true;
        } elseif ($this->object instanceof RequestException) {
            // To-do, custom error response
            $this->hasError = true;
        } elseif ($this->object instanceof ServerException) {
            // To-do, custom error response
            $this->hasError = true;
        }
    }

    public function result()
    {
        return $this->object;
    }

    public function getBody()
    {
        if($this->hasEmptyBody === true)
            return null;
        return json_decode($this->bodyContent);
    }

    public function emptyBody(): bool
    {
        return $this->hasEmptyBody;
    }

    public function hasError(): bool
    {
        return $this->hasError;
    }

    public function hasApiError(): bool
    {
        return $this->hasApiError;
    }
}

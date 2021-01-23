<?php

namespace Kvaksrud\AzureCognitiveServices\Api\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;

class AzureRestClient {

    private $client;
    private $key;

    public function __construct($guzzleOptions, $key)
    {
        $this->client = new Client($guzzleOptions);
        $this->key = $key;
    }

    public function request($method, $uri, $options = []): AzureRestResponse
    {
        try {
            $headers = &$options['headers'];
            $headers['User-Agent'] = 'Kvaksrud - PHP Laravel Azure Cognitive Services API (https://github.com/Kvaksrud/laravel-azure-cognitive-services)';
            $headers['Ocp-Apim-Subscription-Key'] = $this->key;
            $headers['Content-Type'] = 'application/json';
            $body = &$options['body'];
            $body = json_encode($body);
            $response = $this->client->request($method, $uri, $options);
        } catch (ClientException | ServerException $e) {
            $response = $e;
        } catch(ConnectException | TooManyRedirectsException $e) {
            echo $e->getMessage();
            $response = $e;
        } catch (RequestException $e) {
            $response = $e->getResponse();
        }

        return new AzureRestResponse($response);
    }
}

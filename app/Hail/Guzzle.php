<?php

namespace App\Hail;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Guzzle
{
    /**
     * Handles dynamic calls to the class.
     *
     * @param string $path
     * @param array $params
     * @return GuzzleHttps\Psr7\Response
     */
    public static function __callStatic($method, $params)
    {
        // The resource being called, e.g: /organisations/{id}
        $resource = $params[0];
        $content = @$params[1];

        if (is_null($content)) {
            $content = [];
        }

        $uri = "https://hail.to/api/v1/{$resource}";
        $client = new Client();

        $response = $client->request($method, $uri, [
            'form_params'   => $content,
            'headers'       => self::getHeaders(),
            'http_errors'   => false,
        ]);

        return self::handleErrors($response);
    }

    /**
     * Get the headers for the request.
     *
     * @return array
     */
    private static function getHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . Auth::user()->getHailProvider()->access_token
        ];
    }

    /**
     * Handles the response.
     *
     * @param $response GuzzleHttp\Psr7\Response
     * @return stdClass
     */
    private static function handleErrors($response)
    {
        // Setup an error handler here to handle the error codes etc.
        return json_decode($response->getBody());
    }
}
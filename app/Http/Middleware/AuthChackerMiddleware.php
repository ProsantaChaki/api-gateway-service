<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AuthChackerMiddleware
{
    function makeApiCall($method, $url, $headers = [], $body = null)
    {
        $client = new Client();
        try {
            $response = $client->request($method, $url, [
                'headers' => $headers,
                'body' => json_encode($body),
            ]);
            return ['status'=>true,
                'response'=>json_decode($response->getBody(), true)];
        } catch (GuzzleException $e) {
            return ['status'=>false];
        }
    }
    public function handle(Request $request, Closure $next)
    {
        // Determine the service URL based on the request
        $serviceUrl = 'http://localhost:8083/api/auth/auth_check';

        // Transfer the request to the service and retrieve the response
        $response = $this->makeApiCall($request->method(), $serviceUrl, $request->header(),$request->all());
        $headers = $request->header();
        $headers['user_id'] = $response['response']['data']['id'];
        $headers['name'] = $response['response']['data']['name'];
        $headers['store_id'] = $response['response']['data']['store_id'];
        $headers['role'] = $response['response']['data']['role'];
        $request->headers->replace($headers);
        //dd($response['response']['data']);

        return $next($request);
    }


}

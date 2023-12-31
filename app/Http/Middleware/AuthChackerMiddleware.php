<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

            return ['status'=>false, 'message'=>$e->getMessage()];
        }
    }
    public function handle(Request $request, Closure $next)
    {
        // Determine the service URL based on the request
        $serviceUrl = env('USER_SERVICE_API_URL').'/auth/v1/auth_check';

        // Transfer the request to the service and retrieve the response
        $response = $this->makeApiCall('get', $serviceUrl, $request->header(),$request->all());


        if (isset($response['response']['data'])){
            $headers = $request->header();
            $headers['User-Details'] = json_encode($response['response']['data']);
            $request->headers->replace($headers);
        }


        if(!$response['status']){
            return response()->json([
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Un authorized'.$response['message'],
                'data'=>null,
                'errors' => [],
            ]);
        }

        return $next($request);
    }


}

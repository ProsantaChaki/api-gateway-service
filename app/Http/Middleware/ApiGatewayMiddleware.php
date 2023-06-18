<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use function MongoDB\BSON\toJSON;

class ApiGatewayMiddleware
{
    function makeApiCall($method, $url, $headers = [], $body = null)
    {
        $client = new Client();
        try {
            $response = $client->request($method, $url, [
                'headers' => $headers,
                'body' => json_encode($body),
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return json_encode([
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'error',
                'data'=>null,
                'errors' => [],
            ],true);
        }
    }
    public function handle(Request $request, Closure $next)
    {
        $serviceUrl = $this->getServiceUrl($request);

        $response = $this->makeApiCall($request->method(), $serviceUrl, $request->header(),$request->all());
        return response($response);
    }

    protected function getServiceUrl(Request $request): string
    {

        if ($request->is('api/user*')) {
          return env('USER_SERVICE_API_URL') . str_replace('api/user', '', $request->path());
        }
        if ($request->is('api/inventory*')) {
          return env('INVENTORY_SERVICE_API_URL') . str_replace('api/inventory', '', $request->path());
        }
        if ($request->is('api/account*')) {
          return env('ACCOUNT_SERVICE_API_URL') . str_replace('api/account', '', $request->path());
        }
        if ($request->is('api/point*')) {
          return env('POINTS_SERVICE_API_URL') . str_replace('api/point', '', $request->path());
        }


        // Add more route-to-service mappings as needed

        // If no matching route is found, return a default service URL or throw an exception
        // Example: throw new \Exception('Invalid route');
        return 'http://localhost:8082/api/product';
    }
}

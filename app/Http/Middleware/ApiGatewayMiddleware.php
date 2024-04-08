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
                'message' => 'error '.$e->getMessage(),
                'data'=>null,
                'errors' => [],
            ],true);
        }
    }
    public function handle(Request $request, Closure $next)
    {
        $serviceUrl = $this->getServiceUrl($request);
        if (!$serviceUrl){
            return json_encode([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'error',
                'data'=>null,
                'errors' => [],
            ],true);
        }



        $response = $this->makeApiCall($request->method(), $serviceUrl, $request->header(),$request->all());
        return response($response);
    }

    protected function addQueryParams(Request $request, $url){
        $queryParams = $request->query();
        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }
        return $url;
    }
    protected function getServiceUrl(Request $request): string
    {

        if ($request->is('api/user-service*')) {
          return $this->addQueryParams($request, env('USER_SERVICE_API_URL') . str_replace('api/user-service', '', $request->path()));
        }
        if ($request->is('api/inventory-service*')) {
            return $this->addQueryParams($request,  env('INVENTORY_SERVICE_API_URL') . str_replace('api/inventory-service', '', $request->path()));
        }
        if ($request->is('api/account-service*')) {
            return $this->addQueryParams($request,  env('ACCOUNT_SERVICE_API_URL') . str_replace('api/account-service', '', $request->path()));
        }
        if ($request->is('api/gift-service*')) {
            return $this->addQueryParams($request,  env('POINTS_SERVICE_API_URL') . str_replace('api/gift-service', '', $request->path()));
        }
        if ($request->is('api/report-service*')) {
            return $this->addQueryParams($request,  env('REPORT_SERVICE_API_URL') . str_replace('api/report-service', '', $request->path()));
        }
        if ($request->is('api/info-service*')) {
            return $this->addQueryParams($request,  env('INFORMATION_SERVICE_API_URL') . str_replace('api/info-service', '', $request->path()));
        }
        if ($request->is('api/notification-service*')) {
            return $this->addQueryParams($request,  env('NOTIFICATION_SERVICE_API_URL') . str_replace('api/notification-service', '', $request->path()));
        }

        return false;
    }
}

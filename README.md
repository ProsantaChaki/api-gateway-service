# User Service

## About User service
- Authorization, add additional info with request and sending request to associate service is the responsibility of this project.


### Installation Instruction

````
-Require PHP Verison 8 or upper
-Require laravel Verison 9.19
-Require laravel Verison 9.19

1. Run 'Composer Install'
````


### Note
- Here are two custom middleware used
- ApiGatewayMiddleware used for transfer request to associate service
- Auth check middleware used for authentication check from user Service

The way I am using here for is not a good practice. If user service is broken no other service will work.
Using caching DB inside this service and use token verification logic that time to time updated from user service will be a better solution. Still now I am searching the best solution.  

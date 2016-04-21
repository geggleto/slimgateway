<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-04
 * Time: 1:16 PM
 */

namespace SlimGateway\Tests\Factory;


use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\UploadedFile;
use Slim\Http\Uri;

class RequestFactory
{
    /**
     * @param string $method
     * @param string $uri
     * @return Request
     */
    public function makeRequest($method = 'GET', $uri = '') {

        $env = Environment::mock([]);
        $uri = Uri::createFromString($uri);
        $headers = Headers::createFromEnvironment($env);
        $cookies = [];
        $serverParams = $env->all();
        $body = new RequestBody();
        $uploadedFiles = UploadedFile::createFromEnvironment($env);

        $request = new Request($method, $uri, $headers, $cookies, $serverParams, $body, $uploadedFiles);
        $request = $request->withHeader("Content-Type", "application/x-www-form-urlencoded");
        
        return $request;
    }
}
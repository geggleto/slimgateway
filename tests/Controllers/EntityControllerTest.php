<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-21
 * Time: 2:32 PM
 */

namespace SlimGateway\Tests\Controllers;


use Slim\App;
use Slim\Http\Response;
use SlimGateway\Tests\BaseCase;

class EntityControllerTest extends BaseCase
{
    public function testCreateEntity() {
        $request = $this->requestFactory->makeRequest("POST", '/users');
        $body = $request->getBody();
        $body->write("username=geggleto&password=abc123&email=geggleto@gmail.com&name=glenn");
        $body->rewind();

        /** @var $app App */
        $app = self::$app;

        $container = $app->getContainer();
        $container['request'] = $request;

        /** @var $response Response */
        $response = $app($request, new Response());

        $this->assertEquals(200, $response->getStatusCode());
        $body = $this->getJsonBody($response);
        $this->assertEquals(1,$body['result']);
    }

    /**
     * @depends testCreateEntity
     */
    public function testUpdateEntity() {
        $request = $this->requestFactory->makeRequest("PUT", '/users/1');
        $body = $request->getBody();
        $body->write("username=geggleto&email=geggleto@gmail.com&name=glenn2");
        $body->rewind();

        /** @var $app App */
        $app = self::$app;

        $container = $app->getContainer();
        $container['request'] = $request;

        /** @var $response Response */
        $response = $app($request, new Response());

        $this->assertEquals(200, $response->getStatusCode());
        $body = $this->getJsonBody($response);
        $this->assertEquals(1,$body['result']);
    }

    /**
     * @depends testUpdateEntity
     */
    public function testFetchEntity() {
        $request = $this->requestFactory->makeRequest("GET", '/users/1');

        /** @var $app App */
        $app = self::$app;

        $container = $app->getContainer();
        $container['request'] = $request;

        /** @var $response Response */
        $response = $app($request, new Response());

        $this->assertEquals(200, $response->getStatusCode());
        $body = $this->getJsonBody($response);
        $this->assertEquals(1,$body['id']);
        $this->assertEquals("glenn2",$body['name']);
        $this->assertEquals("abc123",$body['password']);
        $this->assertEquals("geggleto",$body['username']);
        $this->assertEquals("geggleto@gmail.com",$body['email']);
    }

    /**
     * @depends testFetchEntity
     */
    public function testDeleteEntity() {
        $request = $this->requestFactory->makeRequest("DELETE", '/users/1');

        /** @var $app App */
        $app = self::$app;

        $container = $app->getContainer();
        $container['request'] = $request;

        /** @var $response Response */
        $response = $app($request, new Response());

        $this->assertEquals(200, $response->getStatusCode());
        $body = $this->getJsonBody($response);
        $this->assertEquals(1,$body['result']);
    }
}
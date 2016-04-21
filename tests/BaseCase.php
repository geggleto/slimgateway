<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-21
 * Time: 2:27 PM
 */

namespace SlimGateway\Tests;


use SlimGateway\Tests\Factory\RequestFactory;
use Slim\Http\Response;

abstract class BaseCase extends \PHPUnit_Framework_TestCase
{
    /** @var  \Slim\App */
    protected static $app;

    /** @var RequestFactory */
    protected $requestFactory;

    public static function setUpBeforeClass() {
        $app = new \Slim\App();

        $container = $app->getContainer();

        require "./config/slim.php";
        require "./config/deps.php";
        require "./config/validators.php";
        require "./config/db.env.php";
        require "./config/db.php";
        require "./config/routes.php";

        self::$app = $app;
    }

    public function setUp()
    {
        $this->requestFactory = new RequestFactory();
    }

    protected function getJsonBody(Response $response) {
        return json_decode( (string)$response->getBody(), true );
    }
}
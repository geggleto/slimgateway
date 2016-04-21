<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-21
 * Time: 1:11 PM
 */

namespace SlimGateway;


use Slim\Http\Request;
use Slim\Http\Response;
use Valitron\Validator;

class ValidationMiddleware
{
    /** @var Validator */
    protected $validator;

    /**
     * ValidationMiddleware constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        if($this->validator->validate()) {
            return $next($request, $response);
        } else {
            return $response->withJson($this->validator->errors(), 400);
        }
    }
}
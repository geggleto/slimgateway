<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-01
 * Time: 11:26 AM
 */

namespace SlimGateway;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Db\TableGateway\TableGateway;


class EntityController
{
    /** @var TableGateway */
    private $gateway;

    /** @var string */
    protected $pk_column;

    /**
     * BaseEntityController constructor.
     * @param TableGateway $gateway
     * @param string $pk_column
     */
    public function __construct(TableGateway $gateway, $pk_column = 'id')
    {
        $this->gateway = $gateway;
        $this->pk_column = $pk_column;
    }

    /**
     * @return TableGateway
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * @param array $args
     * @return array
     */
    protected function getIdArray(array $args) {
        return [
            $this->pk_column => $args[$this->pk_column]
        ];
    }


    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     *
     * @return ResponseInterface
     */
    public function fetch(Request $request, Response $response, $args) {
        try {
            $result = $this->gateway->select(['id' => 1])->current();

            return $response->withJson($result->getArrayCopy(), 200);
        } catch (\Exception $e) {
              return $response->withStatus(400);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     *
     * @return ResponseInterface
     */
    public function create(Request $request, Response $response, $args) {
        try {
           $this->gateway->insert($request->getParsedBody());
           return $response->withJson(["result" => $this->gateway->lastInsertValue]);
        } catch (\Exception $e) {
            return $response->withStatus(400, $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     *
     * @return ResponseInterface
     */
    public function update(Request $request, Response $response, $args) {
        try {
            $result = $this->gateway->update($request->getParsedBody(), $this->getIdArray($args));
            return $response->withJson(["result" => $result]);
        } catch (\Exception $e) {
            return $response->withStatus(400);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     *
     * @return ResponseInterface
     */
    public function remove(Request $request, Response $response, $args) {
        try {
            $result = $this->gateway->delete($this->getIdArray($args));
            return $response->withJson(["result" => $result]);
        } catch (\Exception $e) {
            return $response->withStatus(400);
        }
    }
}
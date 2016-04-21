<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-21
 * Time: 1:50 PM
 */

use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Column;
use Zend\Db\Sql\Ddl\Constraint;
use Zend\Db\Sql\Ddl\DropTable;

require "./vendor/autoload.php";
$container = array();
include "./config/db.env.php";
$adapter = new \Zend\Db\Adapter\Adapter($container['settings']['db']);

$adapter->query("DROP TABLE IF EXISTS `users`", $adapter::QUERY_MODE_EXECUTE);

$table = new CreateTable('users');

$idColumn = new Column\Integer('id', false,NULL, array('autoincrement'=>true));
$table->addColumn($idColumn);
$table->addColumn(new Column\Varchar('name', 255));
$table->addColumn(new Column\Varchar('username', 255));
$table->addColumn(new Column\Varchar('password', 255));
$table->addColumn(new Column\Varchar('email', 255));

$table->addConstraint(new Constraint\PrimaryKey('id'));

$adapter->query(
    $table->getSqlString(new Zend\Db\Adapter\Platform\Mysql()),
    $adapter::QUERY_MODE_EXECUTE
);

$adapter->query("ALTER TABLE `users` MODIFY COLUMN id INT auto_increment", $adapter::QUERY_MODE_EXECUTE);
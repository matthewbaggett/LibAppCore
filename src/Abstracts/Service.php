<?php
namespace Segura\AppCore\Abstracts;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

abstract class Service
{
    abstract public function getNewModelInstance();

    abstract public function getTermPlural() : string;

    abstract public function getTermSingular() : string;

    abstract public function getNewTableGatewayInstance();

    /**
     * @param int|null              $limit
     * @param int|null              $offset
     * @param array|\Closure[]|null $wheres
     * @param string|null           $order
     * @param string|null           $orderDirection
     *
     * @return Model[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    ) {
        /** @var TableGateway $tableGateway */
        $tableGateway              = $this->getNewTableGatewayInstance();
        list($matches, $count)     = $tableGateway->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($matches instanceof ResultSet) {
            foreach ($matches as $match) {
                $return[] = $match;
            }
        }
        return $return;
    }

    /**
     * @param array|\Closure[]|null $wheres
     *
     * @return int
     */
    public function countAll(
        array $wheres = null
    ) {
        /** @var TableGateway $tableGateway */
        $tableGateway              = $this->getNewTableGatewayInstance();
        return $tableGateway->getCount($wheres);
    }
}

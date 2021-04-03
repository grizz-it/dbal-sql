<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Data;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use InvalidArgumentException;

class InsertIntoSelectQuery implements
    QueryInterface,
    ParameterizedQueryComponentInterface
{
    /**
     * The table which the insert is performed on.
     *
     * @var string
     */
    private string $table;

    /**
     * Contains the columns for the insert.
     *
     * @var array
     */
    private array $columns = [];

    /**
     * The select query object.
     *
     * @var QueryInterface
     */
    private QueryInterface $query;

    /**
     * Constructor
     *
     * @param string         $table
     * @param QueryInterface $query
     */
    public function __construct(string $table, QueryInterface $query)
    {
        $this->table = $table;
        $this->query = $query;
    }

    /**
     * Adds a column to the insert query.
     *
     * @param string $column
     *
     * @return void
     *
     * @throws InvalidArgumentException When the value is not scalar.
     */
    public function addColumn(string $column): void
    {
        $this->columns[] = $column;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf(
            'INSERT INTO %s (%s) %s;',
            $this->table,
            implode(', ', $this->columns),
            rtrim($this->query->getQuery(), ';')
        );
    }

    /**
     * Retrieves an array of parameters.
     *
     * @return array
     */
    public function getParameters(): array
    {
        if ($this->query instanceof ParameterizedQueryComponentInterface) {
            return $this->query->getParameters();
        }

        return [];
    }
}

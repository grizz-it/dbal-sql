<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Data;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use InvalidArgumentException;

class InsertQuery implements
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
     * Constructor
     *
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Adds a column to the insert query.
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return void
     *
     * @throws InvalidArgumentException When the value is not scalar.
     */
    public function addColumn(string $column, $value): void
    {
        if (is_scalar($value)) {
            $this->columns[$column] = $value;
            return;
        }

        throw new InvalidArgumentException(
            'addColumn only accepts scalar values.'
        );
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf(
            'INSERT INTO %s (%s) VALUES (%s);',
            $this->table,
            implode(', ', array_keys($this->columns)),
            implode(', ', array_fill(0, count($this->columns), '?'))
        );
    }

    /**
     * Retrieves an array of parameters.
     *
     * @return array
     */
    public function getParameters(): array
    {
        return array_values($this->columns);
    }
}

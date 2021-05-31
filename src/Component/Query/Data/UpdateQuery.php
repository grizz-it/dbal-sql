<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Data;

use GrizzIt\Dbal\Common\FilterableQueryInterface;
use GrizzIt\Dbal\Common\PageableQueryInterface;
use GrizzIt\Dbal\Common\SortableQueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use GrizzIt\Dbal\Sql\Component\FilterableQueryTrait;
use GrizzIt\Dbal\Sql\Component\PageableQueryTrait;
use GrizzIt\Dbal\Sql\Component\SortableQueryTrait;
use InvalidArgumentException;

class UpdateQuery implements
    FilterableQueryInterface,
    PageableQueryInterface,
    SortableQueryInterface,
    ParameterizedQueryComponentInterface
{
    use FilterableQueryTrait;
    use PageableQueryTrait;
    use SortableQueryTrait;

    /**
     * The table which the update is performed on.
     *
     * @var string
     */
    private string $table;

    /**
     * Contains the columns for the update.
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
     * Adds a column to the update query.
     *
     * @param string $column
     * @param mixed  $value
     *
     * @return void
     *
     * @throws InvalidArgumentException When the value is not scalar or null.
     */
    public function addColumn(string $column, $value): void
    {
        if (is_scalar($value) || is_null($value)) {
            $this->columns[$column] = $value;
            return;
        }

        throw new InvalidArgumentException(
            'addColumn only accepts scalar and null values.'
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
            'UPDATE %s SET %s;',
            $this->table,
            implode(
                ' ',
                array_filter(
                    [
                        count($this->columns)
                            ? implode('=?, ', array_keys($this->columns)) . '=?'
                            : '',
                        $this->getFilter(),
                        $this->getSort(),
                        $this->getPage()
                    ]
                )
            )
        );
    }

    /**
     * Returns the parameters for a query.
     *
     * @return array
     */
    public function getParameters(): array
    {
        return array_merge(
            array_values($this->columns),
            $this->getFilterParameters()
        );
    }
}

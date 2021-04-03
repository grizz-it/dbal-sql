<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Data;

use GrizzIt\Dbal\Common\FilterableQueryInterface;
use GrizzIt\Dbal\Common\PageableQueryInterface;
use GrizzIt\Dbal\Common\SortableQueryInterface;
use GrizzIt\Dbal\Common\JoinableQueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use GrizzIt\Dbal\Sql\Component\FilterableQueryTrait;
use GrizzIt\Dbal\Sql\Component\PageableQueryTrait;
use GrizzIt\Dbal\Sql\Component\SortableQueryTrait;
use GrizzIt\Dbal\Sql\Component\JoinableQueryTrait;

class SelectQuery implements
    FilterableQueryInterface,
    PageableQueryInterface,
    SortableQueryInterface,
    JoinableQueryInterface,
    ParameterizedQueryComponentInterface
{
    use FilterableQueryTrait;
    use PageableQueryTrait;
    use SortableQueryTrait;
    use JoinableQueryTrait;

    /**
     * The table which the select is performed on.
     *
     * @var string
     */
    private string $table;

    /**
     * Contains the columns for the select.
     *
     * @var array
     */
    private array $columns = [];

    /**
     * If the select query shoudl return distinct results.
     *
     * @var bool
     */
    private bool $distinct = false;

    /**
     * Contains the grouping statements.
     *
     * @var string[]
     */
    private array $groupBy = [];

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
     * Sets the select to distinct mode.
     *
     * @param boolean $distinct
     *
     * @return void
     */
    public function setDistinct(bool $distinct): void
    {
        $this->distinct = $distinct;
    }

    /**
     * Adds a group by to the query.
     *
     * @param string $column
     *
     * @return void
     */
    public function addGroupBy(string $column): void
    {
        $this->groupBy[] = sprintf('GROUP BY %s', $column);
    }

    /**
     * Adds a column to the select.
     *
     * @param string $column
     * @param string $alias
     * @param string $method
     *
     * @return void
     */
    public function addColumn(
        string $column,
        string $alias = '',
        string $method = ''
    ): void {
        if (empty($alias)) {
            $this->columns[] = $column;
            return;
        }

        if (empty($method)) {
            $this->columns[] = sprintf('%s AS %s', $column, $alias);
            return;
        }

        $this->columns[] = sprintf('%s(%s) AS %s', $method, $column, $alias);
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf(
            'SELECT ' . ($this->distinct ? 'DISTINCT ' : '') . '%s FROM %s;',
            count($this->columns) ? implode(', ', $this->columns) : '*',
            implode(
                ' ',
                array_filter(
                    [
                        $this->table,
                        $this->getJoin(),
                        $this->getFilter(),
                        implode(' ', $this->groupBy),
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
        return $this->getFilterParameters();
    }
}

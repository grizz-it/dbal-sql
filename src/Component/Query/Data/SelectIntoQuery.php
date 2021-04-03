<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Data;

use GrizzIt\Dbal\Common\FilterableQueryInterface;
use GrizzIt\Dbal\Common\PageableQueryInterface;
use GrizzIt\Dbal\Common\JoinableQueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use GrizzIt\Dbal\Sql\Component\FilterableQueryTrait;
use GrizzIt\Dbal\Sql\Component\PageableQueryTrait;
use GrizzIt\Dbal\Sql\Component\JoinableQueryTrait;

class SelectIntoQuery implements
    FilterableQueryInterface,
    PageableQueryInterface,
    JoinableQueryInterface,
    ParameterizedQueryComponentInterface
{
    use FilterableQueryTrait;
    use PageableQueryTrait;
    use JoinableQueryTrait;

    /**
     * The table which the select is performed on.
     *
     * @var string
     */
    private string $selectTable;

    /**
     * The table which the data is inserted into.
     *
     * @var string
     */
    private string $newTable;

    /**
     * The optional database in which the data is inserted.
     *
     * @var string
     */
    private string $externalDatabase;

    /**
     * Contains the columns for the select.
     *
     * @var array
     */
    private array $columns = [];

    /**
     * Constructor
     *
     * @param string $selectTable
     * @param string $newTable
     * @param string $externalDatabase
     */
    public function __construct(
        string $selectTable,
        string $newTable,
        string $externalDatabase = ''
    ) {
        $this->selectTable = $selectTable;
        $this->newTable = $newTable;
        $this->externalDatabase = !empty($externalDatabase)
            ? sprintf(' IN %s', $externalDatabase)
            : '';
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
            'SELECT %s INTO %s%s FROM %s;',
            implode(', ', $this->columns),
            $this->newTable,
            $this->externalDatabase,
            implode(
                ' ',
                array_filter(
                    [
                        $this->selectTable,
                        $this->getJoin(),
                        $this->getFilter(),
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

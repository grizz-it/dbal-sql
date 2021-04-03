<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Table;

class CreateTableQuery extends AbstractTableQuery
{
    /**
     * The table which is being created.
     *
     * @var string
     */
    private string $table;

    /**
     * Contains the engine that is used for the table.
     *
     * @var string
     */
    private string $engine;

    /**
     * Constructor
     *
     * @param string $table
     */
    public function __construct(string $table, string $engine = 'INNODB')
    {
        $this->table  = $table;
        $this->engine = $engine;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf(
            'CREATE TABLE %s (%s) ENGINE = %s;',
            $this->table,
            implode(
                ', ',
                array_merge(
                    $this->getColumns()['add'],
                    $this->getKeys()['add']
                )
            ),
            $this->engine
        );
    }
}

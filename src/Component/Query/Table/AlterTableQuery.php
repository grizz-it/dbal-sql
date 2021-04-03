<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Table;

class AlterTableQuery extends AbstractTableQuery
{
    /**
     * The table which is being altered.
     *
     * @var string
     */
    private string $table;

    /**
     * Constructor
     *
     * @param string      $table
     * @param string|null $engine
     */
    public function __construct(string $table)
    {
        $this->table  = $table;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        $columns = $this->getColumns();
        $keys = $this->getKeys();

        foreach ($columns['add'] as $key => $addColumn) {
            $columns['add'][$key] = 'ADD ' . $addColumn;
        }

        foreach ($keys['add'] as $key => $addKey) {
            $keys['add'][$key] = 'ADD ' . $addKey;
        }

        return sprintf(
            'ALTER TABLE %s %s;',
            $this->table,
            implode(
                ', ',
                array_merge(
                    ...array_values($columns),
                    ...array_values($keys)
                )
            )
        );
    }
}

<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Table;

use GrizzIt\Dbal\Common\QueryInterface;

class DropTableQuery implements QueryInterface
{
    /**
     * The table which is being dropped.
     *
     * @var string
     */
    private string $table;

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
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf(
            'DROP TABLE %s;',
            $this->table
        );
    }
}

<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Data;

use GrizzIt\Dbal\Common\FilterableQueryInterface;
use GrizzIt\Dbal\Common\PageableQueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use GrizzIt\Dbal\Sql\Component\FilterableQueryTrait;
use GrizzIt\Dbal\Sql\Component\PageableQueryTrait;

class DeleteQuery implements
    FilterableQueryInterface,
    PageableQueryInterface,
    ParameterizedQueryComponentInterface
{
    use FilterableQueryTrait;
    use PageableQueryTrait;

    /**
     * The table which the delete is performed on.
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
            'DELETE FROM %s;',
            implode(
                ' ',
                array_filter(
                    [
                        $this->table,
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

<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Data;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use GrizzIt\Dbal\Sql\Common\UnionEnum;

class UnionQuery implements
    QueryInterface,
    ParameterizedQueryComponentInterface
{
    /**
     * The first query in the union.
     *
     * @var QueryInterface
     */
    private QueryInterface $leftQuery;

    /**
     * The second query in the union.
     *
     * @var QueryInterface
     */
    private QueryInterface $rightQuery;

    /**
     * The mode of the union.
     *
     * @var string
     */
    private string $mode;

    /**
     * Constructor
     *
     * @param QueryInterface $leftQuery
     * @param QueryInterface $rightQuery
     * @param UnionEnum      $mode
     */
    public function __construct(
        QueryInterface $leftQuery,
        QueryInterface $rightQuery,
        UnionEnum $mode
    ) {
        $this->leftQuery = $leftQuery;
        $this->rightQuery = $rightQuery;
        $this->mode = (string) $mode;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf(
            $this->mode,
            rtrim($this->leftQuery->getQuery(), ';'),
            $this->rightQuery->getQuery()
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
            $this->leftQuery instanceof ParameterizedQueryComponentInterface
                ? $this->leftQuery->getParameters()
                : [],
            $this->rightQuery instanceof ParameterizedQueryComponentInterface
                ? $this->rightQuery->getParameters()
                : []
        );
    }
}

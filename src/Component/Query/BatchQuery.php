<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;

class BatchQuery implements
    QueryInterface,
    ParameterizedQueryComponentInterface
{
    /**
     * The query which need to be exported as a batch.
     *
     * @var QueryInterface[]
     */
    private array $queries;

    /**
     * Constructor
     *
     * @param QueryInterface ...$queries
     */
    public function __construct(QueryInterface ...$queries)
    {
        $this->queries = $queries;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        $batch = '';
        foreach ($this->queries as $query) {
            $batch .= $query->getQuery();
        }

        return $batch;
    }

    /**
     * Returns the parameters for a query.
     *
     * @return array
     */
    public function getParameters(): array
    {
        $parameters = [];
        foreach ($this->queries as $query) {
            $parameters = array_merge(
                $parameters,
                $query instanceof ParameterizedQueryComponentInterface ?
                $query->getParameters() :
                []
            );
        }

        return $parameters;
    }
}

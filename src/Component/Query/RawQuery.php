<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;

class RawQuery implements
    QueryInterface,
    ParameterizedQueryComponentInterface
{
    /**
     * Contains the raw query.
     *
     * @var string
     */
    private string $query;

    /**
     * Contains the parameters for the query.
     *
     * @var array
     */
    private array $parameters;

    /**
     * Constructor
     *
     * @param string $query
     * @param array $parameters
     */
    public function __construct(string $query, array $parameters = [])
    {
        $this->query      = $query;
        $this->parameters = $parameters;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Returns the parameters for a query.
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}

<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\View;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;

class CreateViewQuery implements
    QueryInterface,
    ParameterizedQueryComponentInterface
{
    /**
     * Contains the view that is created.
     *
     * @var string
     */
    private string $view;

    /**
     * Contains the query which constructs the view.
     *
     * @var QueryInterface
     */
    private QueryInterface $query;

    /**
     * Constructor
     *
     * @param string         $view
     * @param QueryInterface $query
     */
    public function __construct(string $view, QueryInterface $query)
    {
        $this->view  = $view;
        $this->query = $query;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf(
            'CREATE VIEW %s AS %s',
            $this->view,
            $this->query->getQuery()
        );
    }

    /**
     * Returns the parameters for a query.
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->query instanceof ParameterizedQueryComponentInterface ?
            $this->query->getParameters() :
            [];
    }
}

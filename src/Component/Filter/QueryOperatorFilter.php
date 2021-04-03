<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Filter;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\QueryFilterInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use GrizzIt\Dbal\Sql\Common\ComparatorEnum;
use GrizzIt\Dbal\Sql\Common\OperatorEnum;

class QueryOperatorFilter implements
    QueryFilterInterface,
    ParameterizedQueryComponentInterface
{
    /**
     * Contains the column for the comparison.
     *
     * @var string
     */
    private string $column;

    /**
     * Contains the query for the filter.
     *
     * @var QueryInterface
     */
    private QueryInterface $query;

    /**
     * Contains the comparator.
     *
     * @var string
     */
    private string $comparator;

    /**
     * Contains the operator.
     *
     * @var string
     */
    private string $operator;

    /**
     * Constructor
     *
     * @param string         $column
     * @param QueryInterface $query
     * @param ComparatorEnum $comparator
     * @param OperatorEnum   $operator
     */
    public function __construct(
        string $column,
        QueryInterface $query,
        ComparatorEnum $comparator,
        OperatorEnum $operator
    ) {
        $this->column     = $column;
        $this->query      = $query;
        $this->comparator = (string) $comparator;
        $this->operator   = (string) $operator;
    }

    /**
     * Retrieves the filter.
     *
     * @return string
     */
    public function getFilter(): string
    {
        return sprintf(
            '%s %s',
            $this->column,
            sprintf(
                $this->comparator,
                sprintf(
                    '%s (%s)',
                    $this->operator,
                    rtrim($this->query->getQuery(), ';')
                )
            )
        );
    }

    /**
     * Retrieves an array of filter parameters.
     *
     * @return array
     */
    public function getParameters(): array
    {
        if ($this->query instanceof ParameterizedQueryComponentInterface) {
            return $this->query->getParameters();
        }

        return [];
    }
}

<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Filter;

use GrizzIt\Dbal\Common\QueryFilterInterface;
use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;
use GrizzIt\Dbal\Sql\Common\ComparatorEnum;

class QueryInFilter implements
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
     * Contains the value for the filter.
     *
     * @var mixed
     */
    private mixed $value;

    /**
     * Contains the comparator.
     *
     * @var string
     */
    private string $comparator;

    /**
     * Constructor
     *
     * @param string         $column
     * @param QueryInterface $value
     * @param ComparatorEnum $comparator
     */
    public function __construct(
        string $column,
        QueryInterface $value,
        ComparatorEnum $comparator
    ) {
        $this->column     = $column;
        $this->value      = $value;
        $this->comparator = (string) $comparator;
    }

    /**
     * Retrieves the filter.
     *
     * @return string
     */
    public function getFilter(): string
    {
        return $this->column . ' ' . sprintf(
            $this->comparator,
            rtrim($this->value->getQuery(), ';')
        );
    }

    /**
     * Retrieves an array of filter parameters.
     *
     * @return array
     */
    public function getParameters(): array
    {
        if ($this->value instanceof ParameterizedQueryComponentInterface) {
            return $this->value->getParameters();
        }

        return [];
    }
}

<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component;

use GrizzIt\Dbal\Common\QueryFilterGroupInterface;
use GrizzIt\Dbal\Common\ParameterizedQueryComponentInterface;

trait FilterableQueryTrait
{
    /**
     * Contains the filter groups for the query.
     *
     * @var array
     */
    private array $filterGroups = [];

    /**
     * Adds a filter group to the query.
     *
     * @param QueryFilterGroupInterface $filter
     *
     * @return void
     */
    public function addFilterGroup(QueryFilterGroupInterface $filterGroup): void
    {
        $this->filterGroups[] = $filterGroup;
    }

    /**
     * Retrieves the filter part of a query.
     *
     * @return string
     */
    public function getFilter(): string
    {
        if (empty($this->filterGroups)) {
            return '';
        }

        $filters = [];
        foreach ($this->filterGroups as $filterGroup) {
            $filters[] = $filterGroup->getFilterGroup();
        }

        return sprintf('WHERE (%s)', implode(') OR (', $filters));
    }

    /**
     * Retrieves the parameters for the filter part of a query.
     *
     * @return array
     */
    public function getFilterParameters(): array
    {
        if (empty($this->filterGroups)) {
            return [];
        }

        $parameters = [];
        foreach ($this->filterGroups as $filterGroup) {
            if ($filterGroup instanceof ParameterizedQueryComponentInterface) {
                $parameters = array_merge(
                    $parameters,
                    $filterGroup->getParameters()
                );
            }
        }

        return $parameters;
    }
}

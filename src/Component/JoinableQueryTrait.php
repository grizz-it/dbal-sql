<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component;

use GrizzIt\Dbal\Common\Enum\JoinTypeEnum;

trait JoinableQueryTrait
{
    /**
     * Contains the joins for the query.
     *
     * @var string[]
     */
    private array $joins = [];

    /**
     * Adds a join to the query.
     *
     * @param string       $table
     * @param string       $leftColumn
     * @param string       $rightColumn
     * @param JoinTypeEnum $type
     *
     * @return void
     */
    public function addJoin(
        string $table,
        string $leftColumn,
        string $rightColumn,
        JoinTypeEnum $type
    ): void {
        $this->joins[] = sprintf(
            '%s %s ON %s = %s',
            (string) $type,
            $table,
            $leftColumn,
            $rightColumn
        );
    }

    /**
     * Compiles the limit segment of the query.
     *
     * @return string
     */
    public function getJoin(): string
    {
        return implode(' ', $this->joins);
    }
}

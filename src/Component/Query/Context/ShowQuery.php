<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Context;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Sql\Common\ShowTypeEnum;

class ShowQuery implements QueryInterface
{
    /**
     * The query that is being executed.
     *
     * @var string
     */
    private string $show;

    /**
     * Constructor
     *
     * @param ShowTypeEnum $database
     */
    public function __construct(ShowTypeEnum $show)
    {
        $this->show = (string) $show;
    }

    /**
     * Builds the query and returns it.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return sprintf('SHOW %s;', $this->show);
    }
}

<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component;

trait PageableQueryTrait
{
    /**
     * Contains the page size.
     *
     * @var int|null
     */
    private ?int $size = null;

    /**
     * Contains the page number.
     *
     * @var int|null
     */
    private ?int $page = null;

    /**
     * Defines the limit for the result.
     *
     * @param int $size
     * @param int $page
     *
     * @return void
     */
    public function setPage(int $size, int $page = 1): void
    {
        $this->size = $size;
        $this->page = $page;
    }

    /**
     * Compiles the limit segment of the query.
     *
     * @return string
     */
    public function getPage(): string
    {
        if ($this->size === null && $this->page === null) {
            return '';
        }

        return sprintf(
            'LIMIT %d%s',
            $this->size,
            $this->page > 1 ? sprintf(
                ' OFFSET %d',
                $this->size * ($this->page - 1)
            ) : ''
        );
    }
}

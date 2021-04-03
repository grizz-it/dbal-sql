<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Filter;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Filter\QueryFilterGroup;
use GrizzIt\Dbal\Sql\Component\Filter\ComparatorFilter;
use GrizzIt\Dbal\Sql\Common\ComparatorEnum;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Filter\QueryFilterGroup
 */
class QueryFilterGroupTest extends TestCase
{
    /**
     * @covers ::addFilter
     * @covers ::getFilterGroup
     * @covers ::getParameters
     *
     * @return void
     */
    public function testFilter(): void
    {
        $subject = new QueryFilterGroup();
        $subject->addFilter(
            new ComparatorFilter('foo', 'bar', ComparatorEnum::EQ())
        );

        $this->assertEquals('foo = ?', $subject->getFilterGroup());
        $this->assertEquals(['bar'], $subject->getParameters());
    }

    /**
     * @covers ::getFilterGroup
     * @covers ::getParameters
     *
     * @return void
     */
    public function testNoFiltersInGroup(): void
    {
        $subject = new QueryFilterGroup();
        $this->assertEquals('', $subject->getFilterGroup());
        $this->assertEquals([], $subject->getParameters());
    }
}

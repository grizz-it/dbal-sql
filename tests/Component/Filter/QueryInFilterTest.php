<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Filter;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Filter\QueryInFilter;
use GrizzIt\Dbal\Sql\Component\Query\Data\SelectQuery;
use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Sql\Common\ComparatorEnum;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Filter\QueryInFilter
 */
class QueryInFilterTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     * @covers ::getParameters
     *
     * @return void
     */
    public function testFilter(): void
    {
        $subject = new QueryInFilter(
            'baz',
            new SelectQuery('foo'),
            ComparatorEnum::IN()
        );

        $this->assertInstanceOf(QueryInFilter::class, $subject);

        $this->assertEquals('baz IN (SELECT * FROM foo)', $subject->getFilter());
        $this->assertEquals([], $subject->getParameters());
    }

    /**
     * @covers ::__construct
     * @covers ::getFilter
     * @covers ::getParameters
     *
     * @return void
     */
    public function testFilterNonParameterizedQuery(): void
    {
        $queryMock = $this->createMock(QueryInterface::class);
        $queryMock->expects(static::once())
            ->method('getQuery')
            ->willReturn('SELECT * FROM foo');

        $subject = new QueryInFilter(
            'baz',
            $queryMock,
            ComparatorEnum::IN()
        );

        $this->assertInstanceOf(QueryInFilter::class, $subject);

        $this->assertEquals('baz IN (SELECT * FROM foo)', $subject->getFilter());
        $this->assertEquals([], $subject->getParameters());
    }
}

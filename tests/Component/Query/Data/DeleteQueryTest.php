<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Data;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Data\DeleteQuery;
use GrizzIt\Dbal\Sql\Component\Filter\QueryFilterGroup;
use GrizzIt\Dbal\Sql\Component\Filter\ComparatorFilter;
use GrizzIt\Dbal\Sql\Common\ComparatorEnum;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Data\DeleteQuery
 * @covers \GrizzIt\Dbal\Sql\Component\FilterableQueryTrait
 * @covers \GrizzIt\Dbal\Sql\Component\PageableQueryTrait
 */
class DeleteQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     * @covers ::getParameters
     * @covers \GrizzIt\Dbal\Sql\Component\FilterableQueryTrait::addFilterGroup
     * @covers \GrizzIt\Dbal\Sql\Component\FilterableQueryTrait::getFilter
     * @covers \GrizzIt\Dbal\Sql\Component\FilterableQueryTrait::getFilterParameters
     * @covers \GrizzIt\Dbal\Sql\Component\PageableQueryTrait::getPage
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new DeleteQuery('foo');
        $filterGroup = new QueryFilterGroup();
        $filterGroup->addFilter(
            new ComparatorFilter('bar', 'baz', ComparatorEnum::EQ())
        );

        $subject->addFilterGroup($filterGroup);

        $this->assertEquals(
            'DELETE FROM foo WHERE (bar = ?);',
            $subject->getQuery()
        );

        $this->assertEquals(['baz'], $subject->getParameters());
    }

    /**
     * @covers ::__construct
     * @covers ::getQuery
     * @covers ::getParameters
     * @covers \GrizzIt\Dbal\Sql\Component\FilterableQueryTrait::getFilter
     * @covers \GrizzIt\Dbal\Sql\Component\FilterableQueryTrait::getFilterParameters
     * @covers \GrizzIt\Dbal\Sql\Component\PageableQueryTrait::setPage
     * @covers \GrizzIt\Dbal\Sql\Component\PageableQueryTrait::getPage
     *
     * @return void
     */
    public function testQueryPaged(): void
    {
        $subject = new DeleteQuery('foo');
        $subject->setPage(10, 4);
        $this->assertEquals(
            'DELETE FROM foo LIMIT 10 OFFSET 30;',
            $subject->getQuery()
        );

        $this->assertEquals([], $subject->getParameters());
    }
}

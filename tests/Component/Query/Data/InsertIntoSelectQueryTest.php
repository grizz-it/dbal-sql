<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Data;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Data\InsertIntoSelectQuery;
use GrizzIt\Dbal\Sql\Component\Query\Data\SelectQuery;
use GrizzIt\Dbal\Common\QueryInterface;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Data\InsertIntoSelectQuery
 */
class InsertIntoSelectQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     * @covers ::getParameters
     * @covers ::addColumn
     *
     * @return void
     */
    public function testQuery(): void
    {
        $selectQuery = new SelectQuery('bar');
        $selectQuery->addColumn('qux');
        $subject = new InsertIntoSelectQuery('foo', $selectQuery);
        $this->assertInstanceOf(InsertIntoSelectQuery::class, $subject);
        $subject->addColumn('baz');
        $this->assertEquals(
            'INSERT INTO foo (baz) SELECT qux FROM bar;',
            $subject->getQuery()
        );

        $this->assertEquals([], $subject->getParameters());
    }

    /**
     * @covers ::__construct
     * @covers ::getQuery
     * @covers ::getParameters
     * @covers ::addColumn
     *
     * @return void
     */
    public function testNonParameterizedQuery(): void
    {
        $selectQuery = $this->createMock(QueryInterface::class);

        $selectQuery->expects(static::once())
            ->method('getQuery')
            ->willReturn('SELECT * FROM foo;');

        $subject = new InsertIntoSelectQuery('foo', $selectQuery);
        $this->assertInstanceOf(InsertIntoSelectQuery::class, $subject);
        $subject->addColumn('baz');
        $this->assertEquals(
            'INSERT INTO foo (baz) SELECT * FROM foo;',
            $subject->getQuery()
        );

        $this->assertEquals([], $subject->getParameters());
    }
}

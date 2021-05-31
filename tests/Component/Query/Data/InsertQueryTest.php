<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Data;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Data\InsertQuery;
use InvalidArgumentException;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Data\InsertQuery
 */
class InsertQueryTest extends TestCase
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
        $subject = new InsertQuery('foo');
        $this->assertInstanceOf(InsertQuery::class, $subject);

        $subject->addColumn('bar', 'baz');
        $subject->addColumn('qux', null);

        $this->assertEquals(
            'INSERT INTO foo (bar, qux) VALUES (?, ?);',
            $subject->getQuery()
        );

        $this->assertEquals(['baz', null], $subject->getParameters());

        $this->expectException(InvalidArgumentException::class);
        $subject->addColumn('bar', ['test']);
    }
}

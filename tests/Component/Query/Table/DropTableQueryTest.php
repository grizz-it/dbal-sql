<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Table;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Table\DropTableQuery;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Table\DropTableQuery
 */
class DropTableQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new DropTableQuery('foo');
        $this->assertInstanceOf(DropTableQuery::class, $subject);

        $this->assertEquals(
            'DROP TABLE foo;',
            $subject->getQuery()
        );
    }
}

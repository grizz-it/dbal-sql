<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Database;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Database\DropDatabaseQuery;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Database\DropDatabaseQuery
 */
class DropDatabaseQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new DropDatabaseQuery('foo');
        $this->assertInstanceOf(DropDatabaseQuery::class, $subject);

        $this->assertEquals(
            'DROP DATABASE foo;',
            $subject->getQuery()
        );
    }
}

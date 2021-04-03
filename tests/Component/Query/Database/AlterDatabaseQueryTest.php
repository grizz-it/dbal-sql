<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Database;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Database\AlterDatabaseQuery;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Database\AlterDatabaseQuery
 */
class AlterDatabaseQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new AlterDatabaseQuery(
            'foo',
            'utf8mb4',
            'utf8mb4_unicode_ci'
        );
        $this->assertInstanceOf(AlterDatabaseQuery::class, $subject);

        $this->assertEquals(
            'ALTER DATABASE foo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;',
            $subject->getQuery()
        );
    }
}

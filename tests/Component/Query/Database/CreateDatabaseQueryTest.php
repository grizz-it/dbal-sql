<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Database;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Database\CreateDatabaseQuery;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Database\CreateDatabaseQuery
 */
class CreateDatabaseQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new CreateDatabaseQuery(
            'foo',
            'utf8mb4',
            'utf8mb4_unicode_ci'
        );
        $this->assertInstanceOf(CreateDatabaseQuery::class, $subject);

        $this->assertEquals(
            'CREATE DATABASE IF NOT EXISTS foo CHARACTER SET utf8mb4 COLLATE ' .
            'utf8mb4_unicode_ci;',
            $subject->getQuery()
        );
    }
}

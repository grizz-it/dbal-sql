<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Table;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Table\CreateTableQuery;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Table\CreateTableQuery
 */
class CreateTableQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new CreateTableQuery('foo', 'INNODB');
        $this->assertInstanceOf(CreateTableQuery::class, $subject);

        $this->assertEquals(
            'CREATE TABLE foo () ENGINE = INNODB;',
            $subject->getQuery()
        );
    }
}

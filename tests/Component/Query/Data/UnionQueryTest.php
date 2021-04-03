<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Data;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Data\UnionQuery;
use GrizzIt\Dbal\Sql\Component\Query\Data\SelectQuery;
use GrizzIt\Dbal\Sql\Common\UnionEnum;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Data\UnionQuery
 */
class UnionQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     * @covers ::getParameters
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new UnionQuery(
            new SelectQuery('foo'),
            new SelectQuery('bar'),
            UnionEnum::ALL()
        );

        $this->assertInstanceOf(UnionQuery::class, $subject);

        $this->assertEquals(
            'SELECT * FROM foo UNION ALL SELECT * FROM bar;',
            $subject->getQuery()
        );

        $this->assertEquals([], $subject->getParameters());
    }
}

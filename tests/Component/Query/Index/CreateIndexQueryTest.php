<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Index;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Index\CreateIndexQuery;
use GrizzIt\Dbal\Sql\Common\IndexTypeEnum;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Index\CreateIndexQuery
 */
class CreateIndexQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new CreateIndexQuery(
            IndexTypeEnum::UNIQUE(),
            'IDX_foo',
            'bar',
            'baz'
        );

        $this->assertInstanceOf(CreateIndexQuery::class, $subject);

        $this->assertEquals(
            'CREATE UNIQUE INDEX IDX_foo ON bar (baz);',
            $subject->getQuery()
        );
    }
}

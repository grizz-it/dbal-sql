<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Context;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Context\UseQuery;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Context\UseQuery
 */
class UseQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new UseQuery('foo');
        $this->assertInstanceOf(UseQuery::class, $subject);
        $this->assertEquals('USE foo;', $subject->getQuery());
    }
}

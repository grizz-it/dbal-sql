<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\View;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\View\DropViewQuery;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\View\DropViewQuery
 */
class DropViewQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new DropViewQuery('foo');
        $this->assertInstanceOf(DropViewQuery::class, $subject);

        $this->assertEquals(
            'DROP VIEW foo;',
            $subject->getQuery()
        );
    }
}

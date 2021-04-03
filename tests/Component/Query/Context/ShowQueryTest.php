<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Context;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Context\ShowQuery;
use GrizzIt\Dbal\Sql\Common\ShowTypeEnum;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Context\ShowQuery
 */
class ShowQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new ShowQuery(ShowTypeEnum::DATABASES());
        $this->assertInstanceOf(ShowQuery::class, $subject);
        $this->assertEquals('SHOW DATABASES;', $subject->getQuery());
    }
}

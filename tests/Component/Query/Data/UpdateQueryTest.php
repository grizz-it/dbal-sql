<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Query\Data;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Query\Data\UpdateQuery;
use InvalidArgumentException;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Data\UpdateQuery
 */
class UpdateQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     * @covers ::getParameters
     * @covers ::addColumn
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new UpdateQuery('foo');

        $subject->addColumn('bar', 'baz');
        $subject->addColumn('qux', null);
        $this->assertEquals('UPDATE foo SET bar=?, qux=?;', $subject->getQuery());
        $this->assertEquals(['baz', null], $subject->getParameters());

        $this->expectException(InvalidArgumentException::class);

        $subject->addColumn('bar', []);
    }
}

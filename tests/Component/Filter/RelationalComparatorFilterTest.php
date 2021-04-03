<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Filter;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Component\Filter\RelationalComparatorFilter;
use GrizzIt\Dbal\Sql\Common\ComparatorEnum;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Filter\RelationalComparatorFilter
 */
class RelationalComparatorFilterTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFilter
     *
     * @return void
     */
    public function testFilter(): void
    {
        $subject = new RelationalComparatorFilter(
            'foo',
            ['bar', 'baz', 'qux'],
            ComparatorEnum::IN()
        );

        $this->assertInstanceOf(RelationalComparatorFilter::class, $subject);

        $this->assertEquals('foo IN (bar, baz, qux)', $subject->getFilter());
    }
}

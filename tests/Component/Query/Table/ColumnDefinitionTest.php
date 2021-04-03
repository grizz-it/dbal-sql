<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Table;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Common\ColumnTypeEnum;
use GrizzIt\Dbal\Sql\Common\ColumnDefaultEnum;
use GrizzIt\Dbal\Sql\Common\ColumnAttributeEnum;
use GrizzIt\Dbal\Sql\Component\Query\Table\ColumnDefinition;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Table\ColumnDefinition
 */
class ColumnDefinitionTest extends TestCase
{
    /**
     * @covers ::getName
     * @covers ::setName
     * @covers ::getType
     * @covers ::setType
     * @covers ::getTypeOption
     * @covers ::setTypeOption
     * @covers ::getDefault
     * @covers ::setDefault
     * @covers ::getAttribute
     * @covers ::setAttribute
     * @covers ::isNullable
     * @covers ::setIsNullable
     * @covers ::isAutoIncrement
     * @covers ::setIsAutoIncrement
     * @covers ::isUnique
     * @covers ::setIsUnique
     * @covers ::getComment
     * @covers ::setComment
     * @covers ::__construct
     *
     * @return void
     */
    public function testComponent(): void
    {
        $subject = new ColumnDefinition('foo', ColumnTypeEnum::BLOB());

        $this->assertEquals('foo', $subject->getName());
        $this->assertEquals(ColumnTypeEnum::BLOB(), $subject->getType());

        $subject->setName('bar');
        $subject->setType(ColumnTypeEnum::VARCHAR());

        $this->assertEquals('bar', $subject->getName());
        $this->assertEquals(ColumnTypeEnum::VARCHAR(), $subject->getType());

        $subject->setTypeOption('255');
        $this->assertEquals('255', $subject->getTypeOption());

        $this->assertEquals(null, $subject->getDefault());
        $subject->setDefault(ColumnDefaultEnum::CURRENT_TIMESTAMP());
        $this->assertEquals(
            ColumnDefaultEnum::CURRENT_TIMESTAMP(),
            $subject->getDefault()
        );

        $subject->setDefault(1.4);
        $this->assertEquals(1.4, $subject->getDefault());

        $subject->setAttribute(ColumnAttributeEnum::UNSIGNED());
        $this->assertEquals(
            ColumnAttributeEnum::UNSIGNED(),
            $subject->getAttribute()
        );

        $this->assertEquals(false, $subject->isNullable());
        $subject->setIsNullable(true);
        $this->assertEquals(true, $subject->isNullable());

        $this->assertEquals(false, $subject->isAutoIncrement());
        $subject->setIsAutoIncrement(true);
        $this->assertEquals(true, $subject->isAutoIncrement());

        $this->assertEquals(false, $subject->isUnique());
        $subject->setIsUnique(true);
        $this->assertEquals(true, $subject->isUnique());

        $this->assertEquals('', $subject->getComment());
        $subject->setComment('my comment');
        $this->assertEquals('my comment', $subject->getComment());
    }
}

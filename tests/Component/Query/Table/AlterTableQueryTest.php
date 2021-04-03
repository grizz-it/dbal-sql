<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Tests\Component\Query\Table;

use PHPUnit\Framework\TestCase;
use GrizzIt\Dbal\Sql\Common\ColumnTypeEnum;
use GrizzIt\Dbal\Sql\Common\ColumnDefaultEnum;
use GrizzIt\Dbal\Sql\Component\Query\Table\AlterTableQuery;
use GrizzIt\Dbal\Sql\Component\Query\Table\ColumnDefinition;

/**
 * @coversDefaultClass \GrizzIt\Dbal\Sql\Component\Query\Table\AlterTableQuery
 * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery
 */
class AlterTableQueryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getQuery
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::addPrimaryKey
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::dropPrimaryKey
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::addForeignKey
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::dropForeignKey
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::getKeys
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::addColumn
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::alterColumn
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::dropColumn
     * @covers \GrizzIt\Dbal\Sql\Component\Query\Table\AbstractTableQuery::getColumns
     *
     * @return void
     */
    public function testQuery(): void
    {
        $subject = new AlterTableQuery('foo');
        $this->assertInstanceOf(AlterTableQuery::class, $subject);

        $subject->addPrimaryKey('bar');
        $subject->dropPrimaryKey();
        $subject->addForeignKey('FK_foo', 'foo', 'qux', 'foo', null, null);
        $subject->dropForeignKey('FK_bar');
        $column = new ColumnDefinition(
            'qux',
            ColumnTypeEnum::VARCHAR()
        );
        $column->setTypeOption('255');
        $column->setDefault(ColumnDefaultEnum::DEFAULT_NULL());
        $column->setIsNullable(true);
        $column->setComment('Lorem Ipsum dolor sit amet');
        $subject->addColumn($column);

        $alterColumn = new ColumnDefinition('doe', ColumnTypeEnum::INT());
        $alterColumn->setTypeOption('11');
        $alterColumn->setDefault(1);

        $subject->alterColumn($alterColumn);

        $subject->dropColumn('foo');

        $this->assertEquals(
            'ALTER TABLE foo ADD `qux` VARCHAR(255) NULL DEFAULT NULL ' .
            'COMMENT \'Lorem Ipsum dolor sit amet\', DROP COLUMN `foo`, MODIFY' .
            ' `doe` INT(11) NOT NULL DEFAULT 1, ADD CONSTRAINT PRIMARY KEY(`bar`)' .
            ', ADD CONSTRAINT FK_foo FOREIGN KEY(foo) REFERENCES qux(foo), DROP ' .
            'PRIMARY KEY, DROP FOREIGN KEY FK_bar;',
            $subject->getQuery()
        );
    }
}

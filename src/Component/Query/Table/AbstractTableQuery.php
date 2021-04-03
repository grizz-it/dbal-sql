<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Component\Query\Table;

use GrizzIt\Dbal\Common\QueryInterface;
use GrizzIt\Dbal\Sql\Common\CascadeEnum;
use GrizzIt\Dbal\Sql\Common\ColumnDefinitionInterface;

abstract class AbstractTableQuery implements QueryInterface
{
    /**
     * Contains the columns for the table query.
     *
     * @var array
     */
    private array $columns = ['add' => [], 'drop' => [], 'alter' => []];

    /**
     * Contains the keys for the table.
     *
     * @var array
     */
    private array $keys = ['add' => [], 'drop' => []];

    /**
     * Adds a primary key to the query.
     *
     * @param string ...$keys
     *
     * @return void
     */
    public function addPrimaryKey(string ...$keys): void
    {
        $this->keys['add'][] = sprintf(
            'CONSTRAINT PRIMARY KEY(`%s`)',
            implode('`, `', $keys)
        );
    }

    /**
     * Drops the primary key from the table.
     *
     * @return void
     */
    public function dropPrimaryKey(): void
    {
        $this->keys['drop'][] = 'DROP PRIMARY KEY';
    }

    /**
     * Adds a foreign key to the table query.
     *
     * @param  string        $column
     * @param  string        $table
     * @param  string        $tableColumn
     *
     * @return void
     */
    public function addForeignKey(
        string $keyName,
        string $column,
        string $table,
        string $tableColumn,
        ?CascadeEnum $onDelete,
        ?CascadeEnum $onUpdate
    ): void {
        $this->keys['add'][] = sprintf(
            'CONSTRAINT %s FOREIGN KEY(%s) REFERENCES %s(%s)',
            $keyName,
            $column,
            $table,
            $tableColumn
        ) . ($onDelete !== null ? ' ON DELETE ' . $onDelete : '') .
        ($onUpdate !== null ? ' ON UPDATE ' . $onUpdate : '');
    }

    /**
     * Drops a foreign key.
     *
     * @param string $keyName
     *
     * @return void
     */
    public function dropForeignKey(string $keyName): void
    {
        $this->keys['drop'][] = sprintf(
            'DROP FOREIGN KEY %s',
            $keyName
        );
    }

    /**
     * Returns the key query statements.
     *
     * @return array
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * Adds an add column operation to the operation list for the query.
     *
     * @param ColumnDefinitionInterface $column
     *
     * @return void
     */
    public function addColumn(
        ColumnDefinitionInterface $column
    ): void {
        $default = $column->getDefault();
        $defaultDefinition = '';
        if ($default !== null) {
            $defaultDefinition = (
                is_string($default) ? "'" . $default . "'" :
                (is_bool($default) ? (int) $default : $default)
            );
        }

        $typeOption = $column->getTypeOption();
        $attribute = $column->getAttribute();
        $comment = $column->getComment();
        $this->columns['add'][] = sprintf(
            '`%s` %s%s%s%s%s%s%s%s',
            $column->getName(),
            $column->getType(),
            $typeOption === null ? '' : sprintf('(%s)', $typeOption),
            $attribute === null ? '' : sprintf(' %s ', $attribute),
            $column->isNullable() ? ' NULL' : ' NOT NULL',
            $defaultDefinition === '' ? '' : ' DEFAULT ' . $defaultDefinition,
            $column->isAutoIncrement() ? ' AUTO_INCREMENT' : '',
            $column->isUnique() ? ' UNIQUE' : '',
            empty($comment) ? '' : sprintf(" COMMENT '%s'", $comment)
        );
    }

    /**
     * Adds an alter column operation to the operation list for the query.
     *
     * @param ColumnDefinitionInterface $column
     * @param string                    $newName
     *
     * @return void
     */
    public function alterColumn(
        ColumnDefinitionInterface $column,
        string $newName = ''
    ): void {
        $default = $column->getDefault();
        $defaultDefinition = '';
        if ($default !== null) {
            $defaultDefinition = (
                is_string($default) ? "'" . $default . "'" :
                (is_bool($default) ? (int) $default : $default)
            );
        }

        $typeOption = $column->getTypeOption();
        $attribute = $column->getAttribute();
        $comment = $column->getComment();
        $this->columns['alter'][] = sprintf(
            (empty($newName) ? 'MODIFY ' : 'ALTER ') . '`%s` %s%s%s%s%s%s%s%s',
            $column->getName() . (empty($newName) ? '' : '` `' . $newName),
            $column->getType(),
            $typeOption === null ? '' : sprintf('(%s)', $typeOption),
            $attribute === null ? '' : sprintf(' %s ', $attribute),
            $column->isNullable() ? ' NULL' : ' NOT NULL',
            $defaultDefinition === '' ? '' : ' DEFAULT ' . $defaultDefinition,
            $column->isAutoIncrement() ? ' AUTO_INCREMENT' : '',
            $column->isUnique() ? ' UNIQUE' : '',
            empty($comment) ? '' : sprintf(" COMMENT '%s'", $comment)
        );
    }

    /**
     * Adds a drop column operation to the query.
     *
     * @param string $column
     *
     * @return void
     */
    public function dropColumn(string $column): void
    {
        $this->columns['drop'][] = sprintf('DROP COLUMN `%s`', $column);
    }

    /**
     * Retrieves a list of column operations.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }
}

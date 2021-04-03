<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Common;

use GrizzIt\Dbal\Sql\Common\ColumnTypeEnum;
use GrizzIt\Dbal\Sql\Common\ColumnAttributeEnum;

interface ColumnDefinitionInterface
{
    /**
     * Get the column name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set the column name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Get the column type.
     *
     * @return ColumnTypeEnum
     */
    public function getType(): ColumnTypeEnum;

    /**
     * Set the column type.
     *
     * @param ColumnTypeEnum $type
     *
     * @return void
     */
    public function setType(ColumnTypeEnum $type): void;

    /**
     * Get the type option value.
     *
     * @return string|null
     */
    public function getTypeOption(): ?string;

    /**
     * Set the column type option.
     *
     * @param string|null $typeOption
     *
     * @return string|null
     */
    public function setTypeOption(?string $typeOption): void;

    /**
     * Get the default value.
     *
     * @return ColumnDefaultEnum|mixed
     */
    public function getDefault(): mixed;

    /**
     * Set the default value.
     *
     * @param ColumnDefaultEnum|mixed $default
     *
     * @return void
     */
    public function setDefault($default): void;

    /**
     * Get the attribute.
     *
     * @return ColumnAttributeEnum|null
     */
    public function getAttribute(): ?ColumnAttributeEnum;

    /**
     * Set the attribute.
     *
     * @param ColumnAttributeEnum|null $attribute
     *
     * @return void
     */
    public function setAttribute(?ColumnAttributeEnum $attribute): void;

    /**
     * Whether the column is nullable.
     *
     * @return bool
     */
    public function isNullable(): bool;

    /**
     * Set whether the column is nullable.
     *
     * @param bool $nullable
     *
     * @return void
     */
    public function setIsNullable(bool $nullable): void;

    /**
     * Whether the column is automatically incrementing.
     *
     * @return bool
     */
    public function isAutoIncrement(): bool;

    /**
     * Set whether the column is automatically incrementing.
     *
     * @param bool $autoIncrement
     *
     * @return void
     */
    public function setIsAutoIncrement(bool $autoIncrement): void;

    /**
     * Whether the value of the column must be unique.
     *
     * @return bool
     */
    public function isUnique(): bool;

    /**
     * Set whether the column should be unique.
     *
     * @param bool $unique
     *
     * @return void
     */
    public function setIsUnique(bool $unique): void;

    /**
     * Get the column comment.
     *
     * @return string
     */
    public function getComment(): string;

    /**
     * Set the column comment.
     *
     * @param string $comment
     *
     * @return void
     */
    public function setComment(string $comment): void;
}

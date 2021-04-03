<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Common;

use GrizzIt\Enum\Enum;

/**
 * @method static ColumnTypeEnum TINYINT()
 * @method static ColumnTypeEnum SMALLINT()
 * @method static ColumnTypeEnum MEDIUMINT()
 * @method static ColumnTypeEnum INT()
 * @method static ColumnTypeEnum BIGINT()
 * @method static ColumnTypeEnum DECIMAL()
 * @method static ColumnTypeEnum FLOAT()
 * @method static ColumnTypeEnum DOUBLE()
 * @method static ColumnTypeEnum BIT()
 * @method static ColumnTypeEnum BOOLEAN()
 * @method static ColumnTypeEnum DATE()
 * @method static ColumnTypeEnum DATETIME()
 * @method static ColumnTypeEnum TIMESTAMP()
 * @method static ColumnTypeEnum TIME()
 * @method static ColumnTypeEnum YEAR()
 * @method static ColumnTypeEnum CHAR()
 * @method static ColumnTypeEnum VARCHAR()
 * @method static ColumnTypeEnum TINYTEXT()
 * @method static ColumnTypeEnum MEDIUMTEXT()
 * @method static ColumnTypeEnum LONGTEXT()
 * @method static ColumnTypeEnum BINARY()
 * @method static ColumnTypeEnum VARBINARY()
 * @method static ColumnTypeEnum TINYBLOB()
 * @method static ColumnTypeEnum MEDIUMBLOB()
 * @method static ColumnTypeEnum BLOB()
 * @method static ColumnTypeEnum LONGBLOB()
 * @method static ColumnTypeEnum ENUM()
 * @method static ColumnTypeEnum SET()
 * @method static ColumnTypeEnum GEOMETRY()
 * @method static ColumnTypeEnum POINT()
 * @method static ColumnTypeEnum LINESTRING()
 * @method static ColumnTypeEnum POLYGON()
 * @method static ColumnTypeEnum MULTIPOINT()
 * @method static ColumnTypeEnum MULTILINESTRING()
 * @method static ColumnTypeEnum MULTIPOLYGON()
 * @method static ColumnTypeEnum GEOMETRYCOLLECTION()
 * @method static ColumnTypeEnum JSON()
 */

class ColumnTypeEnum extends Enum
{
    /**
     * Numeric types
     */
    public const TINYINT = 'TINYINT';
    public const SMALLINT = 'SMALLINT';
    public const MEDIUMINT = 'MEDIUMINT';
    public const INT = 'INT';
    public const BIGINT = 'BIGINT';
    public const DECIMAL = 'DECIMAL';
    public const FLOAT = 'FLOAT';
    public const DOUBLE = 'DOUBLE';
    public const BIT = 'BIT';
    public const BOOLEAN = 'BOOLEAN';

    /**
     * Date types
     */
    public const DATE = 'DATE';
    public const DATETIME = 'DATETIME';
    public const TIMESTAMP = 'TIMESTAMP';
    public const TIME = 'TIME';
    public const YEAR = 'YEAR';

    /**
     * Text types
     */
    public const CHAR = 'CHAR';
    public const VARCHAR = 'VARCHAR';
    public const TINYTEXT = 'TINYTEXT';
    public const TEXT = 'TEXT';
    public const MEDIUMTEXT = 'MEDIUMTEXT';
    public const LONGTEXT = 'LONGTEXT';
    public const BINARY = 'BINARY';
    public const VARBINARY = 'VARBINARY';
    public const TINYBLOB = 'TINYBLOB';
    public const MEDIUMBLOB = 'MEDIUMBLOB';
    public const BLOB = 'BLOB';
    public const LONGBLOB = 'LONGBLOB';
    public const ENUM = 'ENUM';
    public const SET = 'SET';

    /**
     * Spatial types
     */
    public const GEOMETRY = 'GEOMETRY';
    public const POINT = 'POINT';
    public const LINESTRING = 'LINESTRING';
    public const POLYGON = 'POLYGON';
    public const MULTIPOINT = 'MULTIPOINT';
    public const MULTILINESTRING = 'MULTILINESTRING';
    public const MULTIPOLYGON = 'MULTIPOLYGON';
    public const GEOMETRYCOLLECTION = 'GEOMETRYCOLLECTION';

    /**
     * JSON types
     */
    public const JSON = 'JSON';
}

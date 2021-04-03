<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Common;

use GrizzIt\Enum\Enum;

/**
 * @method static ColumnAttributeEnum BINARY()
 * @method static ColumnAttributeEnum UNSIGNED()
 * @method static ColumnAttributeEnum ZEROFILL()
 * @method static ColumnAttributeEnum ON_UPDATE_NOW()
 */
class ColumnAttributeEnum extends Enum
{
    public const BINARY = 'BINARY';
    public const UNSIGNED = 'UNSIGNED';
    public const ZEROFILL = 'UNSIGNED ZEROFILL';
    public const ON_UPDATE_NOW = 'on update CURRENT_TIMESTAMP';
}

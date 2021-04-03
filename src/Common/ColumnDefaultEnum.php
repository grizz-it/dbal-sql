<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Common;

use GrizzIt\Enum\Enum;

/**
 * @method static ColumnDefaultEnum NONE()
 * @method static ColumnDefaultEnum DEFAULT_NULL()
 * @method static ColumnDefaultEnum CURRENT_TIMESTAMP()
 */
class ColumnDefaultEnum extends Enum
{
    public const NONE = '';
    public const DEFAULT_NULL = 'NULL';
    public const CURRENT_TIMESTAMP = 'CURRENT_TIMESTAMP';
}

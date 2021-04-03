<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Common;

use GrizzIt\Enum\Enum;

/**
 * @method static IndexTypeEnum UNIQUE()
 * @method static IndexTypeEnum INDEX()
 * @method static IndexTypeEnum FULLTEXT()
 * @method static IndexTypeEnum SPATIAL()
 */
class IndexTypeEnum extends Enum
{
    public const UNIQUE = 'UNIQUE INDEX';
    public const INDEX = 'INDEX';
    public const FULLTEXT = 'FULLTEXT INDEX';
    public const SPATIAL = 'SPATIAL INDEX';
}

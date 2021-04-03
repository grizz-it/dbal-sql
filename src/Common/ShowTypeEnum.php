<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Common;

use GrizzIt\Enum\Enum;

/**
 * @method static ShowTypeEnum DATABASES()
 * @method static ShowTypeEnum TABLES()
 */
class ShowTypeEnum extends Enum
{
    /**
     * Contains the show databases keyword.
     *
     * @var string
     */
    public const DATABASES = 'DATABASES';

    /**
     * Contains the show tables keyword.
     *
     * @var string
     */
    public const TABLES = 'TABLES';
}

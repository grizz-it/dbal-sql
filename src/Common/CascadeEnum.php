<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Dbal\Sql\Common;

use GrizzIt\Enum\Enum;

/**
 * @method static CascadeEnum NO_ACTION()
 * @method static CascadeEnum CASCADE()
 * @method static CascadeEnum SET_NULL()
 * @method static CascadeEnum SET_DEFAULT()
 */
class CascadeEnum extends Enum
{
    public const NO_ACTION = 'NO ACTION';
    public const CASCADE = 'CASCADE';
    public const SET_NULL = 'SET NULL';
    public const SET_DEFAULT = 'SET DEFAULT';
}

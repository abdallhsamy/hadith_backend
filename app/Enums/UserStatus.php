<?php

namespace App\Enums;

//use App\Traits\Enums\EnumTrait;

enum UserStatus: string
{
//    use EnumTrait;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    case PENDING = 'pending';

    case BANNED = 'banned';
}

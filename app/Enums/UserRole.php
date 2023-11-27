<?php

namespace App\Enums;

//use App\Traits\Enums\EnumTrait;

enum UserRole: string
{
    //    use EnumTrait;

    case ADMIN = 'admin';

    case USER = 'user';
}

<?php

namespace App\Enums;

enum MaterialStatus: string
{
    case LOCKED = 'locked';
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
}

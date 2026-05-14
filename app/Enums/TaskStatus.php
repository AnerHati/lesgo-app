<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case SUBMITTED = 'submitted';
    case GRADED = 'graded';
}

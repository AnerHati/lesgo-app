<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUND_REQUESTED = 'refund_requested';
    case REFUNDED = 'refunded';
}

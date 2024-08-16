<?php

namespace App\Enums;

enum PrintOrderStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case UNDERGRADUATE = 'undergraduate';
    case PAYMENT_AWAITING = 'payment_awaiting';
    case PAID = 'paid';
    case PRINTING = 'printing';
    case DONE = 'done';




}

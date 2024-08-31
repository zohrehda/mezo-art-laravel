<?php

namespace App\Enums;

enum PrintOrderStatus: string
{
    case IN_PROGRESS = 'in_progress';

    case UNDERGRADUATE = 'undergraduate';

    case USER_CONFIRMATION = 'user_confirmation';

    case ADMIN_CONFIRMATION = 'admin_confirmation';

    case PREPARATION = 'preparation';

    case PRINTING = 'printing';

    case READY = 'ready';

    case DONE = 'done';


    // case PAYMENT_AWAITING = 'payment_awaiting';
    // case PAID = 'paid';





}

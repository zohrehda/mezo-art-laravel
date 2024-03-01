<?php

namespace App\Enums\Tickets;

enum TicketStatus: string
{
    case PENDING = 'pending';
    case OPEN = 'open';
    case CLOSED = 'closed';
}

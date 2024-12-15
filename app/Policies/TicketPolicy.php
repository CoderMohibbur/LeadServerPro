<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;

class TicketPolicy
{
    public function view(User $user, Ticket $ticket)
{
    return $ticket->user_id === $user->id || $ticket->agent_id === $user->id;
}

public function update(User $user, Ticket $ticket)
{
    return $ticket->agent_id === $user->id;
}

}

<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine if the user can view any events.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'coach']);
    }

    /**
     * Determine if the user can view the event.
     */
    public function view(User $user, Event $event): bool
    {
        return in_array($user->role, ['admin', 'coach']);
    }

    /**
     * Determine if the user can create an event.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine if the user can update the event.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine if the user can delete the event.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->role === 'admin';
    }
}

<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Message $message)
    {
        return $user->isAdmin();
    }

    public function create(User $user)
    {
        return true;
    }

    public function delete(User $user, Message $message)
    {
        return $user->isAdmin();
    }
}

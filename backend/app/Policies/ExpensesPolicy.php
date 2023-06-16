<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

class ExpensesPolicy
{
    public function view(User $user, Expense $post): bool
    {
        return $user->id === $post->user_id;
    }

    public function update(User $user, Expense $post): bool
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Expense $post): bool
    {
        return $user->id === $post->user_id;
    }
}

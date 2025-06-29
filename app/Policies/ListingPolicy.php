<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{

    /**
     * Determine whether the user can view the model.
     */

    public function before(User $user)
    {
        if ($user->role === 'admin') {
            return true;
        }
        return null; // Allow other policies to be checked
    }
    public function view(?User $user, Listing $listing): bool
    {
        return $listing->user->role !== 'suspended' && $listing->approved;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role !== 'suspended';
    }
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function modify(User $user, Listing $listing): bool
    {
        return $user->role !== 'suspended' && $user->id === $listing->user_id;
    } //update, delete

    public function approve(User $user, Listing $listing)
    {
        return $user->isAdmin();
    }
}

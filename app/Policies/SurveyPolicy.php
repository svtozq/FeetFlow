<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\Survey;
use App\Models\User;

class SurveyPolicy
{

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function viewAny(User $user, Organization $organization): bool
    {
        // user must be member of this organization
        return $organization->members->contains($user->id) || $user->is_admin;
    }

    /**
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function view(User $user, Survey $survey): bool
    {
        return $survey->organization->members->contains($user->id) || $user->is_admin;
    }

    /**
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    //Alone creator and admin can update this survey
    public function update(User $user, Survey $survey): bool
    {
        return $user->id === $survey->user_id || $user->is_admin;
    }

    /**
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    //Alone creator and admin can delete this survey
    public function delete(User $user, Survey $survey): bool
    {
        return $user->id === $survey->user_id || $user->is_admin;
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    //Alone creator and admin can create one survey
    public function create(User $user, Organization $organization): bool
    {
        return $user->id === $organization->user_id || $user->is_admin;
    }

    /**
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function share(User $user, Survey $survey): bool
    {
        return $user->id === $survey->user_id || $user->is_admin;
    }
}

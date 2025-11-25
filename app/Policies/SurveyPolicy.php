<?php

namespace App\Policies;

use App\Models\Survey;
use App\Models\User;

class SurveyPolicy
{
    public function update(User $user, Survey $survey): bool
    {
        return $user->id === $survey->user_id || $user->is_admin;
    }

    public function delete(User $user, Survey $survey): bool
    {
        return $user->id === $survey->user_id || $user->is_admin;
    }
}

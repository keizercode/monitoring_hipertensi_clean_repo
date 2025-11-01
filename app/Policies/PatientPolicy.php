<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Patient;

class PatientPolicy
{
    public function view(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id;
    }

    public function update(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id;
    }

    public function delete(User $user, Patient $patient)
    {
        return $user->id === $patient->user_id;
    }
}
<?php
// app/Traits/CustomMustVerifyEmail.php

namespace App\Traits;

use Illuminate\Auth\Notifications\VerifyEmail;

trait CustomMustVerifyEmail
{
    public function sendEmailVerificationNotification()
    {
        if ($this->usertype === '0') {
            $this->notify(new VerifyEmail);
        }
    }
}

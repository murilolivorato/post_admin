<?php


namespace App\Http\Controllers\Traits;
use App\Models\UserCustomer;

class UserCustomerTable
{
    /**
     * @param UserCustomer $user
     * @return bool
     */
    public function ownedBy(UserCustomer $user) {
        return $this->user_id == $user->id;
    }

    /**
     * @return mixed
     */
    public function User() {
        return $this->belongsTo(UserCustomer::class, 'user_id');
    }
}

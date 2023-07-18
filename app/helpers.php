<?php

use App\Models\User;

function is_admin($id){
    $user = User::find($id);
 
    if($user && $user->roles()->first()->name === 'admin'){
        return true;
    }

    return false;
}



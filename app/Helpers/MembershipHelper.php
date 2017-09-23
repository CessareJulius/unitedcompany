<?php
namespace App\Helpers;

use Illuminate\Support\Facades\App;
use App\User;
class MembershipHelper {

    public static function access($userId = null) {

        if ($userId) {
            $user = User::findOrFail($userId);

        }else {
            $user = Auth::user();
        }
        
        $mem = $user->membership;

        if (isset($mem->status)=='Activo') {
            return true;
        }else {
            return view('clientarea.membership.index');
        }
        

    }
}

?>
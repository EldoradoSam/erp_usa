<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Hr\Entities\Employee;


class LogInController extends Controller
{
    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
            // Authentication passed...
            $user_role = UserRole::where('user_id', '=', Auth::user()->id)->first();
            $role = Role::find($user_role->role_id);
            Session::put('role', $role->name);
            return '200';
        } else {
            return "201";
        }
    }


    public function loginApp($email, $password)
    {
        //$email = $request->email;
        //$password = $request->password;

        $message = null;
        if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
            $uid = Auth::user()->user_id;
            $message = array(
                'UserID' => $uid,
                'Message' => 'succesfull',
                'Status' => '1',
                'UserLevel' => 0,
            );
            
        } else {
            $message = array(
                'UserID' => '',
                'Message' => 'error',
                'Status' => '0',
                'UserLevel' => 0,
            );
        }
        return json_encode($message);
    }


    public function loginTest(){
        return 'ok';
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function resetPassword($id, $currentPassword, $newPassword)
    {
        $user = User::find($id);
        if ($user) {
            if (Hash::check($currentPassword, $user->password)) {
                $user->password = Hash::make($newPassword);
                $user->update();
                return true;
            }
        }
        return false;
    }
}

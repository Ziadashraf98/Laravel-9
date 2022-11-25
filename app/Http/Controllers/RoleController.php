<?php

namespace App\Http\Controllers;

use App\Http\Middleware\checkStatus;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware([checkStatus::class , 'auth']);
    // }

    public function index()
    {
        $role = Role::with('users')->find(3);
        return $role;
    }

    public function add_role_view()
    {
        $users = User::all();
        return view('add_role' , compact('users'));
    }

    public function add_role(Request $request)
    {
        DB::beginTransaction();

        $data = Role::create([
            'role_name'=>$request->role,
        ]);

        foreach($request->users as $user)
        {
            RoleUser::create([
                'user_id' => $user,
                'role_id' => $data->id
            ]);
        }
        
        DB::commit();

        return back()->with('success' , 'Role Added Successfully');
    }
}

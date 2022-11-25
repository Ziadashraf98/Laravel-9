<?php

namespace App\Http\Controllers;

use App\Jobs\ActiveUsersJob;
use App\Jobs\SendMailUsers;
use App\Models\Post;
use App\Models\User;
use App\Traits\TestTrait;
use Illuminate\Http\Request;


class TestController extends Controller
{
    use TestTrait;
    
    public function test()
    {
        return $this->get(User::class);
    }

    public function users()
    {
       $users = User::where('status' , 0)->get();
       
       ActiveUsersJob::dispatch($users)->delay(now()->second(40));
       
       return 'جاري العمل الآن على طلبك';
    }

    public function SendMail()
    {
        $data = ['ziadshalaby98@gmail.com' , 'ziadshalaby98@gmail.com' , 'ziadshalaby98@gmail.com'];

        SendMailUsers::dispatch($data);

        return 'جاري العمل الآن على طلبك';
    }
}

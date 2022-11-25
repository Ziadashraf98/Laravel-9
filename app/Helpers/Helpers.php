<?php

use Illuminate\Support\Facades\Auth;


function user_name()
{
    return Auth::user()->name;
}

function user_id()
{
    return Auth::id();
}



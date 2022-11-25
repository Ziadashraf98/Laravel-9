<?php

namespace App\Traits;

use App\Http\Requests\PostRequest;

trait ImageTrait
{
    public function image(PostRequest $request , $folderName)
    {
        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs($folderName , $image , 'public');
        return $path;
    }
}
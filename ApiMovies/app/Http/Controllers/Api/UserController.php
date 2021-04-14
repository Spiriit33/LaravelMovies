<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCreateUser;
use App\Models\User;

class UserController extends Controller
{
    /**
     *
     */
    public function store(RequestCreateUser $request)
    {
        $data = $request->validated();
        $user = User::create($data);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
      return  $this->retrieve($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = $request->apiValidate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email|unique:users,email',
            'mobile' => 'integer|unique:users,mobile',
            'username' => 'string|unique:users,username',
            'password' => '',
            'role' => '',
        ]);

        $user = User::create($validator->validated() + ['password' => $request->password ? Hash::make($request->password) : null]);

        return $this->createdResponse($user);

    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

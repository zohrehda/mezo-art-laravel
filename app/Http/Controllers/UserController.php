<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $repository = '';
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::filter()->paginate22();
        $users = User::all();
        return $this->retrieve($users);
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
            'is_ban' => 'boolean'
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
        $user = $this->repository->update($request, $user);
        return $this->updatedResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRepository
{

    public function update(Request $request, $user)
    {
        $validator = $request->apiValidate(
            [
                'email' => 'sometimes',
                'mobile' => 'sometimes',
                'first_name' => 'sometimes',
                'last_name' => 'sometimes',
                'brith_date' => 'sometimes|date|nullable',
                // 
                'brand_name' => 'sometimes',
                'phone_number' => 'sometimes',
                'guild' => 'sometimes',
                'province_id' => 'nullable|sometimes|exists:provinces,id',
                'city_id' => 'nullable|sometimes|exists:cities,id',
                'address' => 'sometimes',
                'est_year' => 'sometimes|date|nullable',
                'current_password' => 'nullable',
                'new_password' => 'nullable|confirmed|min:3',
                'is_ban' => 'boolean'
            ],
            $request->all(),
            function ($validator) use ($request, $user) {

                $validator->after(function ($validator) use ($request, $user) {

                    if ($request->filled('new_password') && $user->password && !Hash::check($request->input('current_password'), $user->password))
                        $validator->errors()->add('current_password', 'رمز فعلی نادرست است');

                });

            }
        );

        $password_array = [];
        if ($request->filled('new_password'))
            if (
                ($user->password && Hash::check($request->input('current_password'), $user->password))
                || !$user->password

            )
                $password_array = ['password' => Hash::make($request->input('new_password'))];




        $user->update(
            $validator->validated() + $password_array
        );
        $user->meta()->updateOrCreate(['user_id' => $user->id], $validator->validated());

        return $user;

    }
}